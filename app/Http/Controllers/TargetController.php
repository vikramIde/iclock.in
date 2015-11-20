<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Deal;
use App\Employee;
use App\Targetassign;
use DateTime;
use DateInterval;
use DatePeriod;
use App\Event;
use Session;
use Validator;


class TargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
      
    $empid= Auth::user()->empid;
    $userdetails = User::where('empid',$empid)->get();
    $targets = Targetassign::where('Employeeid',$empid)->get();
     foreach($targets as $target)
      $ecode = $target['Eventcode'];

    $deals = Deal::where('Empid',$empid)->get();
    $eventDate = Event::where('eventcode',$ecode)->select('date')->get();
    $userData = array();
    $variancedata=array();
    $key = 0 ;
     foreach($eventDate as $val)
      $eventdate = $val['date'];

foreach ($targets as $target) {

                $achieved = 0;
                 $userData[$key]['eventc']=$target->Eventcode;
                $userData[$key]['event']=$target->Eventname;
                   $userData[$key]['cur']= $target->Currency;
                $userData[$key]['targetVal']=$target->Targetvalue;

                  $userData[$key]['start']=$target->Targetassigned;
                   $userData[$key]['end']=$target->Targetdate;

        foreach ($deals as $deal) {

            if($target->Eventname == $deal->Eventname && $target->Employeeid==$deal->Empid)
            {
                $achieved = $achieved+$deal->Dealvalue;
          }
        }

        $userData[$key]['achieved']=$achieved;
        $userData[$key]['variance']=$achieved-$target->Targetvalue;
        // $userData[$key]['cur']= $target->Currency;

      
        $date2= strtotime(date('d-m-Y'));

         $date1=$target->Targetdate;
        $date3=strtotime($target->Targetdate);

        if($date2>$date3){
            $days=0;
              $userData[$key]['dayleft']=$days;


        }
        else{

        $diff=$date3-$date2;
        $days=floor($diff/(60*60*24));
        // dd($days); 
        $userData[$key]['dayleft']=$days;

        }
      
        $key++;
}

      return View('targetmodule/targethome')->with(array('deals'=>$deals,'userdata'=>$userData,'target'=>$targets,'variancedata'=>$variancedata));
    }
     
   public function postAddemployee( Request $request ) {
         $rules = array(
                'empname'=>'required',
                'empid'=>'required',
                'emppos'=>'required',
                'empdept'=>'required'

              );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('targetmodule/admin')->withErrors($validator);
    }else {
   $data = Input::get();
   
       
     $c= new Employee();
     
     $c->emp_name = $data['empname'];
     $c->emp_ide_id = $data['empid'];
     $c->emp_position = $data['emppos'];
     $c->emp_department  = $data['empdept'];
    
    $c->save();
     
 
        
    }   
       $request->session()->flash('alert-success', 'Target Has Been Assigned Successfully');
      return redirect('targetmodule/admin');
        // 
    
}

public function getVariancecard(){

        $dealjson='';
      $empid= Auth::user()->empid;
      $targets = Targetassign::where('Employeeid',$empid)->get();
      $variancedata=array();
      $targetdate =0;
      $eventdate =0;
      return View('targetmodule/variancecard')->with(array('dealjson'=>$dealjson,'target'=>$targets,'variancedata'=>$variancedata,'targetdate'=>$targetdate,'eventdate'=>$eventdate));
}



public function postVariancecard(){
			$empid= Auth::user()->empid;
			$eventName = Input::get('event');
			$targets = Targetassign::where('Employeeid',$empid)->where('Eventname',$eventName)->get();
			$variancedata=$targets;
			$deals = Deal::where('Eventname',$eventName)->where('Empid',$empid)->get();
		
			$eventDate = Event::where('event',$eventName)->select('date')->get();
			$userData = array();
			$key = 0 ;
		
		
			foreach($eventDate as $val)
			  $eventdate = $val['date'];
		
			foreach ($targets as $target) {
						$achieved = 0;
						$userData[$key]['event']=$target->Eventname;
						  $userData[$key]['eventcode']=$target->Eventcode;
						$userData[$key]['targetVal']=$target->Targetvalue;
		
				foreach ($deals as $key1=> $deal) {
		
					if($target->Eventname == $deal->Eventname){
						$achieved = $achieved+$deal->Dealvalue;
						$dealx[$key1]['dealdate'] = $deal->Dealdate;
						$dealx[$key1]['cost'] = $deal->Dealvalue;
				  }
				}
		
				$userData[$key]['achieved']=$achieved;
				$userData[$key]['variance']=$achieved-$target->Targetvalue;
				$userData[$key]['cur']= $target->Currency;
				$date2= strtotime(date('d-m-Y'));
				$date1=$target->Targetdate;
				$date3=strtotime($target->Targetdate);
				$diff=$date3-$date2;
				$days=floor($diff/(60*60*24));
				// dd($days); 
				$userData[$key]['dayleft']=$days;
				$key++;
		  }
			$dealjson = json_encode($dealx);
			// dd($dealjson);
			return View('targetmodule/variancecard')->with(array('target'=>$targets,'userdata'=>$userData, 'variancedata'=>$variancedata,'eventdate'=>$eventdate,'targetdate'=>$date1,'dealjson'=>$dealjson));

    $empid= Auth::user()->empid;
    $eventName = Input::get('event');
    $targets = Targetassign::where('Employeeid',$empid)->where('Eventname',$eventName)->get();
    $variancedata=$targets;
    $deals = Deal::where('Eventname',$eventName)->where('Empid',$empid)->get();

    $eventDate = Event::where('event',$eventName)->select('date')->get();
    $userData = array();
    $key = 0 ;


    foreach($eventDate as $val)
      $eventdate = $val['date'];

    foreach ($targets as $target) {
                $achieved = 0;
                $userData[$key]['event']=$target->Eventname;
                  $userData[$key]['eventcode']=$target->Eventcode;
                $userData[$key]['targetVal']=$target->Targetvalue;

        foreach ($deals as $key1=> $deal) {

            if($target->Eventname == $deal->Eventname && $target->Employeeid==$deal->Empid){
                $achieved = $achieved+$deal->Dealvalue;
                $dealx[$key1]['dealdate'] = $deal->Dealdate;
                $dealx[$key1]['cost'] = $deal->Dealvalue;
          }
        }

        $userData[$key]['achieved']=$achieved;
        $userData[$key]['variance']=$achieved-$target->Targetvalue;
        $userData[$key]['cur']= $target->Currency;
        $date2= strtotime(date('d-m-Y'));
        $date1=$target->Targetdate; //due date for completion
        $date4=$target->Targetassigned; // taget assigned date
        $date3=strtotime($target->Targetdate);
        $diff=$date3-$date2;
        $days=floor($diff/(60*60*24));
        // dd($days); 
        $userData[$key]['dayleft']=$days;
        $key++;
  }
    $dealjson = json_encode($dealx);
    // dd($dealjson);
    return View('targetmodule/variancecard')->with(array('target'=>$targets,'userdata'=>$userData, 'variancedata'=>$variancedata,'eventdate'=>$date4,'targetdate'=>$date1,'dealjson'=>$dealjson));

}
    

    }
