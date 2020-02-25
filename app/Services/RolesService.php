<?php

namespace App\Services;

use App\Repositories\RolesRepository;
use Illuminate\Http\Request;

class RolesService {

    public $repository;

    /**
     * RolesService constructor.
     * @param RolesRepository $repository
     */
    public function __construct(RolesRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllRoles($filters = []) {
        array_forget($filters, 'page');
        return $this->repository->getAllRoles($filters);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllAdminRoles($filters = []) {
        array_forget($filters, 'page');
        return $this->repository->getAllAdminRoles($filters);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllStoreRoles($filters = []) {
        array_forget($filters, 'page');
        return $this->repository->getAllStoreRoles($filters);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllCourierRoles($filters = []) {
        array_forget($filters, 'page');
        return $this->repository->getAllCouriersRoles($filters);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        return $this->repository->store($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id) {
        return $this->repository->getRole($id);
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
        return $this->repository->update($request->all(), $id);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        return $this->repository->destroy($id);
    }

    /**
     * 
     * @return permissions
     */
    public function getAdminPermissionsList() {
        return $this->repository->getAdminPermissionsList();
    }
    
    /**
     * 
     * @return permissions
     */
    public function getStorePermissionsList() {
        return $this->repository->getStorePermissionsList();
    }
    
    /**
     * 
     * @return permissions
     */
    public function getCourierPermissionsList() {
        return $this->repository->getCourierPermissionsList();
    }

}
