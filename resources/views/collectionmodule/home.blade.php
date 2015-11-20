@extends('css')

@section('content')
<!--clone row-->
        <script type='text/javascript' src="{{asset('js/jquery-1.3.2.js')}}"></script>
       


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
      <?php if(Auth::User()->role=='collector'){ ?>                          
                              <li ><a class="ajax-link" href="{{ URL::to('collection/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
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
                                <div class="flash-message">
                                    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                      @if(Session::has('alert-' . $msg))

                                      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                                      @endif
                                    @endforeach
                                  </div>
                                  <div class="box-content">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <li><a href="#viewall">Approved Invoices</a></li>
                                        <li><a href="#viewToday">View Approved Today's Invoices</a></li>
                                    </ul>

                                        <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane" id="viewToday">
                                          </br>
                                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                                <thead style="color:#fff;background-color:#000">
                                                    <tr>
                                                        <td>S.no</td>
                                                        <td>Company Name</td>
                                                        <td>Event Name</td>
                                                        <td>Sales Rep</td>
                                                        <td>Amount</td>
                                                        <td>Currency</td>
                                                        <td>Due Date</td>
                                                        <td>Actions</td>
                                                    </tr>
                                                </thead>
                                               
                                                  
                                                   @foreach($invoices as $inv)
                                                   <?php if($inv->DueDate == date("d-m-Y")) {?>
                                                  <tr>
                                                  <td>{{$inv->Id}}</td>
                                                  <td>{{$inv->Companyname}}</td>
                                                  <td>{{$inv->EventName}}</td>
                                                  <td>{{$inv->RepresentativeNo}}</td>
                                                  <td>{{$inv->GrandTotal}}</td>
                                                  <td>{{$inv->CurrencyType}}</td>
                                                  <td>{{$inv->DueDate }} </td>
                                                       <td class="center">
                                                                    <a class="btn btn-view" target="_blank" href="{{ URL::to('viewinvoice', array('order_id' => $inv->Id)) }}">
                                                                         <i class="fa fa-eye"></i>
                                                                        View
                                                                            </a> <?php  if($inv->Status =='1') {?>
                                                                    <a href="{{ URL::to('collection/payment', array('order_id' => $inv->Id)) }}"  class="btn btn-info "   id="<?php echo $inv->Id ?>" >
                                                                      <i class="fa fa-money"></i> 
                                                                            Recieve
                                                                            </a>
                                                                        <?php
                                                                      }
                                                                      ?> </td>
                                                </tr>
                                                <?php } ?>
                                                @endforeach

                                               
                                            </table>
                                        </div>

                                        <div class="tab-pane" id="viewall">
                                          </br>
                                                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                                                <thead style="color:#fff;background-color:#000">
                                                                    <tr>
                                                                        <td>S.no</td>
                                                                        <td>Company Name</td>
                                                                        <td>Event Name</td>
                                                                        <td>Sales Rep</td>
                                                                        <td>Amount</td>
                                                                        <td>Currency</td>
                                                                        <td >Due Date</td>
                                                                        <td>Actions</td>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  
                                                                   @foreach($invoices as $inv)
                                                                   
                                                                  <tr>
                                                                  
                                                                  <td>{{$inv->Id}}</td>
                                                                  <td style="width:200px">{{$inv->Companyname}}</td>
                                                                  <td style="width:170px">{{$inv->EventName}}</td>
                                                                  <td>{{$inv->RepresentativeNo}}</td>
                                                                  <td style="text-align:right">{{$inv->GrandTotal}}</td>
                                                                  <td>{{$inv->CurrencyType}}</td>
                                                                  <td>{{$inv->DueDate }} </td>
                                                                  <td class="center">
                                                                    <a class="btn btn-view" target="_blank" href="{{ URL::to('viewinvoice', array('order_id' => $inv->Id)) }}">
                                                                        <i class="fa fa-eye"></i>
                                                                        View
                                                                            </a> <?php  if($inv->Status =='1') {?>
                                                                    <a href="{{ URL::to('collection/payment', array('order_id' => $inv->Id)) }}"  class="btn btn-info "   id="<?php echo $inv->Id ?>" >
                                                                    <i class="fa fa-money"></i>&nbsp;
                                                                            Receive
                                                                            </a>
                                                                        <?php
                                                                      }
                                                                      ?> </td>
                                                                </tr>
                                                               
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                        </div>
                                         <div class="tab-pane" id="inv">
                                         </br>

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