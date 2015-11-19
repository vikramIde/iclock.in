<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PaymentRequest;
use App\User;
use App\Invoice;
use App\comments;
use App\paymentrecieved;
use Session;
use Validator;


class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

  public function __construct(){

    $this->middleware('role:collector'); // replace 'collector' with whatever role you need.
}

  public function getIndex(){

    return redirect('collection/home');   
}

  public function getHome(){

      $empid= Auth::user()->empid;
      $invoice = Invoice::where('Status','=',1)->orderBy('Id', 'desc')->get();

    
    return View('collectionmodule/home')->with(array('invoices'=>$invoice));
   
 }

   public function getPayment($invoiceid){

         $id =$invoiceid;
         $invoice = Invoice::with(['payments', 'comments'])->where('Id', $id)->get();
          //dd($invoice);

         return View('collectionmodule/payment')->with(array('invoice'=>$invoice));
   
 }
 
  public function saveComment($comments,$date,$invoiceid){
  		$comment= new comments();
		
		// $result = paymentrecieved::create($data);

          $comment->text = ucfirst(strtolower($comments));
          $comment->date = $date;
          $comment->invoice_id = $invoiceid;
          $comment->save();
		
  
  }
  
  public function postPayment(PaymentRequest $request){

          $insertPayment=Input::get();

          $payment= new paymentrecieved();
          

         $data=array();

          for($i = 0; $i < count($insertPayment['recieved_amount']); $i++) {

                if($insertPayment['adjustmentmode'][$i]=='Option')
                $adjust_mode='NONE';
                else
                  $adjust_mode=$insertPayment['adjustmentmode'][$i];

                $payment->invoice_id=$insertPayment['invoiceid'][$i];
                $payment->recieved_amount = $insertPayment['recieved_amount'][$i];
                $payment->refno = $insertPayment['ref_no'][$i];
                $payment->date = $insertPayment['date'][$i];
                $payment->adjust_amount = $insertPayment['adjustmentamount'][$i];
                $payment->adjust_mode= $adjust_mode;
                $payment->save();

         }

         // $result = paymentrecieved::create($data);
		  $this->saveComment($insertPayment['comment'],$insertPayment['date1'],$insertPayment['invoiceid']);


          $request->session()->flash('alert-success', 'Payment Has Been inserted Successfully');
          return redirect('collection/payment/'.$insertPayment['invoiceid'].'');

        }
		
	public function postComments(){
			$insertcomment = Input::get();
			$this->saveComment($insertcomment['comment'],$insertcomment['date'],$insertcomment['invoiceid']);	
		
	}
          //dd($insertPayment); 
 }
