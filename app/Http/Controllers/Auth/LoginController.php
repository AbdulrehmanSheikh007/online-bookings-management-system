<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt(['username' => request('username'), 'password' => request('password'), '_token' => NULL, 'status' => 1, '_token_expiry' => NULL, 'deleted_at' => NULL])) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }else{
            $request->session()->flash('error_message', 'Credentials are invalid!');
            return redirect('/login'); 
        }
    }

}
