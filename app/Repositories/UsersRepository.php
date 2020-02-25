<?php

namespace App\Repositories;

use App\User;

class UsersRepository extends BaseRepository {

    public $model;

    /**
     * UsersRepository constructor.
     * @param User $users
     */
    public function __construct(User $users) {
        $this->model = $users;
    }

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll($filters = [], $paginated = true) {
        // get all the Userss
        $query = $this->model;

        if (isset($filters['search']) && !empty($filters['search'])) {
            $query = $query->where('users.first_name', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.last_name', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.email', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.phone', 'like', '%' . array_get($filters, 'search', '') . '%');
        }

        if (isset($filters['status']) && $filters['status'] != -1) {
            $query = $query->where('users.status', '=', array_get($filters, 'status', ''));
        }

        if (isset($filters['hotel_id']) && !empty($filters['hotel_id'])) {
            $filters['hotel_id'] = \Hashids::decode($filters['hotel_id'])[0];
            $query = $query->where('users.hotel_id', '=', array_get($filters, 'hotel_id', ''));
        }

        return $query->paginate(\Config::get('constants.ITEMS_PER_PAGE'));
    }

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAdminUsers($filters = [], $paginated = true) {
        // get all the Userss
        $query = $this->model->where("hotel_id", NULL);

        if (isset($filters['search']) && !empty($filters['search'])) {
            $query = $query->where('users.first_name', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.last_name', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.email', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.phone', 'like', '%' . array_get($filters, 'search', '') . '%');
        }

        if (isset($filters['status']) && $filters['status'] != -1) {
            $query = $query->where('users.status', '=', array_get($filters, 'status', ''));
        }

        if (!$paginated)
            return $query->get();

        return $query->paginate(\Config::get('constants.ITEMS_PER_PAGE'));
    }

    /**
     * @param array $filters
     * @param bool $paginated
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getPassengerUsers($filters = [], $paginated = true) {
        // get all the Userss
        $query = $this->model;

        if (isset($filters['search']) && !empty($filters['search'])) {
            $query = $query->where('users.first_name', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.last_name', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.email', 'like', '%' . array_get($filters, 'search', '') . '%')
                    ->orWhere('users.phone', 'like', '%' . array_get($filters, 'search', '') . '%');
        }

        if (isset($filters['status']) && $filters['status'] != -1) {
            $query = $query->where('users.status', '=', array_get($filters, 'status', ''));
        }

        if (isset($filters['hotel_id']) && !empty($filters['hotel_id'])) {
            $filters['hotel_id'] = \Hashids::decode($filters['hotel_id'])[0];
            $query = $query->where('users.hotel_id', '=', array_get($filters, 'hotel_id', ''));
        } else {
            $query = $query->where("hotel_id", "!=", "");
        }

        if (!$paginated) {
            return $query->get();
        }

        return $query->paginate(\Config::get('constants.ITEMS_PER_PAGE'));
    }

}
