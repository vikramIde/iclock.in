<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Event;
use App\Employee;
use App\Invoice;
use App\Deal;
use Mail;
use View;

class CreateinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($dealid)
    {
       $id=$dealid;

        $invoicedata=Deal::where('Id',$id)->get();
        // dd($invoicedata);
        foreach ($invoicedata as $dat) {
          # code...
         $evname=$dat['Eventname'];
        }
        
        $categories = Event::where('event',$evname)->get();
      
      foreach($categories as $category){
          $EventDate = $category['date'];
      }
     $employee = Employee::all();
      $invoice = Invoice::all();


   return View('createinvoice')->with(array('categories'=>$categories,'employee'=>$employee,'invoice'=>$invoice,'invoicedata'=>$invoicedata ,'EventDate'=> $EventDate));

     
        
      
    }

}