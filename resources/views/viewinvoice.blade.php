@foreach($invoicedata as $inv)
@if($inv->Particulars=='annual')

<page backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12px" >
  <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table cellspacing="0" style="width: 700px; text-align: center; margin-left:15px;font-size: 14px ;margin-top:40px">
        <tr>
            <td style="width: 140px;">
                 <img style="width: 100%;" src="{{asset('/img/ide_color_logo.jpg')}}" alt="Logo">
            </td>
           
        </tr>
    </table>
    
     <table cellspacing="0" align="center" style="width: 700px; text-align: center; font-size: 20px; " >
        <tr>
            <td style="text-align:center">
                <u>{{$inv->Nameofinvoice}}</u>
            </td>
           
        </tr>
    </table>
    <br>
      <table   cellspacing="0" style="width:750px; height:40px; margin-left:15px;float:left; font-size: 12px">
        <tr>
          <td>
              <table cellspacing="0"  style=" border: solid 0.5px #ccc; float:left;font-size: 12px">
        <tr>
            <td >Client Address : </td>
           
           
            <td style="width:160px">{{ nl2br(e($inv->CientAddress)) }}</td>
          
        </tr>
        <tr>
            <td >Kind Attn :</td>
            <td style="text-decoration:underline;"><b>{{$inv->ClientName}}</b></td>
            
        </tr>
        <tr>
            <td >Company :</td>
            <td >{{$inv->Companyname}}</td>
         
        </tr> 
        
    </table>
          </td>
             <td>
            <table cellspacing="0" style=" height:80px; border: solid 0.5px #ccc;float:left; font-size: 12px">
        <tr>
            <td >Proforma Invoice No :</td> <td >{{$inv->InvoiceCode}}</td>
          
          
        </tr>
        <tr>
             <td >Representative Name :</td>
            <td >{{$inv->RepresentativeNo}}</td>
            
        </tr>
       
    </table>
    </td>
    <td>
      <table cellspacing="0"  style=" float:left;  border: solid 0.5px #ccc;font-size: 12px">
        <tr>
            <td >Proforma Invoice Date :</td><td >{{$inv->InvoiceDate}}</td>
          
          
        </tr>
        <tr>
              <td >Due Date :</td>
            <td >{{$inv->DueDate}}</td>
            
        </tr>
       
    </table>
          </td>
        </tr>
    </table>
<br>
<table  style="width: 750px; height:50px;border: solid 0.5px #ccc; background: #E7E7E7; margin-left:20px;   font-size: 12px;">
        <tr style="">
            <td style="width: 10%;text-align:left;"><b>S.no</b></td>
            <td style="width: 60%;text-align:left;"><b>Particular</b></td>
            <td style="width: 15%;text-align:left;"><b>Currency</b></td>
            <td style="width: 15%;text-align:right;"><b>Amount</b></td>
        
        </tr>
    </table>

    <table  style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
            <td style="width: 10%;text-align:left;" >{{$inv->AnnualSerialNo}}</td>
            <td style="width: 60%; text-align:left;">{{$inv->AnnualText}}</td>
            <td style="width: 15%; text-align:left;">{{$inv->AnnualCurrencyType}}</td>
            <td style="width:15%;text-align:right;">{{$inv->AnnualAmount}}</td>
          
        </tr>
         <tr>
            <td style="width: 10%;text-align:left;" >{{$inv->SerialNo}}</td>
            <td style="width:60%; text-align:left;">{{$inv->EventName}}</td>
            <td style="width: 15%;text-align:left; ">{{$inv->CurrencyType}}</td>
            <td style="width: 15%;text-align:right;">{{$inv->Amount}}</td>
          
        </tr>
    </table>
    <table  style="width: 750px;  height:50px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 60%; "></td>
            <td style="width: 15%;text-align:right;">Sub Total [{{$inv->SerialNo}}] : </td>
            <td style="width: 15%;text-align:right;">{{$inv->Subtotal}}</td>
        </tr>
    </table>
    @if($inv->CurrencyType=='INR')


  <table  style="width: 750px;   height:50px; border: solid 0.5px #ccc;margin-left:20px;  font-size: 12px;">
        <tr>
            <td style="width:10%;"></td>
            <td style="width:15%;"></td>
            <td style="width:60%;text-align:right;">Service Tax @ {{$inv->ServiceTax}}% </td>
            <td style="width:15%;text-align:right;">{{$inv->ServiceTaxAmount}}</td>
        </tr>
    </table>
    @endif
    
    <table style="width: 750px;   height:50px; border: solid 0.5px #ccc; margin-left:20px;   font-size: 12px;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width:60%; "></td>
            <td style="width: 15%;text-align:right;">Grand Total : </td>
            <td style="width:15%;text-align:right;">{{$inv->GrandTotal}}</td>
        </tr>
    </table>
   <br>
    <table  style="width:750px;  height:50px; border: solid 0.5px #ccc;  margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width:100%;">
             <b>Amount in Words</b> :   {{$inv->AmountInWords}} Only
          </td>
        </tr>
    </table>

    <br>
    <table  style="width:750px;  height:50px; border: solid 0.5px #ccc;  margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width:100%;">
             <b>Payment Terms </b>:   {{$inv->PaymentTerms}}
          </td>
        </tr>
    </table>

  <br>
   
    <table style="width:750px;  height:150px;border: solid 0.5px #ccc;margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width:50%;line-height:15px">
            <b><u>Bank Details</u></b><br><br>
             <b>Beneficiary </b> : IDE Consulting Services Pvt Ltd<br>
              <b>Bank </b>: Axis Bank Ltd<br>
             @if($inv->CurrencyType=='INR')
              <b>Account No </b> : 9130 2000 8276 686<br>
              @endif
              @if($inv->CurrencyType=='EURO')
             <b>Account No</b> : 9130 2003 5144 859<br>
              @endif
              @if($inv->CurrencyType=='DOLLAR')
              <b>Account No</b> : 9130 2001 9488 261<br>
              @endif

          </td>
           <td style="width:50%;">
            <br><br>
              <b>SWIFT </b>: AXISINBB227<br>
              <b>RTGS / NEFT </b>: UTIB0000227<br>
             
              
          </td>
        </tr>
    </table>
    <br>
 <table style="width:750px;  height:150px;border: solid 0.5px #ccc;  margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width: 100%;line-height:15px">
              <b>PAN NO </b>:                            AACCI9411N<br>
              <b>Company No </b>:                        U74900KA2012PTC064066<br>
              <b>Service Tag Reg No</b> :                AACCI9411NSD001<br>
              <b>Service Tax Registration Category</b> : Promotion or marketing of brand of goosd/services/events Service
          </td>
        </tr>
    </table>
  <br>
    <table style="width:750px; margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width: 50%;">
          <img src="{{asset('/img/ide_bg.png')}}" width="300">
          </td>
           <td style="width:50%; text-align:right">
            <br>
             <b>For IDE Consulting Services Pvt Ltd</b><br>
           
            <img src="{{asset('/img/sign.jpg')}}" width="150"  ><br>
             <b>Authorized Signatory</b><br><br>

             <b>IDE Consulting Services Pvt Ltd</b><br>
             #23,3<sup>rd</sup> Floor, Off CMH Road,Indira Nagar, Bangalore - 560038<br>
             T: +91 80 4939 6999 | F: +91 80 4939 6900 | <b>www.ide-global.com</b>
             
              
          </td>
        </tr>
    </table>

    
    
