<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Middleware\Role;
use Illuminate\Support\Facades\Validator;
use App\Event;
use App\Employee;
use App\Invoice;
use App\Deal;
use Mail;
use View;

class EventController extends Controller
{

  

    public function getIndex(){
      $categories = Event::all();
     $employee = Employee::all();
      $invoice = Invoice::orderBy('Id', 'desc')->get();
    
      return View('home1')->with(array('categories'=>$categories,'employee'=>$employee,'invoice'=>$invoice));
    }

   
    public function postEvent( Request $request ) {
 $rules = array(
        'eventname'=>'required',
        'eventcode'=>'required',
        'date'=>'required',
        'city'=>'required',
        'country'=>'required'

      );

    $validator = Validator::make(Input::all(), $rules);

    if ($validator->fails())
    {
        return redirect('home1')->withErrors($validator);
    }else {
   $data = Input::get();
     

    for($i = 0; $i < count($data['eventname']); $i++) {
       
     $c= new Event();
     
     $c->event = $data['eventname'][$i];
     $c->eventcode = $data['eventcode'][$i];
      $c->date  = $data['date'][$i];
      $c->city = $data['city'][$i];
      $c->country  = $data['country'][$i];

       $c->save();
     
 }
        
    }   
       $request->session()->flash('alert-success', 'Event was successful added!');
      return redirect('home1');
        // 
    
}


/*update emp information*/

public function postUpdate( Request $request) {
 $emp_id_d=Input::get('emp_id_d');

  $post = Input::get();
$i=Employee::where('emp_id',$emp_id_d)
            ->update(array(
              'emp_name' => $post['emp_name'],
              'emp_ide_id' => $post['emp_id'],
              'emp_department' => $post['emp_dept'])
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }

    
}

/*update event information*/

public function postEventupdate( Request $request) {
 $evnid=Input::get('even_id');

  $post = Input::get();
$i=Event::where('id',$evnid)
            ->update(array(
              'event' => $post['eventname'],
              'city' => $post['eventcity'],
              'country'=>$post['eventcountry'],
              'date' => $post['eventdate'])
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }

    
}


/*Invoice generation*/

public function postInvoice( Request $request ) {
  $dealid=Input::get('dealid');
 
$variable=Input::get('purpose');
$inv='IDE';
$nameofinvoice='PROFORMA INVOICE';

$dateValue=date('d-m-Y');
$time=strtotime($dateValue);
$year=date("Y",$time);

$count = Invoice::all()->count();
$counti=$count+001;
$invoicecode=$inv.$year.$counti;

$varr='Null';
$st='Invoice Created';
$dealstatus='0';

if($variable=='annual'){
$c= new Invoice();
 $c->Particulars=Input::get('purpose');
$c->CientAddress=Input::get('client_address');
$c->ClientName=Input::get('client_name');
$c->Companyname=Input::get('companyname');
$c->ClientEmail=Input::get('client_email');

$c->RepresentativeNo=Input::get('rep_id');
$c->InvoiceDate=Input::get('invoice_date');
$c->DueDate=Input::get('due_date');

$c->AnnualSerialNo=Input::get('s_no_anuual1');
$c->AnnualText=Input::get('anuual_text');
$c->AnnualCurrencyType=Input::get('annual_currency1');
$c->AnnualAmount=Input::get('annual_amount1');
$c->SerialNo=Input::get('s_no');
$c->Eventcode=Input::get('eventcode');
$c->EventName=Input::get('event_name');
$c->CurrencyType=Input::get('currency_type');
$c->Amount=Input::get('amount');
$c->GrandTotal=Input::get('grand_total');
$c->Subtotal=Input::get('sub_total');
$c->AmountInWords=Input::get('amount_in_words');
$c->PaymentTerms=Input::get('payment_interms');
$c->ServiceTax=Input::get('service_tax');
$c->ServiceTaxAmount=Input::get('service_tax_amount');
$c->Status=$varr;
$c->InvoiceCode=$invoicecode;
$c->Nameofinvoice=$nameofinvoice;
$c->dealid=$dealid;
$c->save(); // you had skipped the parenthesis in your code.

$insertedId = $c->id;

 $invoicedata=Invoice::where('Id',$insertedId)->get();
foreach ($invoicedata as $in) {
  $inv=$in->InvoiceCode;
 
  # code...
}

    $html22 =  View('pdfgenerate')->with(array('invoicedata'=>$invoicedata ))->render();


    $html1 = "<h1>adsfadsfasdf</h1>";
        require_once(app_path().'/libs/html2pdf/html2pdf.class.php');


      $html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

      // $html2pdf->pdf->SetDisplayMode('fullpage');

      $html2pdf->WriteHTML($html22);

      $htmltosend=$html2pdf->Output('','S');

     $i='Invoice_';
$b=$inv;

$h='_Generated';
$subject =$i . $b . $h;


Mail::send('emails.test',['Invoice' => 'hgff'], function($message) use ($subject,$htmltosend) {
  // note: if you don't set this, it will use the defaults from config/mail.php
  $message->from('jeevan@ide-global.com', 'Jeevan');
  $message->to('harshitha.ide@gmail.com', 'Harshitha')
    ->subject($subject)
    ->attachData($htmltosend,'invoice.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));
});
$request->session()->flash('alert-success', 'Invoice was successful added!');
        
  return redirect('dealsclosed');

    }

if($variable=='single'){
$c= new Invoice();
$c->Particulars=Input::get('purpose');
$c->CientAddress=Input::get('client_address');
$c->ClientName=Input::get('client_name');
$c->Companyname=Input::get('companyname');
$c->ClientEmail=Input::get('client_email');

$c->RepresentativeNo=Input::get('rep_id');
$c->InvoiceDate=Input::get('invoice_date');
$c->DueDate=Input::get('due_date');
$c->SerialNo=Input::get('s_no');
$c->Eventcode=Input::get('eventcode');
$c->EventName=Input::get('event_name');
$c->CurrencyType=Input::get('currency_type');
$c->Amount=Input::get('amount');
$c->ServiceTax=Input::get('service_tax');
$c->ServiceTaxAmount=Input::get('service_tax_amount');
$c->GrandTotal=Input::get('grand_total');
$c->Subtotal=Input::get('sub_total');
$c->AmountInWords=Input::get('amount_in_words');
$c->PaymentTerms=Input::get('payment_interms');
$c->InvoiceCode=$invoicecode;
$c->Nameofinvoice=$nameofinvoice;
$c->dealid=$dealid;
$c->Status=$varr;
$c->save(); // you had skipped the parenthesis in your code.
$insertedId = $c->id;

$invoicedata=Invoice::where('Id',$insertedId)->get();
foreach ($invoicedata as $in) {
  $inv=$in->InvoiceCode;
 
  # code...
}


$i=Deal::where('Id',$dealid)->update(array('Status' => $dealstatus));
$html22 = View('pdfgenerate')->with(array('invoicedata'=>$invoicedata))->render();

$html1 = "<h1>adsfadsfasdf</h1>";
require_once(app_path().'/libs/html2pdf/html2pdf.class.php');

$html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

// $html2pdf->pdf->SetDisplayMode('fullpage');

$html2pdf->WriteHTML($html22);

$htmltosend=$html2pdf->Output('','S');

$i='Invoice_';
$b=$inv;

$h='_Generated';
$subject =$i .$b .$h;


Mail::send('emails.test',['Invoice' => 'hgff'], function($message) use ($subject,$htmltosend) {
  // note: if you don't set this, it will use the defaults from config/mail.php
  $message->from('jeevan@ide-global.com', 'Jeevan');
  $message->to('harshitha.ide@gmail.com', 'Harshitha')
    ->subject($subject)
    ->attachData($htmltosend,'invoice.pdf',array('mime'=>'application/pdf','Content-Disposition'=>'attachment'));
});

$request->session()->flash('alert-success', 'Invoice was successful added!');
         //return redirect()->route('/home');
       return redirect('dealsclosed');
    }

}

public function postDelete( Request $request) {
 $emp_del=Input::get('emp_del_id');

$i=Employee::where('emp_id',$emp_del)->delete();
            
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }

    
}

public function postDelevent( Request $request) {
 $evn_del=Input::get('evn_del_id');

$i=Event::where('id',$evn_del)->delete();
            
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }

    
}
public function postUpdateinvoice( Request $request) {
 $evnid=Input::get('view_invoice');
 $inv_status=Input::get('invoice_status');

 if($inv_status=='Attended with Modification'){
  $invoice_data=Invoice::where('Id',$evnid)->get();
  $cate = Event::all();
     $employee = Employee::all();
  return view('invoice_edit')->with(array('invoice_data'=>$invoice_data,'cate' =>$cate , 'employee'=>$employee));


 }
 if($inv_status=='Attended without modification'){
   // $post = Input::get();
  $i=Invoice::where('Id',$evnid)
            ->update(array(
              'Invoice_status' =>  $inv_status
              )
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }
  
 }
 if($inv_status=='Not Attended'){
   // $post = Input::get();
  $i=Invoice::where('Id',$evnid)
            ->update(array(
              'Invoice_status' => $inv_status
              )
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }
  
 }
 if($inv_status=='Entitlement'){
  
 }

 


    
}

public function postUpdateemployee( Request $request) {
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
return redirect('home1');
 
            }

    
}


}
