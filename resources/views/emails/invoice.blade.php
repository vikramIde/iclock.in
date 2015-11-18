<?php 
use App\Invoice;
use App\Event;

$lastId = Invoice::orderBy('updated_at', 'desc')->first();
$lastinvoice = Invoice::where('Id',$lastId->Id)->get();
foreach($lastinvoice as $inv){
	$evname=$inv['EventName'];
	

}
$varr=Event::where('event',$evname)->get();



?>
@foreach($lastinvoice as $inv)

@foreach($varr as $invar)


 <p><b>Dear {{$inv['ClientName']}},</b></p>
<p>We thank <b>{{$inv['Companyname']}}</b> for giving us an opportunity to serve you at our event name initiative to be held on
<b>{{$invar['date']}}</b> at <b>{{$invar['city']}}-{{$invar['country']}}</b> , in this regards please find attached Pro-Forma 
 invoice numbered : <b>{{$inv['InvoiceCode']}}</b> dated : <b>{{$inv['InvoiceDate']}}</b>.</p>

<p><b>Special Note: please pay the due amount as per the terms mentioned in the pro-forma invoice.</b></p>
 @endforeach

@endforeach
                                                                 


	