</page>
@endif
   @endforeach


<!--single event pdf invoice-->

  <style type="text/css">
table {border-spacing: 2px;}
td    {padding: 6px;}
</style>
@foreach($invoicedata as $inv)
@if($inv->Particulars=='single')

<page backcolor="#FEFEFE" backimg="" backimgx="center" backimgy="bottom" backimgw="100%" backtop="0" backbottom="30mm" footer="date;heure;page" style="font-size: 12pt">
   <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <table cellspacing="0" style="width: 100%; margin-left:15px;text-align: center; font-size: 14px;margin-top:40px">
        <tr>
            <td style="width: 20%;">
                 <img style="width: 100%;" src="{{asset('/img/ide_color_logo.jpg')}}" alt="Logo">
            </td>
           
        </tr>
    </table>
    
     <table cellspacing="0" align="center" style="width: 100%; text-align: center; font-size: 20px">
        <tr>
            <td style="text-align:center">
                <u>{{$inv->Nameofinvoice}}</u>
            </td>
           
        </tr>
    </table>
   
   <table   cellspacing="0" style="width:750px; height:10px; margin-left:15px;float:left; font-size: 12px">
        <tr>
          <td>
              <table cellspacing="0"  style=" border: solid 0.5px #ccc; float:left;font-size: 12px;">
        <tr>
            <td >Client Address :</td>
           
           
            <td style="width:170px; margin-bottom:10px ">{{ nl2br(e($inv->CientAddress)) }}</td>
          
        </tr>
        <tr>
            <td >Kind Attn :</td>
            <td style="text-decoration:underline;"><b>{{$inv->ClientName}}</b></td>
            
        </tr>
       <tr>
            <td >Company :</td>
            <td >{{$inv->Companyname}}</td>
         
        </tr> 
        
        
    </table>
          </td>
             <td>
            <table cellspacing="0" style="  border: solid 0.5px #ccc;float:left; font-size: 12px">
        <tr>
            <td >Proforma Invoice No :</td> <td style="width:60px;">{{$inv->InvoiceCode}}</td>
          
          
        </tr>
        <tr>
             <td >Representative Name :</td>
            <td >{{$inv->RepresentativeNo}}</td>
            
        </tr>
       
    </table>
    </td>
    <td>
      <table cellspacing="0"  style=" float:left;  border: solid 0.5px #ccc;font-size: 12px">
        <tr>
            <td >Proforma Invoice Date :</td><td style="width:40px;">{{$inv->InvoiceDate}}</td>
          
          
        </tr>
        <tr>
              <td >Due Date :</td>
            <td >{{$inv->DueDate}}</td>
            
        </tr>
       
    </table>
          </td>
        </tr>
    </table>
