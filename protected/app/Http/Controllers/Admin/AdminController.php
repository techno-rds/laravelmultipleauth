<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use Illuminate\Http\Request;
use Hash,DB,Input, Session;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function getSignIn()
    {
        return view('admin.index');    
        /**
        $record = new Admin;
        $record->v_name = 'TestAdmin';
        $record->v_email  = 'testing.admin@gmail.com';
        $record->password = Hash::make('this.admin');
        $record->save(); */
    }
    
    public function postSignIn()
    {
        if(Input::all())
        {
            $strRemember = (Input::has('remember') ? true : false);
            $auth = auth()->guard('admin');
            $objAuth = $auth->attempt(array( 
                    'v_email' => Input::get('v_email'),
                    'password' => Input::get('password'),
            ),$strRemember);
            //echo $strRemember;exit;
            if($objAuth)
            {
               return redirect()->action('Admin\AdminController@anyDashboard');
            } else {
               return redirect()->action('Admin\AdminController@getSignIn');
            }
        }
    }
    
    public function anyDashboard()
    {
        $auth = auth()->guard('admin');
        if($auth->check())
        {
            $user = $auth->user();
            pr($user->toArray());exit;
        }
    }
    
    public function anyLogout()
    {
        auth()->guard('admin')->logout();
        return redirect()->action('Admin\AdminController@getSignIn');
    }
}
