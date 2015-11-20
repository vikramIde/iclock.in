<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\Role;
use App\Event;
use App\Employee;
use App\Invoice;
use Mail;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
public function __construct(){

    $this->middleware('role:admin2'); // replace 'collector' with whatever role you need.
}
    
    public function getIndex(){
         $categories = Event::all();
     $employee = Employee::all();
     
    $invoice = Invoice::all();
    $invnull = Invoice::where('Status', '=', 'Null')->get();


      return View('home2')->with(array('categories'=>$categories,'employee'=>$employee,'invoice'=>$invoice,'invnull'=>$invnull));
    }

    public function postApproveinvoice( Request $request) {
 $approve_id=Input::get('invoice_approve_id');

  $post = Input::get();
$i=Invoice::where('Id',$approve_id)->update(array(
              'Status' => $post['approve_status'])
            );
 $invoicedata=Invoice::where('Id',$approve_id)->get();
 
        foreach($invoicedata as $inv){
          $email=$inv->ClientEmail;
          $invno=$inv->InvoiceCode;
          $clientmail=$inv->ClientName;
        }
        
   
            if($i>0){

              $html22 =  View('pdfgenerate')->with(array('invoicedata'=>$invoicedata ))->render();


    $html1 = "<h1>adsfadsfasdf</h1>";
        require_once(app_path().'/libs/html2pdf/html2pdf.class.php');


      $html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

      // $html2pdf->pdf->SetDisplayMode('fullpage');

      $html2pdf->WriteHTML($html22);

      $htmltosend=$html2pdf->Output('','S');
      $a='IDE | Proforma invoice_';
     
      
$subject = $a.$invno.$clientmail;
Mail::send('emails.invoice',['Invoice' => 'hgff'], function($message) use ($subject,$htmltosend,$email ) {
  // note: if you don't set this, it will use the defaults from config/mail.php
  $message->from('invoice@ide-global.com', 'IDE Consulting Services Pvt Ltd');
  $message->to($email)
    ->subject($subject)
    ->attachData($htmltosend,'invoice.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));
});

              $request->session()->flash('alert-success', 'Invoice has been set to client !');
return redirect('home2');
 
            }

    
}

public function postRejectinvoice( Request $request) {
 $approve_id=Input::get('invoice_reject_id');

  $post = Input::get();
$i=Invoice::where('Id',$approve_id)->update(array('RejectedwithComments' => $post['reject_comment'],
              'Status' => $post['reject_status'])
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home2');
 
            }

    
}




    }
