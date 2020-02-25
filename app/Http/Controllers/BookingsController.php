<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bookings\StoreBookingRequest;
use App\Http\Requests\Bookings\UpdateBookingRequest;
use App\Services\BookingsService;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Hashids;
use Form;
use Session;
use Illuminate\Support\Carbon;
use Illuminate\Http\Response;

class BookingsController extends Controller {

    public $service;
    public $hotelService;
    public $response;

    /**
     * StoreController constructor.
     * @param StoreService $service
     */
    public function __construct(BookingsService $service, HotelService $hotelService) {
        $this->service = $service;
        $this->hotelService = $hotelService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request) {
        not_permissions_redirect(have_premission(10));
        $hotels = $this->hotelService->getAll([], false);
        $allBookings = $this->service->getAll($request->all());
        return view('bookings.list', compact(['allBookings', 'hotels']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        not_permissions_redirect(have_premission(11));
        $action = 'Add';
        $booking = app('request')->old();
        $hotels = $this->hotelService->getAll([], false);
        return view('bookings.add', compact(['action', 'booking', 'hotels']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStoreRequest|Request $request 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request) {
        not_permissions_redirect(have_premission(11));
        $action = $request['action'];
        if ($action == 'Add') {
            $this->service->store($request->all());
            $request->session()->flash('success_message', 'Store have been created successfully!');
            return redirect('/bookings');
        } else if ($action == 'Edit') {
            $update = $this->service->update($request->all(), $request['id']);
            if (!$update)
                return redirect()->back()->withInput();
            else
                return redirect("/bookings");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
        not_permissions_redirect(have_premission(12));
        $action = 'Edit';
        $id = \Hashids::decode($id)[0];
        $booking = $this->service->getOne($id);
        $booking_duration = NULL;
        if (!empty($booking->checkin_at)) {
            $booking_duration = Carbon::CreateFromFormat('Y-m-d H:i:s', $booking->checkin_at)->format('d-m-Y g:i A');
            $booking_duration .= " to ";
            $booking_duration .= Carbon::CreateFromFormat('Y-m-d H:i:s', $booking->checkout_at)->format('d-m-Y g:i A');
        }
        $hotels = $this->hotelService->getAll([], false);
        return view('bookings.add', compact(['action', 'hotels', 'booking', 'booking_duration']));
    }

    /**
     * @param UpdateStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, $id) {
        not_permissions_redirect(have_premission(12));
        $this->service->update($request->all(), $id);
        $request->session()->flash('success_message', 'Booking have been updated successfully!');
        return redirect("/bookings");
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        not_permissions_redirect(have_premission(13));
        $id = \Hashids::decode($id)[0];
        $this->service->destroy($id);
        Session::flash('success_message', 'Booking have been deleted successfully!');
        return redirect("/bookings");
    }

    public function processApiStore(\App\Http\Requests\API\Bookings\StoreBookings $request) {
        $action = $request['action'];

        if ($action == 'Add') {
            $this->service->store($request->all());
        } else if ($action == 'Edit') {
            $validate = $request->validate(['id' => 'required']);
            if ($validate) {
                $update = $this->service->update($request->all(), $request['id']);
            }
        }

        return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully."], 200);
    }

    public function processApiGet() {
        $bookings = $this->service->getAll([], false);
        return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully.", "data" => $bookings], 200);
    }

}
