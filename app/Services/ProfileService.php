<?php

namespace App\Services;

use App\Repositories\ProfileRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use File;

class ProfileService {

    public $repository;

    /**
     * ProfileService constructor.
     * @param ProfileRepository $repository
     */
    public function __construct(ProfileRepository $repository) {
        $this->repository = $repository;
    }

    public function getProfile($value, $column = 'id', $selectcol = "*") {
        // get specific user profile
        return $this->repository->getOne($value, $column, [], [],$selectcol);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $modalValues = $request->all();
        
        $path = storage_path('/app/');
        if (isset($modalValues['profile_img'])) {
            if (\File::exists($path . Auth::user()->profile_img)) {
                \File::delete($path . Auth::user()->profile_img);
            }
            
            $modalValues['profile_img'] = Storage::disk('local')->put('users', $modalValues['profile_img']);
        }
        
        if (isset($modalValues['cnic_img'])) {
            if (\File::exists($path . Auth::user()->cnic_img)) {
                \File::delete($path . Auth::user()->cnic_img);
            }
            
            $modalValues['cnic_img'] = Storage::disk('local')->put('users', $modalValues['cnic_img']);
        }

        if ($modalValues['action'] == "password") {
            $modalValues['password'] = Hash::make($modalValues['password']);
        }

        array_forget($modalValues, ['_method', '_token', 'action', 'current_password', 'password_confirmation']);
        return $this->repository->update($modalValues, $id);
    }

}
