<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Deal;
use Session;
use Validator;
use App\Employee;
use App\Event;
use App\Targetassign;

class AssigntargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
         $employee = Employee::all();
           $categories = Event::all();
           
    $userdetails = User::all();
    $targets = Targetassign::all();
    $deals = Deal::all();
    $userData = array();
    $key = 0 ;

foreach ($targets as $target) {

            $achieved = 0;
               $userData[$key]['eventcode']=$target->Eventcode;  
                $userData[$key]['event']=$target->Eventname;
                 $userData[$key]['employee']=$target->Employeeid;
                

                $userData[$key]['targetVal']=$target->Targetvalue;
        foreach ($deals as $deal) {
           // $userData[$key]['employeename']=$deal->Empname;

            if($target->Eventname == $deal->Eventname)
            {
                $achieved = $achieved+$deal->Dealvalue;
          }
        }
        $userData[$key]['achieved']=$achieved;
        $userData[$key]['variance']=$achieved-$target->Targetvalue;
        $userData[$key]['cur']= $target->Currency;

        //$userData['dayleft']=$deal->Eventname;
        $key++;
}
      
      return View('targetmodule/assigntarget')->with(array('categories'=>$categories,'employee'=>$employee,'userdata'=>$userData,'targets'=>$targets));
    }
     
   public function postTargetassign( Request $request ) {
 $rules = array(
        'employeeid'=>'required',
        'eventname'=>'required',
        'target_value'=>'required',
        'target_date'=>'required',
        'currency'=>'required',
        'modeoftarget'=>'required'

      );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('targetmodule/assigntarget')->withErrors($validator);
    }else {
   $data = Input::get();
   
      $targetdata=Targetassign::where('Eventname',$data['eventname'])->where('Employeeid',$data['employeeid'])->get();
      // dd(count($targetdata)) ;
      if(count($targetdata)==0){
         $c= new Targetassign();
     
     $c->Employeeid = $data['employeeid'];
      $c->Eventname  = $data['eventname'];
      $c->Targetvalue = $data['target_value'];
      $c->Currency  = $data['currency'];
       $c->Targetdate  = $data['target_date'];
        $c->Modeoftarget  = $data['modeoftarget'];

       $c->save();

      }
      else
      {
        return redirect('targetmodule/assigntarget')->with('target_error',true);

      }
    
     
 
        
    }   
       $request->session()->flash('alert-success', 'Target Has Been Assigned Successfully');
      return redirect('targetmodule/assigntarget');
        // 
    
}

    

    }
