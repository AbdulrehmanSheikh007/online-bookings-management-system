<?php

namespace App\Http\Middleware;

use App\Stores;
use Carbon\Carbon;
use Closure;

class AuthenticateStore {

    protected $subKey = "AbdulRehmanSheikh";

    public function __construct() {
        
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $response = null;
        $subKey = null;
        $subKey = ($request->header('subKey')) ? $request->header('subKey') : null;

        if (!$subKey && !$response) {
            $response = response()->json([
                'code' => 401,
                'status' => 'Unauthorized',
                'message' => 'Please provide subscription key',
                'validation_params_error' => [
                    'subKey' => 'subKey missing in header'
                ]
            ]);
        }


        if ((!$subKey || $subKey != $this->subKey) && !$response) {

            $response = response()->json([
                'code' => 404,
                'status' => 'Not Authorized',
                'message' => 'Your subscription key is not authorized to use our services',
            ]);
        }


        if (!$response) {
            $response = $next($request);
        }

        return $response;
    }

}
