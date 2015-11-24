<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Event;
use App\User;
use App\Employee;
use App\Invoice;
use App\Adduser;
 use Hash;

class AddUserController extends Controller
{
   public function getIndex(){
         
      
      return View('targetmodule/adduser');
    }
    
    public function postUser(Request $request)
    {
      $rules = array(
         'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            

      );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('targetmodule/adduser')->withErrors($validator);
    }else {

$data = Input::get();
$role='';

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $role,
        ]);

        $request->session()->flash('alert-success', 'User added!');
      return redirect('targetmodule/adduser');
    }



    }

    public function getResetpass( Request $request){

            return view('resettargetpassword');
}
   public function postReset( Request $request ) {
         $rules = array(
                  'password' => 'required|confirmed'
                  // 'password_confirmation' => 'required|confirmed'

              );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return view('resettargetpassword')->withErrors($validator);
    }else {
       $userid=Input::get('userid');

  $post = Input::get();
  $pass=\Hash::make( $post['password']);
$i=User::where('id',$userid)
            ->update(array(
              'password' => $pass)
             
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
              return view('resettargetpassword');
 
            }

   
 
        
    }   
       
    
}

}