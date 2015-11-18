<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Event;
use App\Employee;
use App\Invoice;
use Mail;
use View;

class EditinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
         return view('invoice_edit');
    }

    public function postEditinvoice( Request $request) {
 $updateinvoice=Input::get('updateinvoice');
 $purpose=Input::get('purpose');
 if($purpose=='annual'){
    $post = Input::get();


$i=Invoice::where('Id',$updateinvoice)
            ->update(array(
               'Particulars'=> $post['purpose'],
'CientAddress'=> $post['client_address'],
'ClientName'=> $post['client_name'],
'ClientEmail'=> $post['client_email'],

'RepresentativeNo'=> $post['rep_id'],
'InvoiceDate'=> $post['invoice_date'],
'DueDate'=> $post['due_date'],

'AnnualSerialNo'=> $post['s_no_anuual1'],
'AnnualText'=> $post['anuual_text'],
'AnnualCurrencyType'=> $post['annual_currency1'],
'AnnualAmount'=> $post['annual_amount1'],
'SerialNo'=> $post['s_no'],
'EventName'=> $post['event_name'],
'CurrencyType'=> $post['currency_type'],
'Amount'=> $post['amount'],
'GrandTotal'=> $post['grand_total'],
'AmountInWords'=> $post['amount_in_words'],
'PaymentTerms'=> $post['payment_interms'],
'ServiceTax'=> $post['service_tax'],
'Invoice_status'=> 'Attended with Modification',
'ServiceTaxAmount'=> $post['service_tax_amount'])
            );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }

 }

 if($purpose=='single'){
      $post = Input::get();


$i=Invoice::where('Id',$updateinvoice)
            ->update(array(
'Particulars'=>$post['purpose'],
'CientAddress'=>$post['client_address'],
'ClientName'=>$post['client_name'],
'ClientEmail'=>$post['client_email'],

'RepresentativeNo'=>$post['rep_id'],
'InvoiceDate'=>$post['invoice_date'],
'DueDate'=>$post['due_date'],
'SerialNo'=>$post['s_no'],
'EventName'=>$post['event_name'],
'CurrencyType'=>$post['currency_type'],
'Amount'=>$post['amount'],
'ServiceTax'=>$post['service_tax'],
'ServiceTaxAmount'=>$post['service_tax_amount'],
'GrandTotal'=>$post['grand_total'],
'AmountInWords'=>$post['amount_in_words'],
'Invoice_status'=> 'Attended with Modification',
'PaymentTerms'=>$post['payment_interms'])

                );
            if($i>0){
              $request->session()->flash('alert-success', 'Updated Success!');
return redirect('home1');
 
            }

 }

    
}
    

}
