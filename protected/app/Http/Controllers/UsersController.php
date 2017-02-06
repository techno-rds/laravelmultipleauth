<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Hash,DB,Input,Session;

class UsersController extends Controller
{
    public function getSignIn()
    {
        return view('user.index');    
    }
    
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
               return redirect()->action('UsersController@anyDashboard');
            } else {
               return redirect()->action('UsersController@getSignIn');
            }
        } 
    }
    
    public function anyDashboard()
    {
        $auth = auth()->guard('user');
        if($auth->check())
        {
            $user = $auth->user();
            pr($user->toArray());exit;
        }
        /**
        $record = new User;
        $record->v_name = 'TestUser';
        $record->v_email  = 'testing.demo@gmail.com';
        $record->password = Hash::make('this.admin');
        $record->save(); */
    }
    
    public function anyLogout()
    {
        auth()->guard('user')->logout();
        return redirect()->action('UsersController@getSignIn');
    }
}
