@extends('app')

@section('content')
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
    
 <?php if(Auth::User()->role=='super admin'){ ?>
<li ><a class="ajax-link" href="{{ URL::to('home')}}"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a></li>
                                   
<li><a class="ajax-link" href="{{ URL::to('reports')}}"><i class="glyphicon glyphicon-edit"></i><span> Reports</span></a></li>
<li ><a class="ajax-link" href="{{ URL::to('home1') }}"><i class="glyphicon glyphicon-eye-open"></i><span> Task-part1</span></a></li>
<li><a class="ajax-link" href="{{ URL::to('home2') }}"><i class="glyphicon glyphicon-edit"></i><span> Task-part2</span></a></li>
<li class="active"><a class="ajax-link" href="{{URL::to('adduser')}}"><i class="glyphicon glyphicon-edit"></i><span>Add User</span></a></li>
                                   
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

                <p>You need to have <a href="" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
           



<div class="row">
    <div class="box col-md-12">
        <div class="box-inner homepage-box">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-th"></i> Dashboard</h2>

            </div>

        </br>

                                                                           <div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
      @if(Session::has('alert-' . $msg))

      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
    @endforeach
  </div>
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Create Users</a></li>
                  
                    <li><a href="#viewall">View Users</a></li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                    </br>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table">
           <form action="{{ url('/adduser/adduser') }}" method="post"  enctype="multipart/form-data">
                                               <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                              
                                                    <tr >
                                                        <td>Name</td><td>
                                                            <input type="text" class="form-control" autocomplete="off" name="name" >
                                                        </td>
                                                      </tr>

                                                       <tr >
                                                        <td>Email</td><td>
                                                            <input type="email" class="form-control" autocomplete="off" name="email" >
                                                        </td>
                                                      </tr>
                                                     
                                               
                                               </br>
                                               <tr >
                                                <td></td>
                                                <td>

                                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                              </td>
                                            </form>
                                             </table>
                    </div>
              
                     <div class="tab-pane" id="viewall">
                        </br>
    hfkshdkfhsdh
   

                    </div>
                </div>
            </div>
        </div>
    </div>


</div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

  <script type="text/javascript">


$('.invoiceapprove').click(function(e) {
 
   var approveid , approve;
   approveid =$(this).attr('id');
   approve =approveid.split('_');
   approveid=approve[1];
   
    $("#myModal #eventDel").val( approveid );
    
});
  

</script>
<script type="text/javascript">


$('.invoicereject').click(function(e) {
 
   var rejectid , reject;
   rejectid =$(this).attr('id');
   reject =rejectid.split('_');
   rejectid=reject[1];
   
    $("#rejectModal #invoiceRej").val( rejectid );
    
});
  

</script>

    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Approve</h3>
                </div>
                <form action="{{ url('/approveinvoice/approveinvoice') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to approve ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="invoice_approve_id" id="eventDel"  value=""/>
                                  <input type="hidden" name="approve_status" value="1"/>
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


    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Reject</h3>
                </div>
                <form action="{{ url('/rejectinvoice/rejectinvoice') }}" method="post"  enctype="multipart/form-data">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                <div class="modal-body">
                    <p>Do you want to Reject ?</p>
                             <table width="100%"  class="table">
                                 <input type="hidden" name="invoice_reject_id" id="invoiceRej"  value=""/>
                                  <input type="hidden" name="reject_status" value="0"/>
                                  <textarea class="form-control" name="reject_comment" placeholder="Reject with Comments"></textarea>
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


    <footer class="row">
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://www.ide-global.com" target="_blank">www.ide-global.com</a></p>

        <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a
                href="http://usman.it/free-responsive-admin-template">Ide Global</a></p>
    </footer>

</div><!--/.fluid-container-->
@endsection