<?php
namespace App\Http\Middleware\Api;

use Closure,Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthManager;
use Illuminate\Auth\TokenGuard;

class AuthenticateApi
{   
    public function __construct(Request $request, AuthManager $auth)
    {
        $this->HeaderSecKey = 'Authorization';
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next, $guard = 'api') 
    {
        if($this->auth->guard('api')->user())
        {
            return $next($request);  
        }
        else
        {
            return 'Error';
            //response(['code' => HTTP_UNAUTHORIZED,'message' => UNAUTHORIZED_MESSAGE,'data'=>(object) null],HTTP_UNAUTHORIZED) 
        }   
    }
}
