<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

/**
 * Description of DashboardController
 *
 * @author abdulrehman
 */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hashids;
use Session;
use App\User;
use App\Hotel;
use App\Bookings;

class DashboardController extends Controller {

    public function __construct() {
        
    }

    /*
     * Dashboard View (User Specific)
     */

    public function dashboard() {
        $hotels = Hotel::count();
        $admins = User::where("hotel_id", "")->count();
        $passengers = User::where("hotel_id", "!=", "")->count();
        $bookings = Bookings::count();
        return view('dashboard.dashboard', compact(['hotels', 'bookings', 'admins', 'passengers']));
    }

}
