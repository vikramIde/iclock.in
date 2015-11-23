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
                 $userData[$key]['startdate']=$target->Targetassigned;
                  $userData[$key]['enddate']=$target->Targetdate;

        foreach ($deals as $deal) {

            if($target->Eventname == $deal->Eventname && $target->Employeeid == $deal->Empid)
            {
                $achieved = $achieved+$deal->Dealvalue;
          }
        }

        $userData[$key]['achieved']=$achieved;
        $userData[$key]['variance']=$achieved-$target->Targetvalue;
       

       
      
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

// $empdetails=User::where('empid','=',$userid)->with(array('deals'=>function($query) use($userid){ 
//     $query->where('Empid','=',$userid);})
// )->with(array('target'=>function($query) use($userid){ 
//     $query->where('Employeeid','=',$userid);})
// )->get();

    // $empdetails=User::where('empid','=',$userid)->with('deals')->with('target')->get();


// dd($userData);


// $deals=Deal::where('Empid',$userid)->get();


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

public function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
    $interval can be:
    yyyy - Number of full years
    q - Number of full quarters
    m - Number of full months
    y - Difference between day numbers
        (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
    d - Number of full days
    w - Number of full weekdays
    ww - Number of full weeks
    h - Number of full hours
    n - Number of full minutes
    s - Number of full seconds (default)
    */
    
    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds
     
    switch($interval) {
     
    case 'yyyy': // Number of full years
        $years_difference = floor($difference / 31536000);
        if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
            $years_difference--;
        }
        if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
            $years_difference++;
        }
        $datediff = $years_difference;
        break;
    case "q": // Number of full quarters
        $quarters_difference = floor($difference / 8035200);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $quarters_difference--;
        $datediff = $quarters_difference;
        break;
    case "m": // Number of full months
        $months_difference = floor($difference / 2678400);
        while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
            $months_difference++;
        }
        $months_difference--;
        $datediff = $months_difference;
        break;
    case 'y': // Difference between day numbers
        $datediff = date("z", $dateto) - date("z", $datefrom);
        break;
    case "d": // Number of full days
        $datediff = floor($difference / 86400);
        break;
    case "w": // Number of full weekdays
        $days_difference = floor($difference / 86400);
        $weeks_difference = floor($days_difference / 7); // Complete weeks
        $first_day = date("w", $datefrom);
        $days_remainder = floor($days_difference % 7);
        $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
        if ($odd_days > 7) { // Sunday
            $days_remainder--;
        }
        if ($odd_days > 6) { // Saturday
            $days_remainder--;
        }
        $datediff = ($weeks_difference * 5) + $days_remainder;
        break;
    case "ww": // Number of full weeks
        $datediff = floor($difference / 604800);
        break;
    case "h": // Number of full hours
        $datediff = floor($difference / 3600);
        break;
    case "n": // Number of full minutes
        $datediff = floor($difference / 60);
        break;
    default: // Number of full seconds (default)
        $datediff = $difference;
        break;
    }    
    return $datediff;
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
                $dealx[$key1]['cost'] = (float)$deal->Dealvalue;

          }
        }

        $userData[$key]['achieved']=$achieved;
        $userData[$key]['variance']=$achieved-$target->Targetvalue;
        $userData[$key]['cur']= $target->Currency;
        $date2= strtotime(date('d-m-Y'));
        $date1=$target->Targetdate;
         $date5=$target->Targetassigned;
         // dd($date5);
        $date3=strtotime($target->Targetdate);
        $diff=$date3-$date2;
        $days=floor($diff/(60*60*24));
        // dd($days); 
        $userData[$key]['dayleft']=$days;
        $key++;
  }

    $dealjson = json_encode($dealx);
    // dd($dealjson);
    return View('targetmodule/variancecard')->with(array('target'=>$targets,'userdata'=>$userData, 'variancedata'=>$variancedata,'eventdate'=>$date1,'targetdate'=>$date5,'dealjson'=>$dealjson));

}
    

    }
