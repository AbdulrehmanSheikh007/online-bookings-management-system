<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Auth;

class ProfileController extends Controller {

    public $service;

    /**
     * BrandController constructor.
     * @param ProfileService $service
     * @param CountriesService $countriesService
     * @param CitiesService $citiesService
     */
    public function __construct(ProfileService $service) {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $action = 'profile';
        $profile = $this->service->getProfile(Auth::user()->id, 'id');
        return view('profile.edit', compact(['profile', 'action']));
    }

    /**
     * @param UpdateProfileRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id) {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'cnic' => 'required',
            'ntn' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address_line_1' => 'required',
            'postal_code' => 'required',
        ]);
        $action = $request->input('action');
        if ($action == "profile" || $action == "password") {
            $validated = $request->validated();
            $this->service->update($request, $id);

            $request->session()->flash('success_message', '' . ucfirst($action) . ' has been updated');
            return redirect("/profile");
        }
        //
    }


}
