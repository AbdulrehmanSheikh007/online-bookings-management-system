<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUsersRequest;
use App\Http\Requests\Users\UpdateUsersRequest;
use App\Services\UsersService;
use App\Services\HotelService;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use Hashids;
use Hash;
use Session;
use Auth;
use Alert;
use File;

class UsersController extends Controller {

    public $service;
    public $hotelService;

    /**
     * UsersController constructor.
     * @param UsersService $service
     */
    public function __construct(UsersService $service, HotelService $hotelService) {
        $this->service = $service;
        $this->hotelService = $hotelService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index(Request $request) {
        not_permissions_redirect(have_premission(2));
        $filters = (!empty($request->all())) ? true : false;
        if (\Request::is('users')) {
            $users = $this->service->getAdminUsers($request->all());
        } else if (\Request::is('users/passengers')) {
            $users = $this->service->getPassengerUsers($request->all());
        }

        $hotels = $this->hotelService->getAll([], false);

        return view('users.list', compact(['users', 'hotels', 'filters']));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function show(Request $request) {
        not_permissions_redirect(have_premission(2));
        $filters = (!empty($request->all())) ? true : false;
        if (\Request::is('users')) {
            $users = $this->service->getAdminUsers($request->all());
        } else if (\Request::is('users/passengers')) {
            $users = $this->service->getPassengerUsers($request->all());
        }

        $hotels = $this->hotelService->getAll([], false);

        return view('users.list', compact(['users', 'hotels', 'filters']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        not_permissions_redirect(have_premission(3));

        $action = 'Add';
        $hotels = $this->hotelService->getAll([], false);
        return view('users.edit', compact(['action', 'hotels']));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'first_name' => ['required', 'string', 'max:255'],
                    'last_name' => ['required', 'string', 'max:255'],
                    'phone' => ['required', 'string', 'max:255'],
                    'cnic' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     * 
     */

    public function store(Request $request, $is_api = false) {
        $input = $request->all();
        $validate = [
            'first_name' => 'required',
            'last_name' => 'required',
            'cnic' => 'required',
            'email' => 'required|email',
            'ntn' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'address_line_1' => 'required',
            'postal_code' => 'required'
        ];



        $Type = (!empty($input['type'])) ? $input['type'] : 'users';
        $redirect_url = ($Type == 'passengers') ? 'users/passengers' : 'users';

        unset($input['type']);
        $userId = (isset($input['id']) || !empty($input['id'])) ? \Hashids::decode($input['id'])[0] : 0;

        /*
         * Validate 
         * Unique Username 
         * Create / Update 
         * For all type of users
         */
        if (isset($input['id']) && !empty($input['id']) && !isset($input['hotel_id'])) {
            $validate['username'] = ['required', Rule::unique('users')->ignore($userId)->where(function ($query) {
                            return $query->where('username', NULL);
                        })];
        }

        if (isset($input['hotel_id'])) {
            unset($input['username']);
            unset($validate['username']);
        } else if ($input['action'] != 'Edit' && !isset($input['hotel_id'])) {
            $validate['username'] = 'required|unique:users';
        }

        $rule = [];

        if (!empty($rule))
            $validate = array_merge($validate, $rule);

        $request->validate($validate);

        //Check for activation 
        if (isset($input['status']) && $input['status'] == 1) {
            $input['email_verified_at'] = date('Y-m-d H:i:s');
            $input['_token'] = NULL;
            $input['_token_expiry'] = NULL;
        }

        if (isset($input['hotel_id']) && !is_int($input['hotel_id'])) {
            $input['hotel_id'] = Hashids::decode($input['hotel_id'])[0];
        }

        //Do The Needful Actions 
        if ($input['action'] == 'Edit') {

            $input['id'] = Hashids::decode($input['id'])[0];
            $User = User::findOrFail($input['id']);

            unset($input['action']);
            $this->service->update($input, $input['id']);
            if ($is_api) {
                return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully."], 200);
            }
            //$User->update($input);
            $request->session()->flash('success_message', 'User updated successfully!');
        } else {
            not_permissions_redirect(have_premission(3));
            unset($input['action']);

//            $input['password'] = Hash::make(Str::random(14));
            $input['password'] = Hash::make("Admin@123");
            $User = $this->service->store($input);

            //Generate Activation link & email
            $this->service->password_reset($User->id);
            if ($is_api) {
                return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully."], 200);
            }
            $request->session()->flash('success_message', 'User added successfully!');
        }

        /*
         * Uploading Files
         * For User profile picture
         * For User CNIC 
         * Create / Update 
         */

        $path = storage_path('/app/');
        $img = array();
        if (isset($input['profile_img'])) {

            if (!empty($User->profile_img) && \File::exists($path . $User->profile_img)) {
                \File::delete($path . $User->profile_img);
            }

            $img_dir = "users";
            $img_name = Hashids::encode($request->user()->id) . time() . "profile." . $request->file('profile_img')->clientExtension();
            Storage::putFileAs($img_dir, $request->file('profile_img'), $img_name);
            $img['profile_img'] = $img_dir . "/" . $img_name;
        }

        if (isset($input['cnic_img'])) {
            if (!empty($User->cnic_img) && File::exists($path . $User->cnic_img)) {
                File::delete($path . $User->cnic_img);
            }
            $img['cnic_img'] = Storage::putFileAs('users', $request->file('cnic_img'), Hashids::encode($User->id) . time() . "cnic." . $request->file('cnic_img')->clientExtension());
        }

        if (!empty($img))
            $this->service->update($img, $User->id);

        return redirect($redirect_url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response 
     */
    public function edit(Request $request, $id) {
        not_permissions_redirect(have_premission(4));
        $id = Hashids::decode($id)[0];
        $action = 'Edit';
        $user = User::findOrFail($id);

        $roles = array();


        $hotels = $this->hotelService->getAll([], false);
        return view('users.edit', compact(['action', 'user', 'hotels']));
    }

    /**
     * @param UpdateUsersRequest $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersRequest $request, $id) {
        not_permissions_redirect(have_premission(4));
        return $this->service->update($request->all(), $id);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroy($id) {
        not_permissions_redirect(have_premission(5));
        $id = Hashids::decode($id)[0];
        if ($id <= 1) {
            Session::flash('error_message', 'Not Authorized.');
            return redirect('/users');
        }

        $user = $this->service->getOne($id);
        if ($user->id <= 1) {
            Session::flash('error_message', 'Default User cannot be deleted');
            return redirect('/users');
        }


        $this->service->destroy($id);
        Session::flash('success_message', 'User has been deleted successfully!');
        return redirect('/users');
    }

    public function forget_password(Request $request) {
        if (isset($request['username'])) {
            $request->validate(['username' => 'required']);
            $User = $this->service->getOne($request['username'], 'username');

            if ($User) {
                $this->service->password_reset($User->id);
                $request->session()->flash('success_message', 'Password reset link have been sent to your email!');
            } else {
                Session::flash('error_message', 'Invalid username, Please try another one!');
            }

            return redirect('/password/email');
        }

        return view('auth.passwords.email');
    }

    public function reset_password($user_id = null, $_token = null) {
        if ($user_id != null && !empty($user_id) && $_token != null && !empty($_token)) {
            $user_id = Hashids::decode($user_id)[0];

            $User = User::where(array('id' => $user_id, 'email_verified_at' => null, '_token' => $_token))->first();
            $data = array();
            $data['expired'] = 0;

            if ($User && $User->email_verified_at == null && $User->status == 0 && !empty($User->_token) && $User->_token != null && $User->_token_expiry != null && $User->_token_expiry >= date('Y-m-d H:i:s')) {
                $action = "";
                $username = $User->username;
                return view('auth.passwords.reset', compact(['action', 'User', '_token', 'username']));
            } else {
                //token or id is missing
                Session::flash('error_message', 'Link has been expired. Please try again with reset password to regenerate the link!');
                return redirect('/login');
            }
        } else {
            //token or id is missing
            Session::flash('error_message', 'Link is invalid. Please try again with a valid link!');
            return redirect('/login');
        }
    }

    public function update_password(Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required|confirmed|min:8'
        ]);
        if (isset($request['user_id'])) {
            $request['user_id'] = \Hashids::decode($request['user_id'])[0];
        }
        $User = $this->service->getOne($request['username'], 'username');
        if (!$User || $User->id != $request['user_id']) {
            Session::flash('error_message', 'Username is incorrect or link may expired!');
            return redirect()->back()->withInput();
        }
        $this->service->update_password($request->all());
        Session::flash('success_message', 'Password has been updated!');
        return redirect('/login');
    }

    public function processApiStore(Request $request) {
        $input = $request->all();
        $validate = [
            'first_name' => 'required',
            'last_name' => 'required',
            'cnic' => 'required',
            'email' => 'required|email',
            'ntn' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'address_line_1' => 'required',
            'postal_code' => 'required'
        ];

        $userId = (isset($input['id']) || !empty($input['id'])) ? $input['id'] : NULL;

        /*
         * Validate 
         * Unique Username 
         * Create / Update 
         * For all type of users
         */
        if (isset($input['id']) && !empty($input['id']) && !isset($input['hotel_id'])) {
            $validate['username'] = ['required', Rule::unique('users')->ignore($userId)->where(function ($query) {
                            return $query->where('username', NULL);
                        })];
        }

        if (isset($input['hotel_id'])) {
            unset($input['username']);
            unset($validate['username']);
        } else if ($input['action'] != 'Edit' && !isset($input['hotel_id'])) {
            $validate['username'] = 'required|unique:users';
        }

        $rule = [];

        if (!empty($rule))
            $validate = array_merge($validate, $rule);

//        $validator = $request->validate($validate);

        $validator = Validator::make($input, $validate);
        if ($validator->fails()) {
            //pass validator errors as errors object for ajax response
            return response()->json(['errors' => $validator->errors()]);
        }

        //Check for activation 
        if (isset($input['status']) && $input['status'] == 1) {
            $input['email_verified_at'] = date('Y-m-d H:i:s');
            $input['_token'] = NULL;
            $input['_token_expiry'] = NULL;
        }

        if (isset($input['hotel_id']) && !is_int($input['hotel_id'])) {
            $input['hotel_id'] = Hashids::decode($input['hotel_id'])[0];
        }

        //Do The Needful Actions 
        if ($input['action'] == 'Edit') {
            $User = User::findOrFail($input['id']);
            unset($input['action']);
            $this->service->update($input, $input['id']);
        } else {
            unset($input['action']);

            $input['password'] = Hash::make("Admin@123");
            $User = $this->service->store($input);

            //Generate Activation link & email
            $this->service->password_reset($User->id);
        }

        return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully."], 200);
    }

    public function processApiGet() {
        $users = $this->service->getAdminUsers([], false);
        return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully.", "data" => $users], 200);
    }
    
    public function processApiGetPassengers() {
        $users = $this->service->getPassengerUsers([], false);
        return response(["code" => 200, "status" => "Success", "message" => "Request Entertained Successfully.", "data" => $users], 200);
    }

}
