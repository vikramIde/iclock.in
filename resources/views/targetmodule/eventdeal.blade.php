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
      <?php if(Auth::User()->role==''){ ?>                          
   <li ><a class="ajax-link" href="{{ URL::to('targetmodule/targethome')}}"><span> Dashboard</span></a>
                                    </li>
                                     <li class="active"><a class="ajax-link" href="{{ URL::to('targetmodule/eventdeal')}}"><span>Update New Deal</span></a>
                                    </li>
                                     <li><a class="ajax-link" href="{{ URL::to('targetmodule/variancecard')}}"><span> Variance Card</span></a>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Event Deal</h2>
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
                                        <li class="active"><a href="#info">Event Deal</a></li>
                                      
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">
                                        </br>
<form action="{{ url('/dealinsert/dealinsert') }}" method="post"  enctype="multipart/form-data">
                                               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <table class="table">
                                                 @foreach($empid as $e)
                                                <input type="hidden" name="emp_id" value="{{$e->Employeeid}}">
                                                 @endforeach
                                                  <tr>
                                                    <td>
                                                      Client Name
                                                    </td>
                                                    <td><input type="text" name="clientname" class="form-control"></td>
                                                  </tr>
                                                  <tr>
                                                    <td>
                                                      Company Name
                                                    </td>
                                                    <td><input type="text" name="company" class="form-control"></td>
                                                  </tr>
                                                               
<tr>
<td>Event Name</td>
<td>
<select name="eventname" class="form-control">
  <option value="">--Select--</option>
 @foreach($empid as $e)
<option value="{{$e->Eventname}}">{{$e->Eventname}}</option>
 @endforeach
</select>
</td>

</tr>
<tr>
    <td>
 Deal Date
 </td>
 <td>
<input type="text" class="form-control dp dob" name="dealdate">
</td>
</tr>
<tr>
  <td>Deal Value</td>
  <td><input type="text" class="form-control" name="deal_value"></td>
</tr>
<tr>
  <td>Deal Type</td>
  <td><select class="form-control" name="deal_type">
    <option value="">--Select--</option>
    <option value="annual">Annual</option>
    <option value="single">Single</option>
   
    
  </select></td>
</tr>
<tr>
  <td>Deal Currency</td>
  <td><select class="form-control" name="deal_curr">
    <option value="">--Select--</option>
    <option value="INR">INR</option>
    <option value="EURO">EURO</option>
    <option value="USD">USD</option>
    
  </select></td>
</tr>
<tr>
  <td>Contract Sent Date</td>
  <td><input tyep="text" class="form-control dob dp" name="sent_date"></td>
</tr>
<tr>
  <td>Contract Received Date</td>
  <td><input tyep="text" class="form-control dob dp" name="rec_date"></td>
</tr>
<tr>
  <td></td>
  <td>  <button type="submit" class="btn btn-primary" name="submit">Submit</button></td>
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