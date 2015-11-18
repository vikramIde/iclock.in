@extends('app')

@section('content')


        <!-- topbar ends -->
        <div class="ch-container">
            <div class="row">

                <!-- left menu starts -->
                <div class="col-sm-2 col-lg-2">
                    <div class="sidebar-nav">
                        <div class="nav-canvas">
                            <div class="nav-sm nav nav-stacked">

                            </div>
                            <ul class="nav nav-pills nav-stacked main-menu">
                                <li class="nav-header">Main</li>
      <?php if(Auth::User()->role=='admin1'){ ?>                          
   <li class="active"><a class="ajax-link" ><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                                    </li>
    <li ><a class="ajax-link" href="{{URL::to('dealsclosed')}}"><i class="glyphicon glyphicon-home"></i><span> Deals Closed</span></a>
                                    </li>
                                    <?php } ?>
 <?php if(Auth::User()->role=='super admin'){ ?>
     <li ><a class="ajax-link" href="{{ URL::to('home')}}"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                                    </li>
                                   
 <li><a class="ajax-link" href="{{ URL::to('reports')}}"><i
                                    class="glyphicon glyphicon-edit"></i><span> Reports</span></a></li>
                        <li class="active"><a class="ajax-link" href="{{ URL::to('home1') }}"><i class="glyphicon glyphicon-eye-open"></i><span> Task-part1</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('home2') }}"><i
                                    class="glyphicon glyphicon-edit"></i><span> Task-part2</span></a></li>
                                     <li><a class="ajax-link" href="{{URL::to('adduser')}}"><i
                                    class="glyphicon glyphicon-edit"></i><span>Add User</span></a></li>
                                   
                  <?php } ?>                

                            </ul>

                        </div>
                    </div>
                </div>
                <!--/span-->
                <!-- left menu ends -->

                <noscript>
                    <div class="alert alert-block col-md-12">
                        <h4 class="alert-heading">Warning!</h4>

                        <p>You need to have <a href="" target="_blank">JavaScript</a> enabled to use this site.</p>
                    </div>
                </noscript>

                <div id="content" class="col-lg-10 col-sm-10">
                    <!-- content starts -->

                    <div class="row">
                        <div class="box col-md-12">
                            <div class="box-inner homepage-box">
                                <div class="box-header well">
                                    <h2><i class="glyphicon glyphicon-th"></i> Dashboard</h2>
