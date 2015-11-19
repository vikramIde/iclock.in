@extends('css')

@section('content')
<!--clone row-->
       <?php $Targetvalue= $dealDate=0 ; ?> 
       
    

    <!--end clone row-->

        <!-- topbar ends -->
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
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
                                     <li ><a class="ajax-link" href="{{ URL::to('targetmodule/eventdeal')}}"><span> Update New Deal</span></a>
                                    </li>
                                        <li class="active"><a class="ajax-link" href="{{ URL::to('targetmodule/variancecard')}}"><span> Variance Card</span></a>
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
                                    <h2><i class="glyphicon glyphicon-th"></i> Variance Card</h2>
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
                                        <li class="active"><a href="#info">Variance Card</a></li>
                                      
                                    </ul>
                                  </br>
                                    <form id="vcard" action="variancecard" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                                            <input type='hidden' class="datepicker" id='startDate' value="<?php echo $targetdate ?>" />
                                            <input type='hidden' class="datepicker" id='endDate' value="<?php echo $eventdate ?>" />
                                            <table align="center">
                                                <tr><td>Event Name:</td>
                                                    <td>
                                                      <select class="form-control" name="event">
                                                            @foreach($target as $tag)
                                                            <?php $empid = $tag->Employeeid ?>
                                                            <option value="{{$tag->Eventname}}">{{$tag->Eventname}}</option>
                                                           @endforeach
                                                        </select>
                                                   </td>
                                                    <td><input type="hidden" name="empid" value="<?php echo $empid ?>" /><button type="submit" class="getvariance btn btn-primary " name="submit">Submit</button></td>

                                                </tr>
                                            </table>
                                           
                                              </form>
                                           <br/>
                                             @foreach($variancedata as $varidata)
                                                   <?php $Targetvalue= $varidata->Targetvalue ?>
                                           <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inr fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Target Value</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left" style="text-align:right;">{{$varidata->Targetvalue}}</span>
                              <!--   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-cash fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Currency</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">{{$varidata->Currency}}</span>
                                <!-- <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-inr fa-3x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"></div>
                                    <div>Achieved</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">@foreach($userdata as $val)
                                                             {{$val['achieved']}}
                                                            @endforeach</span>
                              <!--   <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> -->
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                     <div class="col-lg-3 col-md-6" >
                    <div class="panel panel-warning" style="border:none">
                    <button class="btn btn-view " style="margin-right:5px">Target Date : <?php echo $targetdate ?></button><p>&nbsp;</p>
                    <button class="btn btn-warning ">Event Date : <?php echo $eventdate ?></button>
                    </div>
                </div>
       
            </div>

                                           <table class="table table-striped table-bordered bootstrap-datatable datatable responsive" >
                                              
                                              <tr><td><button id="test" class="btn btn-primary " style="margin-right:5px">See Weekly Report</button><button id="test1" class="btn btn-primary " style="margin-right:5px">See Monthly Report</button><button id="test2" class="btn btn-primary " style="margin-right:5px">See Daily Report</button></td></tr>

                                               @endforeach
                                              </table>

                                        </div>
                                        <div class="row graph">
                                          <div class="col-md-6 weekly">

                                          </div>
                                          <div class="col-md-6">
                                            <a href="#weekly" class="btn btn-primary ">See the Graph </a>
                                          </div>
                                          
                                        
                                      </div>
                                      <div class="row">
                                        <div class="col-md-12">
                                      <div id="weekly"></div>
                                        <div class="montly"></div>
                                        <div class="daily"></div>
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

                                               <!-- Add fancyBox -->

     
            <footer class="row">
                <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="http://www.ide-global.com" target="_blank">www.ide-global.com</a></p>

                <p class="col-md-3 col-sm-3 col-xs-12 powered-by">Powered by: <a href="">Ide Global</a></p>
            </footer>

        </div>
        <!--/.fluid-container-->

        <!-- external javascript -->

 
        <script src="{{asset('/datepicker/js/bootstrap-datepicker.js')}}"></script>
     <!--    // <script type='text/javascript' src="http://momentjs.com/downloads/moment.min.js"></script> -->
        <link rel="stylesheet" href="{{asset('/datepicker/css/datepicker.css')}}">
        

        <script type="text/javascript">

         $(document).ready(function() {

            var month = [31,28,31, 30, 31,30,31,31,30,31,30,31];
                
                //month[12] = 30;
              
          function makeGraph(title ,x_axis,Target,Achieved ){
                      $('#weekly').highcharts({
                      chart: {
                          type: 'line'
                      },
                      title: {
                          text: title
                      },
                      subtitle: {
                          text: 'Source: ide-global.com'
                      },
                      xAxis: {
                          categories: x_axis
                      },
                      yAxis: {
                          title: {
                              text: 'Money'
                          }
                      },
                      plotOptions: {
                          line: {
                              dataLabels: {
                                  enabled: true
                              },
                              enableMouseTracking: false
                          }
                      },
                      series: [{
                          name: 'Target :'+Target[0],
                          data: Target
                      }, {
                          name: 'Achieved',
                          data: Achieved
                      }]
                  });
           
               }
           // Here are the two dates to compare
              var date1 = '<?php echo $targetdate ?>';
              var date2 = '<?php echo $eventdate ?>';
              var Targetvalue = parseFloat("<?php echo $Targetvalue ;?>");
              var dealjson = '<?php echo $dealjson ; ?>';
                

              // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
              date1 = date1.split('-');
              date2 = date2.split('-');

              // Now we convert the array to a Date object, which has several helpful methods
              date1 = new Date(date1[2], date1[1]-1, date1[0]);
              date2 = new Date(date2[2], date2[1]-1, date2[0]);
              var deals = JSON.parse(dealjson);
              
              // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
              date1_unixtime = parseInt(date1.getTime() / 1000);
              date2_unixtime = parseInt(date2.getTime() / 1000);

              // This is the calculated difference in seconds
              var timeDifference = date2_unixtime - date1_unixtime;
              // in Hours
              var timeDifferenceInHours = timeDifference / 60 / 60;

              // and finaly, in days :)
              var timeDifferenceInDays = timeDifferenceInHours / 24;
              var timeDifferenceInWeeks = Math.round(timeDifferenceInDays / 7);
              var timeDifferenceInMonths = Math.round(timeDifferenceInDays / 30);

              // alert(timeDifferenceInDays/7);
              TargetPerweek = Targetvalue / timeDifferenceInWeeks;
              TargetPerday = Math.round((Targetvalue / timeDifferenceInDays)*100)/100;

              //Math.round(timeDifferenceInWeeks);
              TargetPerweek = Math.round(TargetPerweek * 100) / 100;
              TargetPerMonth = Math.round((Targetvalue/timeDifferenceInMonths)*100/100)
              
        $('#test, #test2').click(function(){

            $('html,body').animate({
                scrollTop: $('.graph').offset().top
            }, 1000);

            return false;
        });

        $('#test').click(function () {

              date1_week= date1;
              date2_week= date2;
              var x_axis = [];
              var Target =[];
              var Achieved = [];
              var str = '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive"> <thead style="color:#fff;background-color:#000"><tr> <td>Week</td> <td>Date</td><td>Target</td> <td>Achieved</td> </tr></thead>';

              var i = 0;
              var achieved = 0;
              while (date1_week <= date2_week) {

                  var next_week = new Date(date1_week);
                  next_week.setDate(date1_week.getDate() + 7);
                  achieved = 0;

                  deals.forEach(function (deal) {
                      var dealDate = deal.dealdate;
                      dealDate = dealDate.split('-');
                      dealDate = new Date(dealDate[2], dealDate[1]-1, dealDate[0]);
                      if (dealDate >= date1_week && dealDate <= next_week) {
                          achieved = achieved + deal.cost;
                      }
                  });

                  i = i + 1;
                  mWeek = "Week "+ i ;
                  x_axis.push(mWeek);Target.push(TargetPerweek);Achieved.push(achieved);
                  str = str + "<tr><td>"+ mWeek +"</td><td>"+date1_week.getDate()+"-"+(date1_week.getUTCMonth()+1)+"-"+date1_week.getFullYear()+" - "+next_week.getDate()+"-"+(next_week.getUTCMonth()+1)+"-"+next_week.getFullYear()+"</td><td style='text-align:right'>" + TargetPerweek + "</td><td style='text-align:right'> " + achieved + "</td></tr>";
                  date1_week = next_week;  
              }

              str = str + "</table>";
             makeGraph('Weekly Event Sale Report',x_axis,Target,Achieved );
              $('.weekly').html(str);

        });

        $('#test1').click(function () {

              date1_month= date1;
              date2_month= date2;

              var str1 = '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive"> <thead style="color:#fff;background-color:#000"><tr> <td>Month</td> <td>Date</td><td>Target</td> <td>Achieved</td> </tr></thead>';

              var i = 0;
              var achieved = 0;
              var x_axis = [];
              var Target = [];
              var Achieved = [];

              while (date1_month <= date2_month) {
                  var next_month = new Date(date1_month);
                  next_month.setDate(date1_month.getDate() + 30 );

                  achieved = 0;

                  deals.forEach(function (deal) {
                      var dealDate = deal.dealdate;
                      dealDate = dealDate.split('-');
                      dealDate = new Date(dealDate[2], dealDate[1]-1, dealDate[0]);
                      if (dealDate >= date1_month && dealDate <= next_month)  {
                          achieved = achieved + deal.cost;
                      }
                  });
                  i = i + 1;
                  mDay = "Month " + i;
                  x_axis.push(mDay);
                  Target.push(TargetPerMonth);
                  Achieved.push(achieved);
                  str1 = str1 + "<tr><td>"+ mDay +"</td><td>"+date1_month.getDate()+"-"+(date1_month.getUTCMonth()+1)+"-"+date1_month.getFullYear()+" - "+next_month.getDate()+"-"+(next_month.getUTCMonth()+1)+"-"+next_month.getFullYear()+"</td><td style='text-align:right'>" + TargetPerMonth + "</td><td style='text-align:right'> " + achieved + "</td></tr>";
                  date1_month = next_month;
              }

              str1 = str1 + "</table>";
              makeGraph('Monthly Event Sale Report', x_axis, Target, Achieved);

              $('.weekly').html(str1);

        });
 
$('#test2').click(function () {

    date1_day = date1;
    date2_day = date2;
    var x_axis = [];
    var Target = [];
    var Achieved = [];

    var str1 = '<table class="table table-striped table-bordered bootstrap-datatable datatable responsive"> <thead style="color:#fff;background-color:#000"><tr> <td>Week</td> <td>Date</td><td>Target</td> <td>Achieved</td> </tr></thead>';

    var i = 0;
    var achieved = 0;
    while (date1_day <= date2_day) {
        var next_week = new Date(date1_day);
        next_week.setDate(date1_day.getDate() + 1);
        achieved = 0;
        deals.forEach(function (deal) {
            var dealDate = deal.dealdate;
            dealDate = dealDate.split('-');
            dealDate = new Date(dealDate[2], dealDate[1] - 1, dealDate[0]);
            if (dealDate.getTime() === date1_day.getTime()) {
                achieved = achieved + deal.cost;
            }
        });
        i = i + 1;
        mDay = "Day " + i;
        x_axis.push(mDay);
        Target.push(TargetPerday);
        Achieved.push(achieved);
        str1 = str1 + "<tr><th>Day " + i + "</th><td>" + date1_day.getDate() + "-" + (date1_day.getUTCMonth() + 1) + "-" + date1_day.getFullYear() + "</td><td style='text-align:right'>" + TargetPerday + "</td><td style='text-align:right'> " + achieved + "</td></tr>";
        date1_day = next_week;
    }

    str1 = str1 + "</table>";
    makeGraph('Daily Event Sale Report', x_axis, Target, Achieved);
    $('.weekly').html(str1);

});

             $('.datepicker').datepicker();
               

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