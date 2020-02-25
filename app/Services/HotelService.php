<?php

namespace App\Services;

use App\Jobs\ProcessSendMailJob;
use App\Mail\HotelRegistration;
use App\Repositories\HotelRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;

class HotelService {

    protected $repository;
    protected $userRepository;

    /**
     * HotelService constructor.
     * @param HotelRepository $repository
     */
    public function __construct(HotelRepository $repository, UsersRepository $userRepository) {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($filters = [], $paginated = true) {
        array_forget($filters, 'page');
        return $this->repository->getAll($filters, $paginated);
    }

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getOne($col) {
        return $this->repository->getOne($col);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
//
    }

    /**
     * Hotel a newly created resource in storage.
     *
     * @param $modelValues
     * @return \Illuminate\Http\Response
     */
    public function store($modelValues) {
        array_forget($modelValues, ['_token', 'action', 'old_image']);

        if (!isset($modelValues['status']) || empty($modelValues['status']) || $modelValues['status'] == 0) {
            $modelValues['status'] = false;
        }
         
        $hotel = $this->repository->store($modelValues);

        $updateModel = array();
        $cleanString = clean_string($modelValues['name']);
        $folderName = $cleanString . '_' . \Hashids::encode($hotel->id);
        if (!empty($folderName && isset($hotel->id))) {
            if (Storage::disk('local')->makeDirectory('/hotels/' . $folderName)) {
                $updateModel["folder_path"] = $folderName;
            }
        }

        if (isset($modelValues['logo'])) {
            $updateModel['logo'] = Storage::disk('local')->put('hotels/' . $folderName . '/logo', $modelValues['logo']);
        }

        if (!empty($updateModel)) {
            $this->repository->update($updateModel, $hotel->id);
        }

        ProcessSendMailJob::dispatch($hotel->email, new HotelRegistration($hotel, 1))->onQueue('email');
        return $hotel;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $modelValues
     * @param  int $id
     * @return bool
     */
    public function update($modelValues, $id) {

        if (!is_int($id)) {
            $id = \Hashids::decode($id)[0];
        }

        
        $hotel = $this->repository->getOne($id);

        if (!isset($modelValues['status']) || empty($modelValues['status']) || $modelValues['status'] == 0) {
            $modelValues['status'] = false;
        }

//Array Forget (Unset)
        array_forget($modelValues, ['_token', 'action', 'old_image', 'id']);

        if (isset($modelValues['logo'])) {
            if (\File::exists(storage_path('/app/' . $hotel->logo))) {
                \File::delete(storage_path('/app/' . $hotel->logo));
            }

            $modelValues['logo'] = Storage::disk('local')->put('hotels/' . $hotel->folder_path . '/logo', $modelValues['logo']);
        }

        $this->repository->update($modelValues, $hotel->id);

        Session::flash('success_message', 'Hotel updated successfully!');
        return true;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        $hotel = $this->repository->getOne($id);
        
        return $this->repository->destroy($id);
    }

}