<br>
    <table  style="width: 750px; height:50px;border: solid 0.5px #ccc; background: #E7E7E7; margin-left:20px;   font-size: 12px;">
        <tr style="">
            <td style="width: 10%;text-align:left;"><b>S.no</b></td>
            <td style="width: 60%;text-align:left;"><b>Particular</b></td>
            <td style="width: 15%;text-align:left;"><b>Currency</b></td>
            <td style="width: 15%;text-align:right;"><b>Amount</b></td>
        
        </tr>
    </table>

    <table  style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
       <tr>
         <td style="width: 10%;text-align:left;" >{{$inv->SerialNo}}</td>
            <td style="width: 60%;text-align:left; margin-left:-10px ">{{$inv->EventName}}</td>
            <td style="width: 15%; text-align:left;">{{$inv->CurrencyType}}</td>
            <td style="width: 15%;text-align:right;">{{$inv->Amount}}</td>
          
        </tr>
    </table>
    <table style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 60%; "></td>
            <td style="width: 15%;text-align:right;">Sub Total [{{$inv->SerialNo}}] : </td>
            <td style="width: 15%;text-align:right;">{{$inv->Subtotal}}</td>
        </tr>
    </table>
 @if($inv->CurrencyType=='INR')
  <table  style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 15%;"></td>
            <td style="width: 60%;text-align:right;">Service Tax @ {{$inv->ServiceTax}}% </td>
            <td style="width: 15%; text-align:right;">{{$inv->ServiceTaxAmount}}</td>
        </tr>
    </table>
    @endif
    
    <table style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
            <td style="width: 10%;"></td>
            <td style="width: 60%; "></td>
            <td style="width: 15%;text-align:right;">Grand Total : </td>
            <td style="width: 15%;text-align:right;">{{$inv->GrandTotal}}</td>
        </tr>
    </table>
   <br>
    <table style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
          <td style="width: 100%;">
             <b>Amount in Words </b>: {{$inv->AmountInWords}} Only
          </td>
        </tr>
    </table>

    <br>
    <table  style="width: 750px;   height:80px; border: solid 0.5px #ccc; margin-left:20px;  font-size: 12px;">
        <tr>
          <td style="width: 100%;">
             <b>Payment Terms</b> :  {{$inv->PaymentTerms}}
          </td>
        </tr>
    </table>

  <br>
    
    <table style="width:750px;  height:150px;border: solid 0.5px #ccc;margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width: 50%;">
            <b><u>Bank Details</u></b><br><br>
              <b>Beneficiary </b>: IDE Consulting Services Pvt Ltd<br>
              <b>Bank </b>: Axis Bank Ltd<br>
              @if($inv->CurrencyType=='INR')
              <b>Account No </b>: 9130 2000 8276 686<br>
              @endif
              @if($inv->CurrencyType=='EURO')
              <b>Account No </b>: 9130 2003 5144 859<br>
              @endif
              @if($inv->CurrencyType=='USD')
              <b>Account No </b>: 9130 2001 9488 261<br>
              @endif

              
          </td>
           <td style="width: 50%;">
            <br><br>
             <b> SWIFT </b>: AXISINBB227<br>
             <b> RTGS / NEFT </b>: UTIB0000227<br>
             
              
          </td>
        </tr>
    </table>
<br>
<table  style="width:750px;  height:150px;border: solid 0.5px #ccc;margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width: 100%;">
              <b>PAN NO</b> :                            AACCI9411N<br>
              <b>Company No </b>:                        U74900KA2012PTC064066<br>
              <b>Service Tag Reg No</b> :                AACCI9411NSD001<br>
              <b>Service Tax Registration Category</b> : Promotion or marketing of brand of goosd/services/events Service
          </td>
        </tr>
    </table>
  <br>
    <table style="width:750px; margin-left:20px;font-size: 12px;">
        <tr>
          <td style="width: 50%;">
          <img src="{{asset('/img/ide_bg.png')}}" width="300">
          </td>
           <td style="width: 50%; text-align:right">
            <br><br> 
             <b>For IDE Consulting Services Pvt Ltd</b><br>
           
            <img src="{{asset('/img/sign.jpg')}}" width="150"  ><br>
             <b>Authorized Signatory</b><br><br>

             <b>IDE Consulting Services Pvt Ltd</b><br>
             #23,3<sup>rd</sup> Floor, Off CMH Road,Indira Nagar, Bangalore - 560038<br>
             T: +91 80 4939 6999 | F: +91 80 4939 6900 | <b>www.ide-global.com</b>
             
              
          </td>
        </tr>
    </table>

       
    
</page>
@endif
@endforeach
