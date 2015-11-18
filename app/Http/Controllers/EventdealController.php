<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Event;
use App\Deal;
use App\Targetassign;
use Session;
use Validator;

class EventdealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex(){
       $varr= Auth::user()->empid;
       $empid=Targetassign::where('Employeeid',$varr)->get();


        $cat=Event::all();
       
      return View('targetmodule/eventdeal')->with(array('cat' =>$cat,'empid'=>$empid));
    }
     
public function postDealinsert( Request $request ) {
  $rules = array(
        
     'eventname'=>'required',
     'company'=>'required',
      'dealdate'=>'required',
     'deal_value'=>'required',
      'deal_curr'=>'required',
      'sent_date'=>'required',
     'rec_date'=>'required',
     'deal_type'=>'required'

      );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('targetmodule/eventdeal')->withErrors($validator);
    }else {


   $data = Input::get();
   
       $dealstatus='1';
     $c= new Deal();
     
      $c->Clientname = $data['clientname'];
       $c->Companyname = $data['company'];
      $c->Eventname  = $data['eventname'];
      $c->Dealdate = $data['dealdate'];
      $c->Dealvalue = $data['deal_value'];
      $c->Dealtype= $data['deal_type'];
      $c->Dealcurr = $data['deal_curr'];
      $c->ConSentdate = $data['sent_date'];
      $c->ConRecdate = $data['rec_date'];
      $c->Empid = $data['emp_id'];
      $c->Status=$dealstatus;


       $c->save();
     
       $request->session()->flash('alert-success', 'Deal Has Been inserted Successfully');
      return redirect('targetmodule/eventdeal');
        // 
    
}
    }

    }
