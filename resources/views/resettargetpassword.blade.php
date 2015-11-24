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
      <?php if(Auth::User()->role==''){ ?>                          
                                    <li ><a class="ajax-link" href="{{ URL::to('targetmodule/targethome')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="{{ URL::to('targetmodule/eventdeal')}}"><i class="fa fa-pencil-square-o"></i><span> Update New Deal</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="{{ URL::to('targetmodule/variancecard')}}"><i class="fa fa-line-chart"></i><span> Variance Card</span></a>
                                    </li>
                                    <li class="active"><a class="ajax-link" href="{{ URL::to('resetpass')}}"><i class="fa fa-undo"></i><span> Reset Password</span></a>
                                    </li>

                                    <?php } ?>
              <?php if(Auth::User()->role=='director'){ ?>                          
                                     <li ><a class="ajax-link" href="{{ URL::to('targetmodule/admin')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
                                     <li><a class="ajax-link" href="{{ URL::to('targetmodule/assigntarget')}}"><i class="fa fa-check-square"></i><span> Assign Target</span></a>
                                    </li>
                                    <li><a class="ajax-link" href="{{ URL::to('targetmodule/assigntarget')}}"><i class="fa fa-plus-square"></i><span> Add User</span></a>
                                    </li>
                                    <li class="active"><a class="ajax-link" href="{{ URL::to('resetpass')}}"><i class="fa fa-undo"></i><span> Reset Password</span></a>
                                    </li>


                                    <?php } ?>
                                                          
      <?php if(Auth::User()->role=='admin1'){ ?>                          
                                    <li ><a class="ajax-link" href="{{ URL::to('home1') }}" ><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
                                    <li ><a class="ajax-link" href="{{URL::to('dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>
                                    </li>
                                     <li class="active"><a class="ajax-link" href="{{ URL::to('resetpass')}}"><i class="fa fa-undo"></i><span> Reset Password</span></a>
                                    </li>
                                    <?php } ?>
      <?php if(Auth::User()->role=='admin2'){ ?>                          
                                    <li ><a class="ajax-link" ><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
                                      <li class="active"><a class="ajax-link" href="{{ URL::to('resetpass')}}"><i class="fa fa-undo"></i><span> Reset Password</span></a>
                                    </li>
                                    <?php } ?>
         <?php if(Auth::User()->role=='collector'){ ?>                          
                                       <li ><a class="ajax-link" href="{{ URL::to('collection/home')}}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
                                      <li class="active"><a class="ajax-link" href="{{ URL::to('resetpass')}}"><i class="fa fa-undo"></i><span> Reset Password</span></a>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Reset Password </h2>
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
                                        <li class="active"><a href="#info">Reset Password</a></li>
                                         
                                      
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">
                                        </br>
                                  <form class="form-horizontal" role="form" method="POST" action="{{ url('/reset') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            

            
                <input type="hidden" class="form-control" autocomplete="off" name="userid" value="{{ Auth::user()->id }} ">
            

            <div class="form-group">
              <label class="col-md-4 control-label">Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control" autocomplete="off" name="password">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Confirm Password</label>
              <div class="col-md-6">
                <input type="password" class="form-control"  autocomplete="off"name="password_confirmation">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Reset Password
                </button>
              </div>
            </div>
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

        
   
@endsection