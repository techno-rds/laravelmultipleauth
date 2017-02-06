<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash,DB,Input;

class UsersController extends Controller
{
    public function postSignIn()
    {
        if(Input::all())
        {
            $strRemember = (Input::has('remember') ? true : false);
            $auth = auth()->guard('user');
            $objAuth = $auth->attempt(array( 
                    'v_email' => Input::get('v_email'),
                    'password' => Input::get('password'),
            ),$strRemember);
            //echo $strRemember;exit;
            if($objAuth)
            {
               $user = $auth->user(); 
               return response()->json(['user'=>$user]);
            } else {
                echo 'Error';exit;
            }
        } 
    }
    
    public function anyDashboard()
    {
        $auth = auth()->guard('user');
        $user = $auth->user();
        return response()->json(['success'=>$user]);
        /**
        $record = new User;
        $record->v_name = 'TestUser';
        $record->v_email  = 'testing.demo@gmail.com';
        $record->password = Hash::make('this.admin');
        $record->save(); */
    }
}