</br>
                                </div>
                                 @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

                                                                           <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>
                                <div class="box-content">
                                    <ul class="nav nav-tabs" id="myTab">
                                      
                                        <li class="active"><a href="#custom">Edit Invoice </a></li>
                                        
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        
                                        <div class="tab-pane active" id="custom">
                                            <div class="row-fluid sortable">
                                                <div class="box span12">
                                                   <!--  <div class="box-header well" data-original-title="">
                                                        <h2><i class="icon-edit"></i> Create New Invoice</h2>
                                                    </div> -->
                                                    <div class="box-content">
                                            <div class="errormsg"></div>
                                         
                                                        <form action="{{ url('/editinvoice/editinvoice') }}" method="post" enctype="multipart/form-data">
                                                           <?php foreach($invoice_data as $data) {
                                                           	?>
                                                            <fieldset> 
                                                            	<input type="text" name="updateinvoice" value="<?php echo $data->Id?>">

                                                                <div id="wrapper">
                                                                    <h2 style="text-align:center; font-weight:bold; padding-top:5mm;">INVOICE</h2>
                                                                    <br>
                                                                    <table class="heading table table-bordered">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <b>Client Information</b> <span class="required">*</span>
                                                                                    <br>
                                                                                    <table class="table table-bordered">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td class="value">  
                                                                                                
                                                                                                    <textarea class="form-control" name="client_address"><?php echo $data->CientAddress ?></textarea>
                                                                                                
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="value">Kind Attention:
                                                                                                    <input type="text" name="client_name" value="<?php echo $data->ClientName ?>" autocomplete="off" placeholder="Name" class="form-control">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="value">Email Address:
                                                                                                    <input type="text" name="client_email" value="<?php echo $data->ClientEmail ?>" autocomplete="off" placeholder="Email" class="form-control">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <div id="divCustomerInfo"></div>
                                                                                </td>
                                                                                <td valign="top" align="right" style="padding:3mm;">
                                                                                    <table class="table table-bordered" style="height:auto">
                                                                                        <tbody>
                                                                                           
                                                                                            <tr>
                                                                                                <td>Rep No </td>
                                                                                                <td>
                                                                                                    <select name="rep_id" class="form-control">
                                                                                                    	<?php 
                                                                                          	foreach($employee as $e){
                                                                                          		?>
                                                                                          	<option value="<?php echo $e->emp_name ?>" <?php if($data->RepresentativeNo==$e->emp_name) echo "selected";?>>
                                                                                          		<?php echo $e->emp_name ?>
                                                                                          	</option>

                                                                                          	
                                                                                         <?php
                                                                                     }
                                                                                     ?>

                                                                                                     
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Proforma Invioce Date : </td>
                                                                                                <td>
                                                                                                    <input id="dob" autocomplete="off" name="invoice_date" value="<?php echo $data->InvoiceDate ?>" class="form-control dp" type="text">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Due Date </td>
                                                                                                <td>
                                                                                                    <input id="dob1" autocomplete="off" name="due_date" value="<?php echo $data->DueDate ?>" class="form-control dp1" type="text">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Particular </td>
                                                                                                <td>
                                                                                                    <select name="purpose" class="form-control particular">
                                                                                                        <option>Choose</option>
                                                                                                        <option value="annual" <?php if($data->Particulars=='annual') echo "selected"; ?> >Annual</option>
                                                                                                        <option value="single" <?php if($data->Particulars=='single') echo "selected"; ?> >Single</option>

                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div id="content">
                                                                        <div id="invoice_body">
                                                                            <table id="main-data-table" class="order-list table table-bordered">
                                                                                <thead>
                                                                                    <tr style="background:#eee;">
                                                                                        <td><b>S.no</b></td>
                                                                                        <td class="w15"><b>Particulars</b></td>
                                                                                        <td class="w15"><b>Currency</b></td>
                                                                                        <td style="width:20%;"><b>Amount</b></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody class="inputs">
                                                                                    <tr class="valuesinv annual report">
                                                                                        <td class="mono w10">
                                                                                            <input placeholder="" style="width:80px" value="<?php echo $data->AnnualSerialNo ?>" autocomplete="off" name="s_no_anuual1" class="form-control" type="text">
                                                                                        </td>
                                                                                        <td class="mono w15">
                                                                                            <input id="" name="anuual_text" value="<?php echo $data->AnnualText ?>" autocomplete="off" class="form-control" type="text">
                                                                                        </td>
                                                                                        <td class="mono w15">
                                                                                            <select name="annual_currency1" class="form-control ">
                                                                                                <option>Select</option>
                                                                                                <option value="INR" <?php if($data->AnnualCurrencyType=='INR') echo "selected"; ?>>INR</option>
                                                                                                <option value="EURO" <?php if($data->AnnualCurrencyType=='EURO') echo "selected"; ?>>EURO</option>
                                                                                                <option value="USD" <?php if($data->AnnualCurrencyType=='USD') echo "selected"; ?>>DOLLAR</option>

                                                                                            </select>
                                                                                        </td>
                                                                                        <td class="mono w10">
                                                                                            <input type="text" value="<?php echo $data->AnnualAmount ?>" autocomplete="off" name="annual_amount1" class="form-control">
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr class="valuesinv annual single report">
                                                                                        <td class="mono w10">
                                                                                            <input placeholder="" value="<?php echo $data->SerialNo ?>" autocomplete="off" style="width:80px" id="" name="s_no" class="form-control" type="text">
                                                                                        </td>
                                                                                        <td class="mono w15">
                                                                                          <select name="event_name" class="form-control">
                                                                                          	<?php 
                                                                                          	foreach($cate as $c){
                                                                                          		?>
                                                                                          	<option value="<?php echo $c->event ?>" <?php if($data->EventName==$c->event) echo "selected";?>>
                                                                                          		<?php echo $c->event ?>
                                                                                          	</option>

                                                                                          	
                                                                                         <?php
                                                                                     }
                                                                                     ?>
                                                                                            
                                                                                            </select>
                                                                                           
                                                                                        </td>
                                                                                        <td class="mono w15">
                                                                                            <select name="currency_type" class="form-control currency">
                                                                                                <option>Select</option>
                                                                                                <option value="INR" <?php if($data->CurrencyType=='INR') echo "selected"; ?> >INR</option>
                                                                                                <option value="EURO" <?php if($data->CurrencyType=='EURO') echo "selected"; ?>>EURO</option>
                                                                                                <option value="DOLLAR" <?php if($data->CurrencyType=='DOLLAR') echo "selected"; ?>>DOLLAR</option>

                                                                                            </select>
                                                                                        </td>
                                                                                        <td class="mono w10">
                                                                                            <input type="text" autocomplete="off" value="<?php echo $data->Amount ?>" name="amount" class="form-control">
                                                                                        </td>
                                                                                    </tr>
                                                                                   
                                                                                    <tr class="valuesinv INR price">
                                                                                        <td class="mono w10"></td>
                                                                                        <td class="mono w15">Service Tax @</td>
                                                                                        <td class="mono w15">
                                                                                            <input type="text" value="14.00%" name="service_tax" class="form-control">
                                                                                        </td>
                                                                                        <td class="mono w10">
                                                                                            <input type="text" autocomplete="off" value="<?php echo $data->ServiceTaxAmount ?>" name="service_tax_amount" class="form-control">
                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                    <tr class="valuesinv">
                                                                                        <td class="mono w10"></td>
                                                                                        <td class="mono w15"></td>
                                                                                        <td class="mono w15">Grand Total</td>
                                                                                        <td class="mono w10">
                                                                                            <input type="text" autocomplete="off" value="<?php echo $data->GrandTotal ?>" name="grand_total" class="form-control">
                                                                                        </td>
                                                                                    </tr>
                                                                            </table>
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="pis-btm-left" valign="top" colspan="4">
                                                                                            Amount in Words :
                                                                                            <input type="text" autocomplete="off" value="<?php echo $data->AmountInWords ?>" name="amount_in_words" class="form-control">

                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="pis-btm-left" valign="top" colspan="4">
                                                                                            Payemnt Terms:
                                                                                            <br>
                                                                                            <textarea rows="4" name="payment_interms" id="spnotes" class="form-control"><?php echo $data->PaymentTerms ?></textarea>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="pis-btm-left" valign="top" colspan="4">
                                                                                            PAN NO: AACCI9411N
                                                                                            <br> Company No: U74900KA2012PTC064066
                                                                                            <br> Service Tax Reg No : AACCI9411NSD001 </br>
                                                                                            Service Tax Registration Category: Promotion or marketing of brand of goods/services/events Service </td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                                                            <table class="table table-bordered">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td class="pis-btm-left" valign="top" colspan="4">
                                                                                            <b>Bank Details</b> </br>
                                                                                            </br>
                                                                                            Beneficiary : IDE Consulting Private Limited
                                                                                            <br> Bank: Axis Bank
                                                                                            <br> Account No : 9130 2000 8276 686 </td>
                                                                                        <td class="pis-btm-right" valign="top" colspan="4">
                                                                                            </br>
                                                                                            </br>
                                                                                            SWIFT : AXISINBB227
                                                                                            <br> RTGS / NEFT: UTIB0000227 </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </fieldset>

 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                            <input type="submit" name="submit" value="Save & Send for Approval" class="btn btn-primary ">
<?php 
}
?>
                                                        </form>
                                                       
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                   

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--/row-->

                    <!-- content ends -->
                </div>
                <!--/#content.col-md-0-->
            </div>
            <!--/fluid-row-->



            <hr>

         

            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://www.ide-global.com" target="_blank">www.ide-global.com</a></p>

                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a href="">Ide Global</a></p>
            </footer>

        </div>
        <!--/.fluid-container-->

        <!-- external javascript -->

 
        <script src="{{asset('/datepicker/js/bootstrap-datepicker.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/datepicker/css/datepicker.css')}}">

        <script type="text/javascript">
            // When the document is ready
            $(document).ready(function() {


                $('#dob').datepicker({
                    format: 'dd-mm-yyyy',
                    startDate: '-0m',
                    autoclose: true

                });

                $('.dp').on('change', function() {
                    $('.datepicker').hide();
                });


            });
            $(document).ready(function() {


                $('#dob1').datepicker({
                    format: 'dd-mm-yyyy',
                    startDate: '-0m',
                    autoclose: true

                });

                $('.dp1').on('change', function() {
                    $('.datepicker').hide();
                });


            });
              $(document).ready(function() {


                $('.dob4').datepicker({
                    format: 'dd-mm-yyyy',
                    startDate: '-0m',
                    autoclose: true

                });

                $('.dp4').on('change', function() {
                    $('.datepicker').hide();
                });


            });
        </script>
      
        <style type="text/css">
            .report {
                padding: 20px;
                display: none;
                margin-top: 20px;
                border: 1px solid #000;
            }
            
            .price {
                padding: 20px;
                display: none;
                margin-top: 50px;
                border: 1px solid #000;
            }
        </style>

        <script type="text/javascript">
            $(document).ready(function() {
                $("select.particular").change(function() {
                    $(this).find("option:selected").each(function() {
                        if ($(this).attr("value") == "annual") {
                            $(".report").not(".annual").hide();
                            $(".annual").show();
                        } else if ($(this).attr("value") == "single") {
                            $(".report").not(".single").hide();
                            $(".single").show();
                        } else {
                            $(".report").hide();
                        }
                    });
                }).change();
            });
            $(document).ready(function() {
                $("select.currency").change(function() {
                    $(this).find("option:selected").each(function() {
                        if ($(this).attr("value") == "INR") {
                            $(".price").not(".INR").hide();
                            $(".INR").show();
                        } else {
                            $(".price").hide();
                        }
                    });
                }).change();
            });
        </script>
@endsection