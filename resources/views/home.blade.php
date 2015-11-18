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
                                
   <li class="active"><a class="ajax-link" href="{{ URL::to('home') }}"><i class="glyphicon glyphicon-home"></i><span> Dashboard</span></a>
                                    </li>
 <li><a class="ajax-link" href="{{ URL::to('reports') }}"><i
                                    class="glyphicon glyphicon-edit"></i><span> Reports</span></a></li>
                        <li><a class="ajax-link" href="{{ URL::to('home1') }}"><i class="glyphicon glyphicon-eye-open"></i><span> Task-part1</span></a>
                        </li>
                        <li><a class="ajax-link" href="{{ URL::to('home2') }}"><i
                                    class="glyphicon glyphicon-edit"></i><span> Task-part2</span></a></li>
                                     <li><a class="ajax-link" href="{{ URL::to('adduser') }}"><i
                                    class="glyphicon glyphicon-edit"></i><span>Add User</span></a></li>
                                   
                                     

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

            </div>
            <div class="box-content">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#info">Reports</a></li>
                   
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane active" id="info">
                    Example
             </div>

                      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
      
                </div>
            </div>
        </div>
    </div>


</div>

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
                            <h3>Settings</h3>
                        </div>
                        <div class="modal-body">
                            <p>Here settings can be configured...</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                        </div>
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