<?php 
use App\Invoice;

$lastId = Invoice::get()->last();
$lastinvoice = Invoice::where('Id',$lastId->Id)->get();

?>
@foreach($lastinvoice as $inv)

 <p>Invoice Id : {{$inv['InvoiceCode']}} generated for  {{$inv['GrandTotal']}} of {{ $inv['ClientName'] }} - {{$inv['EventName']}} </p>

@endforeach
                                                                 


	

