<?php

namespace App\Http\Controllers;

use App\Http\Requests\Hotel\StoreHotelRequest;
use App\Http\Requests\Hotel\UpdateHotelRequest;
use App\Services\HotelService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Hashids;
use Form;
use Session;

class HotelsController extends Controller {

    public $service;

    /**
     * StoreController constructor.
     * @param HotelService $service
     */
    public function __construct(HotelService $service) {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request) {
        not_permissions_redirect(have_premission(10));
        $hotels = $this->service->getAll($request->all());
        return view('hotels.list', compact(['hotels']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        not_permissions_redirect(have_premission(11));
        $action = 'Add';
        $hotel = app('request')->old();
        return view('hotels.add', compact(['action', 'hotel']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStoreRequest|Request $request 
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelRequest $request) {
        not_permissions_redirect(have_premission(11));
        $action = $request['action'];
        if ($action == 'Add') {
            $this->service->store($request->all());
            $request->session()->flash('success_message', 'Store have been created successfully!');
            return redirect()->route('hotels.index');
        } else if ($action == 'Edit') {
            $update = $this->service->update($request->all(), $request['id']);
            if (!$update)
                return redirect()->back()->withInput();
            else
                return redirect()->route('hotels.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        not_permissions_redirect(have_premission(14));
        $brand = $this->service->getStore($id);

        $products = [];
        return view('brands.info', compact('brand', 'products'));
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
        $hotel = $this->service->getOne($id);
        return view('hotels.add', compact(['action', 'hotel']));
    }

    /**
     * @param UpdateStoreRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, $id) {
        not_permissions_redirect(have_premission(12));
        $this->service->update($request->all(), $id);
        $request->session()->flash('success_message', 'Store have been updated successfully!');
        return redirect()->route('brands.index');
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        not_permissions_redirect(have_premission(13));
        $id = \Hashids::decode($id)[0];
        $this->service->destroy($id);
        Session::flash('success_message', 'Store have been deleted successfully!');
        return redirect()->route('hotels.index');
    }

    public function processApiStore(\App\Http\Requests\API\Hotels\StoreHotels $request) {
        $action = $request['action'];

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
        $hotels = $this->service->getAll([], false);
        return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully.", "data" => $hotels], 200);
    }

}
