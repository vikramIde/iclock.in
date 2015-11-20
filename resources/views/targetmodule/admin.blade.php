@extends('css')

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

     $("#table-data").on('change', 'select', function () {
         var val = $(this).val();
         $(this).closest('tr').find('input:text').val(val);
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
      <?php if(Auth::User()->role=='director'){ ?>                          
   <li class="active"><a class="ajax-link" href="{{URL::to('targetmodule/admin')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                     

                                    </li>
                                     <li><a class="ajax-link" href="{{ URL::to('targetmodule/assigntarget')}}"><i class="fa fa-check-square"></i><span> Assign Target</span></a>
                                    </li>
                                     <li><a class="ajax-link" href="{{ URL::to('targetmodule/adduser')}}"><i class="fa fa-plus-square"></i><span> Add User</span></a>
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
                                        <li class="active"><a href="#info">Employee List</a></li>
                                         <li ><a href="#add">Add Employee</a></li>
                                      
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">
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
                                                                  <td  >{{$emp->emp_name}}</td>
                                                                  <td>{{$emp->emp_ide_id}}</td>
                                                                  <td >{{$emp->emp_department}}</td>
                                                                  <td >{{$emp->cat}}</td>
                                                                  
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

                                                            </table>
                                          
                                        </div>

                                        <div class="tab-pane" id="add">
                                        </br>


                                         <form action="{{ url('/addemployee/addemployee') }}" method="post" >
                                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                          <table width="50%" align="center">
                                            <tr>
                                              <td>Name</td>
                                              <td><input type="text" name="empname" class="form-control"></td>
                                            </tr>
                                            <tr>
                                              <td>Employee Id</td>
                                              <td><input type="text" name="empid"  class="form-control"></td>
                                            </tr>
                                            <tr>
                                              <td>Employee Position</td>
                                              <td><input type="text" name="emppos" class="form-control"></td>
                                            </tr>
                                            <tr>
                                              <td>Employee Department</td>
                                              <td><select class="form-control" name="empdept">
                                                <option>--Select--</option>
                                                <option value="CRM">CRM</option>
                                                <option value="Vendors">Vendors</option>
                                                <option value="Delegates">Delegates</option>
                                                <option value="Marketing">Marketing</option>
                                              </select></td>
                                            </tr>
                                            <tr>
                                              <td></td>
                                              <td><button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
                                            </tr>
                                          </table>
                                         </form>
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
                        <form action="{{ url('/updateadmin/updateadmin') }}" method="post"  enctype="multipart/form-data">
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