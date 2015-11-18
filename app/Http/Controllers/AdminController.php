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
use App\Employee;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
         $employee = Employee::all();
      
      return View('targetmodule/admin')->with(array('employee'=>$employee));
    }
     

    public function postUpdateadmin( Request $request) {
 $emp_id_d=Input::get('emp_id_d');

  $post = Input::get();
$i=Employee::where('emp_id',$emp_id_d)
            ->update(array(
              'emp_name' => $post['emp_name'],
              'emp_ide_id' => $post['emp_id'],'emp_status' => $post['emp_status'],
              'emp_department' => $post['emp_dept'])
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('targetmodule/admin');
 
            }

    
}


    }
