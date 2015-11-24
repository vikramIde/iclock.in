@extends('app')

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
      <?php if(Auth::User()->role=='sales'){ ?>                          
   <li class="active"><a class="ajax-link" href="{{ URL::to('targetmodule/targethome')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
     <li><a class="ajax-link" href="{{ URL::to('targetmodule/eventdeal')}}"><i class="fa fa-pencil-square-o"></i><span> Update New Deal</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="{{ URL::to('targetmodule/variancecard')}}"><i class="fa fa-line-chart"></i><span> Variance Card</span></a>
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
                                        <li class="active"><a href="#info">My Target</a></li>
                                        <li><a href="#inv">MY Score Card</a></li>
                                       
                                      
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">

 </br>


 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
      <thead style="color:#fff;background-color:#000">
    <tr>
      <td>Event Code</td>
        <td>Event Name</td>
       <td>Currency</td>
        <td>Target Value</td>
        <td>Target Start Date</td>
          <td>Target End Date</td>
        <td>Acheived</td>
         <td>Variance</td>
          
          <td>Days Left</td>
        
        <!-- <td>Days Left</td> -->
    </tr>
    </thead>
  <tbody>
      @foreach($userdata as $val)
     <tr>
      @foreach($val as $key=>$xx)
      
       <?php if($key=='variance') {
                        if($xx<0)
                          $color='red';
                        else
                          $color='green';

                      ?><td style="color:<?php echo $color; ?>;text-align:right"><?php   echo $xx ?></td><?php
       } 
       else 
       {
         ?><td ><?php   echo $xx ?></td> <?php } ?>
         
       @endforeach

     </tr>
     @endforeach
  </tbody>
 </table>

 
                                        </div>
                                         <div class="tab-pane" id="inv">
                                         </br>
                                             <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
     <thead style="color:#fff;background-color:#000">
        <tr>
        <td>Company Name</td>
       
        <td>Event Name</td>
        <td>Deal Closed Date</td>
         <td>Deal Value</td>
          <td>Currency</td>
        
        <!-- <td>Days Left</td> -->
    </tr>
</thead>
<tbody>
    @foreach($deals as $data)
     <tr>
      <td>{{$data->Companyname}}</td>
      <td>{{$data->Eventname}}</td>
      <td>{{$data->Dealdate}}</td>
      <td>{{$data->Dealvalue}}</td>
      <td>{{$data->Dealcurr}}</td>
     </tr>
     @endforeach
 </tbody>
 </table>
                                         </div>

                                          <div class="tab-pane" id="variance">
                                          </br>

<script type="text/javascript">
$(document).ready(function(){
  $('.submit').click(function(){            
    $.ajax({
      url: 'variancecard',
      type: "post",
      data: {'Empid':$('select[name=employeeid]').val(), '_token': $('input[name=_token]').val()},
      success: function(data){
        alert(data);
      }
    });      
  }); 
});
</script>
                                            <table>
                                                
                                                <form id="vcard" action="{{ url('/variancecard/variancecard') }}" method="post">
                                                     <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <tr><td>Event Name:</td>
                                                    <td>
                                                       
                                                           <select class="form-control" name="employeeid">

                                                            @foreach($target as $tag)

<option value="{{$tag->Employeeid}}">{{$tag->Eventname}}</option>
 @endforeach
       
                                                   </td>
                                                    <td><button type="submit" class="btn btn-primary submit" name="submit">Submit</button></td>

                                                </tr>
                                            </form>

                                            </table>
                                        </br>
                                             <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
     @foreach($variancedata as $varidata)
     <tr>
         <td>Target Value: {{$varidata->Targetvalue}}</td>
     </tr>
     @endforeach


 </table>
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