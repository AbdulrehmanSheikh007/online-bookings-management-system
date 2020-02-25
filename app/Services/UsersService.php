<?php

namespace App\Services;

use App\Jobs\ProcessSendMailJob;
use App\Mail\PasswordReset;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Hashids;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class UsersService {

    public $repository;

    /**
     * UsersService constructor.
     * @param UsersRepository $repository
     */
    public function __construct(UsersRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllUsers($filters = []) {
        array_forget($filters, 'page');
        return $this->repository->getAll($filters);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAdminUsers($filters = [], $paginate = true) {
        array_forget($filters, 'page');
        return $this->repository->getAdminUsers($filters, $paginate);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPassengerUsers($filters = [], $paginate = true) {
        array_forget($filters, 'page');
        return $this->repository->getPassengerUsers($filters, $paginate);
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
     * Store a newly created resource in storage.
     *
     * @param $modalValues
     * @return mixed
     */
    public function store($modalValues) {

        $modalValues['password'] = isset($modalValues['password']) ? $modalValues['password'] : Hash::make('~T!H@E#W$A%A^H&');
        $user = $this->repository->store($modalValues);
        return $this->password_reset($user->id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id) {
        
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
     * @param $modelValues
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     */
    public function update($modalValues, $id) {
        return $this->repository->update($modalValues, $id);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        return $this->repository->destroy($id);
    }

    //Generate activation email 
    public function password_reset($user_id = null) {
        $user = $this->repository->getOne($user_id);
        $_token = Str::random(14);
        $_token_expiry = date('Y-m-d H:i:s', strtotime('+1 day'));
        $user->_token = $_token;
        $user->_token_expiry = $_token_expiry;
        $user->email_verified_at = null;
        $user->status = 0;
        $user->save();
        ProcessSendMailJob::dispatch($user->email, new PasswordReset($user, env('APP_URL')))->onQueue('email');
        return $user;
    }

    public function update_password($data) {

        $user = $this->repository->getOne($data['user_id']);
        $user->_token_expiry = null;
        $user->_token = null;
        $user->status = 1;
        $user->password = Hash::make($data['password']);
        $user->email_verified_at = date('Y-m-d H:i:s');
        $user->save();
        return $user;
    }

    /**
     * @param $value
     * @param string $column
     * @param array $filters
     * @param array $with
     * @param string $select
     * @return mixed
     */
    public function getOne($value, $column = 'id', $filters = [], $with = [], $select = '*') {
        // get specific
        return $this->repository->getOne($value, $column, $filters, $with, $select);
    }

}
