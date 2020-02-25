<?php

namespace App\Repositories;

use App\Hotel;

class HotelRepository extends BaseRepository {

    /**
     * HotelRepository constructor.
     * @param Hotel $hotel
     */
    public function __construct(Hotel $hotel) {
        $this->model = $hotel;
    }

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($filters = [], $paginated = true) {
        $model = $this->model
                ->where('name', 'like', '%' . array_get($filters, 'search', '') . '%');

        if (isset($filters['status']) && $filters['status'] != -1) {
            $model = $model->where('status', 'like', '%' . array_get($filters, 'status', '') . '%');
        }

        $model = $model->orderBy("id", "DESC"); 
        if ($paginated) {
            $model = $model
                    ->paginate(\Config::get('constants.ITEMS_PER_PAGE'));
        } else {
            $model = $model->get();
        }
        // get all the hotels
        return $model;
    }

}
