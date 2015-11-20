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
      <?php if(Auth::User()->role=='admin1'){ ?>                          
   <li ><a class="ajax-link" href="{{ URL::to('home1') }}"><i class="fa fa-tachometer"></i><span> Dashboard</span></a>
                                    </li>
    <li class="active"><a class="ajax-link" href="{{URL::to('dealsclosed')}}"><i class="fa fa-thumbs-o-up"></i><span> Deals Closed</span></a>
                                    </li>
                                    <?php } ?>
 <?php if(Auth::User()->role=='super admin'){ ?>
     <li ><a class="ajax-link" href="{{ URL::to('home')}}"><i class="glyphicon"></i><span> Dashboard</span></a>
                                    </li>
                                   
 <li><a class="ajax-link" href="{{ URL::to('reports')}}"><i
                                    class="glyphicon"></i><span> Reports</span></a></li>
                        <li class="active"><a class="ajax-link" href="{{ URL::to('home1') }}"><i class="glyphicon"></i><span> Task-part1</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('home2') }}"><i
                                    class="glyphicon"></i><span> Task-part2</span></a></li>
                                     <li><a class="ajax-link" href="{{URL::to('adduser')}}"><i
                                    class="glyphicon"></i><span>Add User</span></a></li>
                                   
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Deals Closed</h2>
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
                                        <li class="active"><a href="#info">Deals Closed</a></li>
                                      
                                    </ul>

                                    <div id="myTabContent" class="tab-content">
                                        <div class="tab-pane active" id="info">

 </br>


 <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead style="background:#000;color:#fff">
            <tr >
        <td>Company Name</td>
        <td>Event Code</td>
         <td>Deal Date</td>
          <td>Deal Value</td>
           <td>Currency</td>
           <td>Deal Type</td>
            <td>Employee Id</td>
             <td>Actions</td>
       
    </tr>
        
    </thead>
<tbody>
        @foreach($categories as $val)
     <tr>
        <td>{{$val->Companyname}}</td>
        <td>{{$val->Eventcode}}</td>
        <td>{{$val->Dealdate}}</td>
        <td>{{$val->Dealvalue}}</td>
        <td>{{$val->Dealcurr}}</td>
         <td>{{$val->Dealtype}}</td>
        <td>{{$val->Empid}}</td>
       
         
            <td><a href="{{ URL::to('createinvoice', array('dealid' => $val->Id)) }}" class="btn btn-view"> <i class="fa fa-plus"></i> Create Invoice</a></td>
            

       
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


     

            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://www.ide-global.com" target="_blank">www.ide-global.com</a></p>

                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a href="">Ide Global</a></p>
            </footer>

        </div>
        <!--/.fluid-container-->

        <!-- external javascript -->

 
        <script src="{{asset('/datepicker/js/bootstrap-datepicker.js')}}"></script>
        <link rel="stylesheet" href="{{asset('/datepicker/css/datepicker.css')}}">

      
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