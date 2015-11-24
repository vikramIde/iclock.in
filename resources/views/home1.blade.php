@extends('app')

@section('content')
<!--clone row-->
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
         $clone.find('input:text').val('');
      $clone.find('.dob4').removeAttr('id').removeClass('hasDatepicker');
         $clone.find('.dob4').datepicker({
             format: 'dd-mm-yyyy',
             startDate: '-0m',
             autoclose: true

         });

         $tr.closest('table').append($clone);
     });

     // $("#table-data").on('change', 'select', function () {
     //     var val = $(this).val();
     //     $(this).closest('tr').find('input:text').val(val);
     // });

     
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
      <?php if(Auth::User()->role=='admin1'){ ?>                          
   <li class="active"><a class="ajax-link" href="{{ URL::to('home1') }}" ><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
    <li ><a class="ajax-link" href="{{URL::to('dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>
                                    </li>
                                    
                                    <?php } ?>
 <?php if(Auth::User()->role=='super admin'){ ?>
     <li ><a class="ajax-link" href="{{ URL::to('home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
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
                                        <li class="active"><a href="#info">Master for events</a></li>
                                      
                                        <li><a href="#messages">Sales/Representative</a></li>
                                        <li><a href="#viewall">View Invoices</a></li>
                                        <li><a href="#viewall1">View All Events</a></li>
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">

 </br>
                                            <form action="{{ url('/event/event') }}" method="post"  enctype="multipart/form-data">
                                               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" id="table-data">
                                                    <tr align="center">
                                                        <td>Event Name</td>
                                                        <td>Event Code</td>
                                                        <td>Date</td>
                                                        <td>City</td>
                                                        <td>Country</td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="eventname[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="eventcode[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control dp4 dob4"  autocomplete="off" name="date[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="city[]" >
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" autocomplete="off" name="country[]" >
                                                        </td>
                                                        <td>
                                                            <input type="button" class="btn btn-default addButton" value="Add" />
                                                        </td>
                                                    </tr>
                                                </table>
                                               </br>

                                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                            </form>
                                        </div>
                                       
                                        <div class="tab-pane" id="messages">
                                           </br>
                                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                                     <thead style="color:#fff;background-color:#000">
                                                                    <tr>
                                                                        <td>S.no</td>
                                                                        <td>Emp Name</td>
                                                                        <td>Emp Id</td>
                                                                        <td>Department</td>
                                                                         <td>Category</td>
                                                                        <td>Actions</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach($employee as $emp)
                                                                  <tr>
                                                                  
                                                                  <td>{{$emp->emp_id}}</td>
                                                                  <td  style="width:150px">{{$emp->emp_name}}</td>
                                                                  <td>{{$emp->emp_ide_id}}</td>
                                                                  <td  style="width:150px">{{$emp->emp_department}}</td>
                                                                  <td  style="width:150px">{{$emp->cat}}</td>
                                                                  
                                                                  <td class="center">
                                                                               
                <a class="btn btn-info employee" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $emp->emp_id ?>"  href="">
               <i class="fa fa-pencil"></i>
                Edit
            </a>
            <?php
            if($emp->emp_status=='Active')
            {
              ?>
               <span class="btn btn-success">
               
               {{$emp->emp_status}}
            </span>

              <?php
            }else {

              ?>
           <span class="btn btn-danger">
               {{$emp->emp_status}}
            </span>
              <?php
            
            }
            ?>
        
                                                                            </td>
                                                                  
                                                                </tr>
                                                                @endforeach

                                                                </tbody>
                                                                  <script type="text/javascript">


$('.employee').click(function(e) {
 
   var actoinid , nId,name,employe_id,department,empid;
   actoinid =$(this).attr('id');
   nId =actoinid.split('_');
   empid=nId[1];

  name = $(this).closest("tr").find('td:eq(1)').text();
  employe_id = $(this).closest("tr").find('td:eq(2)').text();
  department = $(this).closest("tr").find('td:eq(3)').text();
  
   
  
    $("#myModal #bookId").val( empid );
    $("#myModal #bookName").val( name );
    $("#myModal #bookemp_id").val( employe_id );
    $("#myModal #bookDept").val( department );
 
  
});
  

</script>
<script type="text/javascript">


$('.empdel').click(function(e) {
 
   var eventdelid , del;
   eventdelid =$(this).attr('id');
   del =eventdelid.split('_');
   eventdel1=del[1];
   
    $("#empdelModal #eventDel").val( eventdel1 );
    
});
  

</script>
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
                                                                        
                                                                        <td>Status</td>
                                                                        <td>Rejected Comments</td>
                                                                        <td>Actions</td>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                  
                                                                   @foreach($invoice as $inv)
                                                                  <tr>
                                                                  
                                                                  <td>{{$inv->Id}}</td>
                                                                  <td style="width:120px">{{$inv->Companyname}}</td>
                                                                  <td style="width:120px">{{$inv->EventName}}</td>
                                                                  <td style="width:120px">{{$inv->RepresentativeNo}}</td>
                                                                  <td style="width:120px">{{$inv->GrandTotal}}</td>
                                                                  <td style="width:120px">{{$inv->CurrencyType}}</td>
                                                               
                                                                  <td class="center" style="width:120px">
            <?php
                                                        if($inv->Status =='1') {?>
                                              <span class="label-success label label-default">Approved</span>
                                                            <?php
                                                        } if($inv->Status == '0'){?>
                                             <span class="label-default label label-danger">Rejected</span>
                                                           <?php
                                                        }if($inv->Status == 'Null')  {?>
                                                        <span class="label-warning label label-default">Pending</span>
                                                        <?php
                                                    }
                                                    ?>
           
        </td>
        <td>{{$inv->RejectedwithComments}}</td>
                                                                  <td class="center">
                                                                    <a class="btn btn-view" target="_blank" href="{{ URL::to('viewinvoice', array('order_id' => $inv->Id)) }}">
              <i class="fa fa-eye"></i>
                View
            </a>
                                                                    <?php
                                                                               if($inv->Status =='1') {?>
                <a class="btn btn-info viewinvoice" data-toggle="modal"  id="event_<?php echo $inv->Id ?>" data-target="#ViewinvoiceModal">
              <i class="fa fa-pencil"></i>
                Edit
            </a>
            <?php
          }
          ?>

         <!-- <a class="btn btn-danger" href="#">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a> -->
                                                                            </td>

                                                                  
                                                                </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                       

                                        </div>


                                        <div class="tab-pane" id="viewall1">
                                         </br>
                                                            <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                                                <thead style="color:#fff;background-color:#000">
                                                                    <tr>
                                                                        <td>S.no</td>
                                                                        <td>Event Name</td>
                                                                        <td>City</td>
                                                                        <td>Country</td>
                                                                        <td>Date</td>
                                                                        
                                                                        <td>Actions</td>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach($categories as $cate)
                                                                  <tr>
                                                                  
                                                                  <td>{{$cate->id}}</td>
                                                                  <td>{{$cate->event}}</td>
                                                                  <td>{{$cate->city}}</td>
                                                                  <td>{{$cate->country}}</td>
                                                                  <td>{{$cate->date}}</td>
                                                                             <td class="center">

                                                                              <?php 
                                                                              $date2= strtotime(date('d-m-Y')); 
                                                                              $date1=strtotime($cate->date);
                                                                           if($date1 > $date2){
                                                                              ?>
                                                                               
                <a class="btn btn-info event" data-toggle="modal"  data-target="#eventModal" id="event_<?php echo $cate->id ?>"  href="">
                <i class="fa fa-pencil"></i>
                Edit
            </a>
            <?php
          }
          ?>
          <?php 
          foreach($invoice as $inv){
          $event1=$inv['Eventcode'];
        }
        ?>
           <?php
           if($event1 != $cate->eventcode){
            
             ?>
          <a class="btn btn-danger DelEve" href="#" data-toggle="modal"  id="event_<?php echo $cate->id ?>" data-target="#DelEventModal">
                <i class="glyphicon glyphicon-trash icon-white"></i>
                Delete
            </a>
          <?php

          }
          ?>
           
            
         
                                                                            </td>
                                                                  
                                                                </tr>
                                                                @endforeach


                                                                </tbody>
                                                                  <script type="text/javascript">


$('.event').click(function(e) {
 
   var eventid , evn,eventname,city,country,date;
   eventid =$(this).attr('id');
   evn =eventid.split('_');
   eventid=evn[1];
   //alert(eventid);

  eventname = $(this).closest("tr").find('td:eq(1)').text();
  city = $(this).closest("tr").find('td:eq(2)').text();
  country = $(this).closest("tr").find('td:eq(3)').text();
  date = $(this).closest("tr").find('td:eq(4)').text();
  
   
  
    $("#eventModal #eventId").val( eventid );
    $("#eventModal #eventName").val( eventname );
    $("#eventModal #eventCity").val( city );
    $("#eventModal #eventCountry").val( country );
    $("#eventModal #eventDate").val(date);

 
  
});
</script>
<script type="text/javascript">
 $('.DelEve').click(function(e) {
 
   var delid , del;
   delid =$(this).attr('id');
   del =delid.split('_');
   del1=del[1];
   // alert(del1);
   
    $("#DelEventModal #delEvent").val( del1 );
    
});
 $('.viewinvoice').click(function(e) {
 
   var delid , del;
   delid =$(this).attr('id');
   del =delid.split('_');
   del1=del[1];
   // alert(del1);
   
    $("#ViewinvoiceModal #viewinvoice").val( del1 );
    
});
</script>
 



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


            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                      <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Employee</h3>
                        </div>
                        <form action="{{ url('/updateemployee/updateemployee') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                             <table width="100%"  class="table">
                                 <input type="hidden" name="emp_id_d" id="bookId"  value=""/>
                              <tr><td>Name</td><td>  <input type="text" class="form-control" name="emp_name" id="bookName" value=""/></td></tr>
                              <tr><td>Id</td><td><input type="text" class="form-control" name="emp_id" id="bookemp_id" value=""/></td></tr>
                              <tr><td>Department</td><td><input type="text" class="form-control" name="emp_dept" id="bookDept" value=""/></td></tr>
                             <tr><td>Employee Staus</td><td><select name="emp_status" class="form-control">
                              <option>--Select--</option>
                              <option value="Active"> Active</option>
                               <option value=" Resigned / Cessation"> Resigned / Cessation</option>
                                <option value="Transferred to non sales"> Transferred to non sales</option>
                              
                            </select></td></tr>
                             </table>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
<!-- 
             <div class="modal fade" id="empdelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Delete Employee</h3>
                        </div>
                        <form action="{{ url('/delete/delete') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          <p>Do you really want to delete ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="emp_del_id" id="eventDel"  value=""/>
                             
                             </table>
                        </div>
                        <div class="modal-footer">
                           
                           <button type="submit" class="btn btn-primary" name="submit">Yes</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div> -->

            <!--event edit popup-->

                <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Event</h3>
                        </div>
                        <form action="{{ url('/eventupdate/eventupdate') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          <table width="100%"  class="table">
                           <input type="hidden" name="even_id" id="eventId"  value=""/>
                            <tr><td>Event Name</td><td> <input class="form-control" type="text" name="eventname" id="eventName" value=""/></td></tr>
                            <tr><td>City</td><td><input class="form-control" type="text" name="eventcity" id="eventCity" value=""/></td></tr>
                            <tr><td>Country</td><td> <input class="form-control" type="text" name="eventcountry" id="eventCountry" value=""/></td></tr>
                            <tr><td>Date</td><td><input class="form-control dob4 dp4" type="text" name="eventdate" id="eventDate" value=""/></td></tr>
                          </table>
                         
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        </div>
                      </form>
                    </div>
                </div>
            </div>


             <div class="modal fade" id="DelEventModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Delete Employee</h3>
                        </div>
                        <form action="{{ url('/delevent/delevent') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          <p>Do you really want to delete ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="evn_del_id" id="delEvent"  value=""/>
                             
                             </table>
                        </div>
                        <div class="modal-footer">
                           
                           <button type="submit" class="btn btn-primary" name="submit">Yes</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>

               <div class="modal fade" id="ViewinvoiceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Invoice Status</h3>
                        </div>
                        <form action="{{ url('/updateinvoice/updateinvoice') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                          
                             <table width="100%"  class="table">
                                 <input type="hidden" name="view_invoice" id="viewinvoice"  value=""/>
                                 <select class="form-control" name="invoice_status">
                                   <option value="">--Select--</option>
                                   <option value="Attended with Modification">Attended with Modification</option>
                                   <option value="Attended without modification">Attended without modification</option>
                                   <option value="Not Attended">Not Attended</option>
                                   <option value="Entitlement">Entitlement</option>
                                 </select>
                             
                             </table>
                        </div>
                        <div class="modal-footer">
                           
                           <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <a href="#" class="btn btn-default" data-dismiss="modal">No</a>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
            <!--end edit popup-->

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