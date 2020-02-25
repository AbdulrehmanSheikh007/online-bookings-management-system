<?php

namespace App\Repositories;

abstract class BaseRepository
{
    public $model;

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($filters = [], $paginated = true) {
        return ($paginated ? $this->model->paginate(\Config::get('constants.ITEMS_PER_PAGE')) : $this->model->all());
    }

    /**
     * @param $value
     * @param string $column
     * @param string $select
     * @param array $with
     * @param array $filters
     * @return mixed
     */
    public function getOne($value, $column = 'id', $filters = [], $with = [], $select = '*') {

        $model = $this->model->where($column, $value);
        foreach ($filters as $col => $val) {
            $model = $model->where($col, $val);
        }
        // get specific
        $model = $model->with($with)
            ->select($select)
            ->first();
        return $model;
    }

    /**
     * @param array $info
     * @return mixed
     */
    public function store(array $info) {
        return $this->model->create($info);
    }

    /**
     * @param $params
     * @param $value
     * @param string $column
     * @param array $filters
     * @return mixed
     * @internal param $id
     */

    public function update($params, $value, $column = 'id', $filters = [])
    {
        $model = $this->model->where($column, $value);
        foreach ($filters as $col => $val) {
            $model = $model->where($col, $val);
        }
        return $model->update($params);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        return $this->model->destroy($id);
    }

    /**
     * @param array $filters
     * @return int
     * @internal param $params
     */
    public function countAll($filters = []) {
        $model = $this->model->select('id');
        if ($store_id = array_get($filters, 'store_id', null)) {
            $model = $model->where('store_id', '=', $store_id);
        }
        return $model->count();
    }
}
