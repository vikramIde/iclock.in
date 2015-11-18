@extends('css')

@section('content')
<?php $totalPayment=0 ; $totalAdjustment=0;?>
        <script type='text/javascript' src="{{asset('js/jquery-1.3.2.js')}}"></script>
       <script type="text/javascript">
$(function () {
     $("#table-data").on('click', 'input.addButton', function () {
         var $tr = $(this).closest('tr');
         var allTrs = $tr.closest('table').find('tr');
         var lastTr = allTrs[allTrs.length - 1];
         var $clone = $(lastTr).clone();
         $clone.find('td').each(function () {
             var el = $(this).find(':first-child');
             var id = el.attr('id') || null;
             if (id) {
                 var i = id.substr(id.length - 1);
                 var prefix = id.substr(0, (id.length - 1));
                 el.attr('id', prefix + (+i + 1));
                 el.attr('name', prefix + (+i + 1));
             }
         });
      //    $clone.find('input:text').val('');
      // $clone.find('.dob4').removeAttr('id').removeClass('hasDatepicker');
      //    $clone.find('.dob4').datepicker({
      //        format: 'dd-mm-yyyy',
      //        startDate: '-0m',
      //        autoclose: true

      //    });

         $tr.closest('table').append($clone);
     });

    
     
 });
        </script>
    <!--end clone row-->

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
   <li ><a class="ajax-link" href="{{ URL::to('collection/home')}}"><span> Dashboard</span></a>
                                    </li>
     <li class="active"><a class="ajax-link" href="{{ URL::to('collection/payment/$id')}}"><span>Recieve Payment</span></a>
                                    </li>
                               

                            </ul>
                           
                        </div>
                    </div>
                </div>

                 <noscript>
                    <div class="alert alert-block col-md-12">
                        <h4 class="alert-heading">Warning!</h4>
                        <p>You need to have <a href="" target="_blank">JavaScript</a> enabled to use this site.</p>
                    </div>
                </noscript>
                
                  <div id="content" class="col-lg-10 col-sm-10">


                  	<?php foreach($invoice as $data) { ?>
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
                                        <li><a href="#paymentDiv">Recieve Payment</a></li>
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane" id="paymentDiv">
                                          </br>
                                    <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-building-o fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Company Name</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="text-align:right;"><?php echo $data->Companyname ?></span>
                              <!--   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-calendar fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Event Name</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo $data->EventName ?></span>
                                <!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Sales Representative</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo $data->RepresentativeNo ?></span>
                              <!--   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inr fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Total Amount</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left"><?php echo $data->GrandTotal ?></span>
                              <!--   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
                                        <!--   	<table  class="table table-striped table-bordered bootstrap-datatable datatable responsive" style="width:50%;" align="center">
												                            <tr >
                                                        <th>Company Name </td>
                                                        <td><?php echo $data->Companyname ?></td>
                                                    </tr>
                                                    <tr >
                                                        <th>Event Name</td>
                                                        <td><?php echo $data->EventName ?></td>
                                                    </tr>
                                                    <tr >
                                                        <th>Sales Rep </td>
                                                        <td><?php echo $data->RepresentativeNo ?></td>
                                                    </tr>
                                                    <tr >
                                                        <th>Total Amount</td>
                                                        <td><?php echo $data->GrandTotal ?></td>
                                                    </tr>
                                          	</table> -->
                                          <div class="ch-container">

                                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/collection/payment') }}">
                                          	<h3>Payments</h3>
                        												<input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        												 <input type="hidden" name="invoiceid" value="<?php echo $data->Id ?>" /> 
                        						<table class="table table-striped table-bordered   " id="table-data">
                                                     <thead style="color:#fff;background-color:#000;text-align:left">

                                                    <tr >
                                                        <td >Amount </td>
                                                        <td >Date </td>
                                                        <td >Ref no </td> 
                                                        <td >Adjustment Mode</td>
                                                        <td style="text-align:right">Adjustment Amount</td> 
                                                    </tr>
                                                  </thead>
                                                    <?php if(count($data->payments) > 0) { ?>
                                                    @foreach($data->payments as $payment)
                                                    <?php $totalPayment += $payment->recieved_amount; ?>
                                                    <?php $totalAdjustment += $payment->adjust_amount; ?>
                                                   
                                                    <tr style="text-align:left">
                                                        <td>
                                                           {{$payment->recieved_amount}}
                                                        </td>
                                                        <td>
                                                           {{$payment->date}}
                                                        </td>
                                                        <td>
                                                           {{$payment->refno}}
                                                        </td>
                                                        <td>
                                                          {{$payment->adjust_mode}}
                                                        </td>
                                                        <td style="text-align:right">
                                                        {{$payment->adjust_amount}}
                                                        </td>
                                                        
                                                    </tr>
                                                    
                                                    @endforeach
                                                 <?php } ?>
                                                 

                                                        <tr>
                                                        <td>
                                                            <input type="text" value="" class="form-control" autocomplete="off" name="recieved_amount[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" value="" class="form-control dob" autocomplete="off" name="date[]"  >
                                                        </td>
                                                        <td>
                                                            <input type="text" value="" class="form-control" autocomplete="off" name="ref_no[]" >
                                                        </td>
                                                        <td>
                                                            <select class="form-control" name="adjustmentmode[]">
                                                                 <option >Option</option>
                                                                <option >TDS</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" value="" class="form-control" autocomplete="off" name="adjustmentamount[]" >
                                                        </td>
                                                        <td>
                                                            <input type="button" class="btn btn-default addButton" value="Add" />
                                                        </td>
                                                    </tr>
                                                
                                                 


                                                 
                                                </table>
                                                <center> <input type="submit" class="btn btn-info" value="Submit Payment"></center>
                                                 
                                                <h3></h3>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Comments
                   
                        </div>
                          
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php if(count($data->comments) > 0) { ?>
                            @foreach($data->comments as $comment)
                            <ul class="chat">
                             
                                <li class="left clearfix">
                                  
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                        
                                            <small class="pull-right text-muted">
                                                <i class="fa fa-clock-o fa-fw"></i> {{$comment->date}}
                                            </small>
                                        </div>
                                        <p>
                                            {{$comment->text}}
                                        </p>
                                    </div>
                                </li>
                               
                                
                               
                            </ul>
                               @endforeach
                                                 <?php } 
                                                      else echo "No comments available";
                                                 ?>
                        </div>
                       
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                              <?php
                             
 date_default_timezone_set('Asia/Kolkata');
 $today=date('d-m-Y g:i a');

                              ?>
                               <input type="hidden" value="<?php  echo $today;  ?>" class="form-control dob"  autocomplete="off" name="date1"  >
                                <textarea type="text" value="" class="form-control" autocomplete="off"  rows="1" cols="50" name="comment" ></textarea>
                                <span class="input-group-btn">
                                    <input type="submit" class="btn btn-info" value="Submit Comment">
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                                      
                                            </div>
                                            <div class="col-md-6">
                                                    <div class="col-lg-6 col-md-6" style="margin-top: 139px;
    margin-left: 150px;">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inr fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Balance Amount</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">{{$data->GrandTotal - $totalPayment - $totalAdjustment}}</span>
                             
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                                         
                                        </div>
                                    </div>
                                </form>        
        					</div>
                        </div>
                    </div>
              	</div>
          	</div>
        </div>
        <?php } ?>
        </div>

        <script src="{{asset('/datepicker/js/bootstrap-datepicker.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/datepicker/css/datepicker.css')}}">

        <script type="text/javascript">
        // When the document is ready
        $(document).ready(function() {


        $('.dob').datepicker({
        format: 'dd-mm-yyyy',
        startDate: '-0m',
        autoclose: true

        });

        $('.dp').on('change', function() {
        $('.datepicker').hide();
        });


        });

        </script>
        @endsection