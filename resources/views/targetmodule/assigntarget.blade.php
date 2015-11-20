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
      <?php if(Auth::User()->role=='director'){ ?>                          
  <li ><a class="ajax-link" href="{{URL::to('targetmodule/admin')}}"><span> Dashboard</span></a>
                     

                                    </li>
                                     <li class="active"><a class="ajax-link" href="{{ URL::to('targetmodule/assigntarget')}}"><span> Assign Target</span></a>
                                    </li>
                                     <li><a class="ajax-link" href="{{ URL::to('targetmodule/adduser')}}"><span> Add User</span></a>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Assign Target</h2>
</br>
                                </div>

                                 @if (Session::has('target_error'))
    <div class="alert alert-danger">Target already exists for the current employee</div>
@endif

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
                                        <li class="active"><a href="#info">Add Target</a></li>
                                           <li><a href="#target">View Employee Targets</a></li>
                                         <li><a href="#viewall">Score Card Of Employees</a></li>
                                      
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">
                                        </br>
<form action="{{ url('/targetassign/targetassign') }}" method="post"  enctype="multipart/form-data">
                                               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <table width="50%" align="center">
                                                               
 <tr>
    <td>
 Employee Name
 </td>
 <td>
   <select name="employeeid" class="form-control">
    <option value="">--Select--</option>

     @foreach($employee as $emp)

<option value="{{$emp->emp_ide_id}}">{{$emp->emp_name}}</option>
 @endforeach
 </select>
</td>
</tr>
<tr>
    <td>
 Event Name
 </td>
 <td>
   <select name="eventname" class="form-control">
      <option value="">--Select--</option>

     @foreach($categories as $cat)
<option value="{{$cat->eventcode}}">{{$cat->event}}</option>
 @endforeach
 </select>
</td>
</tr>
<tr>
  <td>Target Value</td>
  <td><input type="text" class="form-control" name="target_value"></td>
</tr>
<tr>
  <td>Target Currency</td>
  <td><select class="form-control" name="currency">
    <option value="">--Select--</option>
    <option value="INR">INR</option>
    <option value="EURO">EURO</option>
    <option value="DOLLOR">DOLLOR</option>
    
  </select></td>
</tr>
<tr>
  <td>Due date for Completion</td>
  <td><input type="text" class="form-control dp dob" name="target_date"></td>
</tr>
<tr>
  <td>Mode of Target</td>
  <td><select class="form-control" name="modeoftarget">
    <option>--Select--</option>
    <option value="Daily">Daily</option>
    <option value="Weekly">Weekly</option>
    <option value="Fortnight">Fortnight</option>
    <option value="Monthly">Monthly</option>
    <option value="Quarterly">Quarterly</option>
    <option value="Annual">Annual</option>
  </select>
</td>
</tr>
<tr>
  <td></td>
  <td>  <button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
</tr>
                                                            </table>
                                                          </form>
                                          
                                        </div>

                                         <div class="tab-pane" id="viewall">
                                        </br>
                                        <button id="downloadIntermidiate" class="btn btn-success" style="float:right">Download Excel</button>

                                        <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" id="scorecard">
                                      <thead style="color:#fff;background-color:#000">
                                              <tr >
                                                <td>Event Code</td>
        
        <td>Event  Name</td>
   <!--  <td>Employee Name</td> -->
        <td>Employee Id</td>
        <td>Target Value</td>
        <td>Acheived</td>
         <td>Variance</td>
          <td>Currency</td>
        
        <!-- <td>Days Left</td> -->
    </tr>
                                       </thead>
                                                                <tbody>
      @foreach($userdata as $val)
     <tr>
      @foreach($val as $key=>$xx)
       <?php if($key=='variance' ) {
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

                                          <div class="tab-pane" id="target">
                                          </br>
                                                 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                                      <thead style="color:#fff;background-color:#000">
                                        <tr>
                                              <td>Event Code</td>
                                          <td>Event Name</td>
                                           <td>Emp Id</td>
                                            
                                              <td>Target Assigned</td>
                                              <td>Date of Assign</td>
                                              <td>Due date for completion</td>
                                              <td>No of days given to achive</td>
                                              <td>Options</td>
                                        
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($targets as $emptarget)
                                        <tr>
                                           <td>{{$emptarget->Eventcode}}</td> 
                                          <td style="width:170px">{{$emptarget->Eventname}}</td>
                                           <td>{{$emptarget->Employeeid}}</td>

                                       
                                           <td style="text-align:right">{{$emptarget->Targetvalue}}</td>
                                           <td>{{$emptarget->Targetassigned}}</td>
                                           <td>{{$emptarget->Targetdate}}</td>

                                           <td><?php
                                           
                                            $diff=strtotime($emptarget->Targetdate)-strtotime($emptarget->Targetassigned);
                                            $days=floor($diff/(60*60*24));
                                            echo $days;

                                           
                                           ?></td>
                                              <td class="center">
                                                                               
                <a class="btn btn-info employee" data-toggle="modal"  data-target="#myModal" id="action_<?php echo $emptarget->Id ?>"  href="">
              
                Edit
            </a>
            <a class="btn btn-warning"href="">
             
                Print
            </a>
            
        
                                                                            </td>

                                      
                                        </tr>
                                        @endforeach
                                      </tbody>
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
  <script type="text/javascript">


$('.employee').click(function(e) {
 
   var actoinid , nId,tableid,eventcode,eventname,employeeid,targetvalue,dateofassign,duedate;
   actoinid =$(this).attr('id');
   nId =actoinid.split('_');
   tableid=nId[1];

  eventcode = $(this).closest("tr").find('td:eq(0)').text();
  eventname = $(this).closest("tr").find('td:eq(1)').text();
  employeeid = $(this).closest("tr").find('td:eq(2)').text();
   targetvalue = $(this).closest("tr").find('td:eq(3)').text();
  dateofassign = $(this).closest("tr").find('td:eq(4)').text();
   duedate = $(this).closest("tr").find('td:eq(5)').text();
  
   
  
    $("#myModal #bookId").val( tableid );
    $("#myModal #eventcode").val( eventcode );
    $("#myModal #eventname").val( eventname );
  
    $("#myModal #employeeid").val( employeeid );
    $("#myModal #targetvalue").val( targetvalue );
    $("#myModal #dateofassign").val( dateofassign );
     $("#myModal #duedate").val( duedate );

 
  
});
  

</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">×</button>
                            <h3>Edit Target</h3>
                        </div>
                        <form action="{{ url('/updatetargetassign/updatetargetassign') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <div class="modal-body">
                             <table width="100%"  class="table">
                                 <input type="hidden" name="targetid" id="bookId"  value=""/>
                              <tr><td>Event Code</td><td>  <input type="text" class="form-control" name="eventcode" id="eventcode" value="" disabled/></td></tr>
                              <tr><td>Event Name</td><td><input type="text" class="form-control" name="eventname" id="eventname" value="" disabled/></td></tr>
                              <tr><td>Emp Id</td><td><input type="text" class="form-control" name="employeeid" id="employeeid" value="" disabled/></td></tr>
                             <tr><td>Target Assigned</td><td><input type="text" class="form-control " name="targetvalue" id="targetvalue" value=""/></td></tr>
                               <tr><td>Date Of Assign</td><td><input type="text" class="form-control " name="dateofassign" id="dateofassign" value="" disabled/></td></tr>
                                  <tr><td>Due Date for Completion</td><td><input type="text" class="form-control dob" name="duedate" id="duedate" value=""/></td></tr>
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
     

            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://www.ide-global.com" target="_blank">www.ide-global.com</a></p>

                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a href="">Ide Global</a></p>
            </footer>

        </div>
        <!--/.fluid-container-->

        <!-- external javascript -->
          <script src="{{asset('/js/jquery.table2excel.js')}}"></script>
<script>
      $(function() {
                  $("#downloadIntermidiate").click(function(){

                        $("#scorecard").table2excel({
                              exclude: ".noExl",
                        name: "Excel Document intermediateTable"
                        }); 
                        
                         });
                 
              
            });
</script>
 <style>
.datepicker{z-index:1151 !important;}
</style>
        <script src="{{asset('/datepicker/js/bootstrap-datepicker.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/datepicker/css/datepicker.css')}}">

        <script type="text/javascript">
           
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

   
@endsection