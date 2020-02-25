<?php

namespace App\Services;

use App\Repositories\BookingsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Session;
use Hashids;
use App\Bookings;
use Illuminate\Support\Carbon;

class BookingsService {

    protected $repository;

    /**
     * StoreService constructor.
     * @param CourierRepository $repository
     */
    public function __construct(BookingsRepository $repository) {
        $this->repository = $repository;
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

    public function getOne($value, $column = 'id') {
        // get specific courier
        return $this->repository->getOne($value, $column);
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
     * @param $modelValues
     * @return \Illuminate\Http\Response
     */
    public function store($modelValues) {

        if (!isset($modelValues['status']) || empty($modelValues['status']) || $modelValues['status'] == 0) {
            $modelValues['status'] = false;
        }

        $modelValues['checkin_at'] = NULL;
        $modelValues['checkout_at'] = NULL;

        if (isset($modelValues['booking_duration']) && !empty($modelValues['booking_duration'])) {
            $mode_time = explode(' to ', trim($modelValues['booking_duration']));

            $modelValues['checkin_at'] = Carbon::CreateFromFormat('d-m-Y H:i A', $mode_time[0])->format('Y-m-d H:i:s'); //date("Y-m-d H:i:s", strtotime($mode_time[0]));
            $modelValues['checkout_at'] = Carbon::CreateFromFormat('d-m-Y H:i A', $mode_time[1])->format('Y-m-d H:i:s'); //date("Y-m-d H:i:s", strtotime($mode_time[1]));
        }

        if (isset($modelValues['hotel_id']) && !is_int($modelValues['hotel_id'])) {
            $modelValues['hotel_id'] = Hashids::decode($modelValues['hotel_id'])[0];
        }

        array_forget($modelValues, ['_token', 'action', 'old_image', 'id', '_method', 'booking_duration']);
        $booking = $this->repository->store($modelValues);


        return $booking;
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

        if (!isset($modelValues['status']) || empty($modelValues['status']) || $modelValues['status'] == 0) {
            $modelValues['status'] = false;
        }

        $modelValues['checkin_at'] = NULL;
        $modelValues['checkout_at'] = NULL;

        if (isset($modelValues['booking_duration']) && !empty($modelValues['booking_duration'])) {
            $mode_time = explode(' to ', trim($modelValues['booking_duration']));

            $modelValues['checkin_at'] = Carbon::CreateFromFormat('d-m-Y H:i A', $mode_time[0])->format('Y-m-d H:i:s'); //date("Y-m-d H:i:s", strtotime($mode_time[0]));
            $modelValues['checkout_at'] = Carbon::CreateFromFormat('d-m-Y H:i A', $mode_time[1])->format('Y-m-d H:i:s'); //date("Y-m-d H:i:s", strtotime($mode_time[1]));
        }

        if (isset($modelValues['hotel_id']) && !is_int($modelValues['hotel_id']))
            $modelValues['hotel_id'] = Hashids::decode($modelValues['hotel_id'])[0];

        array_forget($modelValues, ['_token', 'action', 'old_image', 'id', '_method', 'booking_duration']);
        $this->repository->update($modelValues, $id);

        $booking = $this->repository->getOne($id);
        return $booking;
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        $booking = $this->repository->getOne($id);
        return $this->repository->destroy($id);
    }

}
