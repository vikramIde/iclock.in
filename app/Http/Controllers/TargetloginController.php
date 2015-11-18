<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use Session;
use Validator;

class TargetloginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
       


      return View('targetmodule/targetlogin');
    }
     public function postTargetlogin(){
      $rules = array(
        
     'email'=>'required',
      'password'=>'required'
     
      );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('targetmodule/targetlogin')->withErrors($validator);
    }else {

           


        $cred = array(
                'email' => Input::get('email'),
                'password' => Input::get('password')
            );
          $role = User::where('email','=',Input::get('email'))->first();
  
        if (Auth::attempt($cred) && $role->role == ''){
            if (Auth::check()){
                Session::put('role','');
                Session::put('name',Auth::user()->name);
               return redirect('targetmodule/targethome');
            }
            
        } 
        else 
        if (Auth::attempt($cred) && $role->role == 'director'){
            if (Auth::check()){
                Session::put('role','director');
                Session::put('name',Auth::user()->name);
                return redirect('targetmodule/admin');
            }
           
        } 
       
        else{
                Session::flush();
                Auth::logout();
                 return redirect('targetmodule/targetlogin')->with('login_errors',true);
            }
    }


    }

    }
