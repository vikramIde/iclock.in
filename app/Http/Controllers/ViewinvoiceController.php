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

class ViewinvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex($order_id)
    {
       $id=$order_id;

        $invoicedata=Invoice::where('Id',$id)->get();


    $html22 =  View('viewinvoice')->with(array('invoicedata'=>$invoicedata ))->render();

     require_once(app_path().'/libs/html2pdf/html2pdf.class.php');


      $html2pdf = new \HTML2PDF('P','A4','en',true,'UTF-8',array(0, 0, 0, 0));

      // $html2pdf->pdf->SetDisplayMode('fullpage');

      $html2pdf->WriteHTML($html22);

     $html2pdf->Output('Invoice.pdf');
        
      
    }

}