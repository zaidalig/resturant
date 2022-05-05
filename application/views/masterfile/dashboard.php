<?php 
    $ci =& get_instance();  
    $yr = date("Y");
    $to = date('Y-m-d');
    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));
?>
<script src="<?php echo base_url(); ?>assets/js/multi/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-multiselect.css" type="text/css"/>
<script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>

                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">

                                    <div class="page-body">
                                      <div class="row">

                                            <!-- order-card start -->
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-blue order-card">
                                                    <a href="<?php echo base_url(); ?>employees/employee_list" style="color:white" data-toggle="tooltip" data-placement="top" title="See More">
                                                        <div class="card-block">
                                                            <h6 class="m-b-20">Total Employees</h6>
                                                            <h2 class="text-right"><i class="ti-user f-left"></i><span><?php echo $emp_count; ?></span></h2>
                                                            <!-- <p class="m-b-0">Completed Orders<span class="f-right">351</span></p> -->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-green order-card">
                                                    <a href="<?php echo base_url(); ?>employees/import_list" style="color:white" data-toggle="tooltip" data-placement="top" title="See More">
                                                        <div class="card-block">
                                                            <h6 class="m-b-20">On Time Percentage</h6>
                                                            <h2 class="text-right"><i class="ti-pie-chart f-left"></i><span><?php echo number_format($percentage,2)."%"; ?></span></h2>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-yellow order-card">
                                                    <a href="<?php echo base_url(); ?>employees/import_list/<?php echo $from; ?>/<?php echo $to; ?>" style="color:white" data-toggle="tooltip" data-placement="top" title="See More">
                                                        <div class="card-block">
                                                            <h6 class="m-b-20">On Time This Month</h6>
                                                            <h2 class="text-right"><i class="ti-timer f-left"></i><span><?php echo $on_time; ?></span></h2>
                                                            <!-- <p class="m-b-0">This Month<span class="f-right">$5,032</span></p> -->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-3">
                                                <div class="card bg-c-pink order-card">
                                                    <a href="<?php echo base_url(); ?>employees/import_list" style="color:white" data-toggle="tooltip" data-placement="top" title="See More">
                                                        <div class="card-block">
                                                            <h6 class="m-b-20">Late This Month</h6>
                                                            <h2 class="text-right"><i class="ti-alert f-left"></i><span><?php echo $late; ?></span></h2>
                                                            <!-- <p class="m-b-0">This Month<span class="f-right">$542</span></p> -->
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- order-card end -->

                                            <!-- statustic and process start -->
                                            <div class="col-lg-8 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Monthly Biometrics Attendance Report</h5>
                                                        <div class="card-header-right">
                                                            <!-- <ul class="list-unstyled card-option">
                                                                <li><i class="fa fa-chevron-left"></i></li>
                                                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                                                <li><i class="fa fa-minus minimize-card"></i></li>
                                                                <li><i class="fa fa-refresh reload-card"></i></li>
                                                                <li><i class="fa fa-times close-card"></i></li>
                                                            </ul> -->
                                                            <div class="form-group">
                                                                <select class="form-control pull-right" name="year" id="year" onchange="chooseYear();">
                                                                    <option value=''>-Select Year-</option>
                                                                    <?php
                                                                        $curr_year = date('Y'); 
                                                                        for($x=2015;$x<=$curr_year;$x++){ 
                                                                            $years = (!empty($year)) ? $year : $yr;
                                                                    ?>
                                                                        <option value="<?php echo $x; ?>" <?php echo ($x==$years) ? 'selected':''; ?>><?php echo $x; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-block" style="width:665px">
                                                        <div id="legend" class="text-center"></div>
                                                        <canvas id="barChart" height="100"></canvas>
                                                        <input type="hidden" name="month" id="month">
                                                        <input type="hidden" name="late" id="late">
                                                        <input type="hidden" name="ontime" id="ontime">
                                                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12">
                                                <div class="card">
                                                    <div class="card-block">
                                                        <canvas id="pie-chart" height="400"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- statustic and process end -->
                                            <div class="modal fade" id="reservation_list" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="mediumModalLabel">Reservation List</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless table-striped table-earning table-hover" id="myTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Name</th>
                                                                            <th>Hut Number</th>
                                                                            <th>Table Number</th>
                                                                            <th>Start Date</th>
                                                                            <th>End Date</th>
                                                                            <th>Orders</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <?php 
                                                                        foreach($reserve as $res){ 
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $res['fullname'];?></td>
                                                                            <td><?php echo $res['hut_name'];?></td>
                                                                            <td><?php echo $res['table_no'];?></td>
                                                                            <td><?php echo $res['start_date'];?></td>
                                                                            <td><?php echo $res['end_date'];?></td>
                                                                            <td><?php echo $res['menu'];?></td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="DoneModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="mediumModalLabel">Tag Reservation Done</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action = "<?php echo base_url(); ?>masterfile/done_reservation">
                                                                <div class="form-group">
                                                                    <label for="" class="control-label mb-1">Hut Name:</label>
                                                                    <select name="hut_name[]" class="form-control bor-radius5" id="hutmult" multiple="multiple">
                                                                            <?php 
                                                                                foreach($hut_done AS $h){ 
                                                                                    if($h['hut_id']!=0){
                                                                            ?>
                                                                            <option value = "<?php echo $h['hut_id'].','.$h['res_det_id'].','.$h['reservation_id']; ?>"><?php echo $h['hut_name']; ?></option>
                                                                            <?php } } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="" class="control-label mb-1">Table Name:</label>
                                                                    <select name="table_name[]" class="form-control bor-radius5" id="tablemult" multiple="multiple">
                                                                            <?php 
                                                                                foreach($table_done AS $t){ 
                                                                                    if($t['table_id']!=0){ 
                                                                            ?>
                                                                            <option value = "<?php echo $t['table_id'].','.$t['res_det_id'].','.$t['reservation_id']; ?>"><?php echo $t['table_no']; ?></option>
                                                                            <?php } } ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" class="btn btn-success btn-block">Tag as Done</button>
                                                                </div>
                                                            </form>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="reserveModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-md" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="mediumModalLabel">Add New Reservation</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action = "<?php echo base_url(); ?>masterfile/add_reservations">
                                                                <?php if(!empty($hut)){ ?>
                                                                    <div class="form-group">
                                                                        <label for="" class="control-label mb-1">Hut Number:</label>
                                                                        <select name="hut_name" class="form-control bor-radius5" id="image" onChange="imageUpdate();" required>
                                                                            <option value = "">--Select Hut--</option>
                                                                            <?php foreach($hut AS $h){ ?>
                                                                            <option value = "<?php echo $h->hut_id; ?>" myTag="<?php echo $h->hut_image;?>"><?php echo $h->hut_name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <!--<div class="form-group">
                                                                        <div class="thumbnail" style="width: 150px">
                                                                            <img class="imageNews"  />
                                                                        </div>                       
                                                                    </div>-->
                                                                    <div class="form-group">
                                                                        <label for="" class="control-label mb-1">Start Date:</label>
                                                                        <input name="start" type="date" class="form-control bor-radius5" placeholder="" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="" class="control-label mb-1">End Date:</label>
                                                                        <input name="end" type="date" class="form-control bor-radius5" placeholder="" required>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group">
                                                                        <input type="submit" class="btn btn-info btn-block" value ="Submit">
                                                                    </div>
                                                                <?php }else { ?>
                                                                    <h1><center><b>Fully Booked!<br><span class="fa fa-warning animated pulse infinite m-t-50" style ="font-size:200px;color:#ff3737"></span></b></center></h1>
                                                                <?php } ?>
                                                                <input type="hidden" name="baseurl" id="baseurl" value ="<?php echo base_url(); ?>">
                                                            </form>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                            </div>
											<!-- tabs card start -->
                                            <div class="col-sm-12">
                                                <div class="card tabs-card">
                                                    <div class="card-block">
                                                        <a data-toggle="modal" data-target="#DoneModal" class = "btn btn-success pull-right" style="color:white"><i class = "fa fa-check"></i> Done Reservations</a>
                                                        <a href="<?php echo base_url(); ?>users/reserve_order/admin" target='_blank' class = "btn btn-primary pull-right" style="color:white"><i class = "fa fa-check"></i> Create Reservations</a>
                                                        
                                                        <br>
                                                        <div class="tab-content card-block">
                                                            <div class="tab-pane active" id="home3" role="tabpanel">
                                                                <input type="hidden" name="baseurl" id="baseurl" value ="<?php echo base_url(); ?>">
                                                                <div id='calendar'></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- tabs card end -->
                                        </div>
                                    </div>
                                    <div id="styleSelector"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php 
    if(!empty($year)){
        $and = 'AND YEAR(r.start_date) = '.$year;
        $months = array();
        $huts = array();
        $tables = array();
        for( $m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM reservation r INNER JOIN reservation_details rd ON r.reservation_id = rd.reservation_id WHERE MONTH(r.start_date) = '$m' AND rd.hut_id!='0' $and";
            $query = $this->db->query($sql);
            array_push($huts, $query->num_rows());

            $sqli = "SELECT * FROM reservation r INNER JOIN reservation_details rd ON r.reservation_id = rd.reservation_id WHERE MONTH(r.start_date) = '$m' AND rd.table_id!='0' $and";
            $lquery = $this->db->query($sqli);
            array_push($tables, $lquery->num_rows());
            $month =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }

        $months = json_encode($months);
        $huts = json_encode($huts);
        $tables = json_encode($tables);
    }else{
        $and = 'AND YEAR(r.start_date) = '.$yr;
        $months = array();
        $huts = array();
        $tables = array();
        for( $m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM reservation r INNER JOIN reservation_details rd ON r.reservation_id = rd.reservation_id WHERE MONTH(r.start_date) = '$m' AND rd.hut_id!='0' $and";
            $query = $this->db->query($sql);
            array_push($huts, $query->num_rows());

            $sqli = "SELECT * FROM reservation r INNER JOIN reservation_details rd ON r.reservation_id = rd.reservation_id WHERE MONTH(r.start_date) = '$m' AND rd.table_id!='0' $and";
            $lquery = $this->db->query($sqli);
            array_push($tables, $lquery->num_rows());
            $month =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }

        $months = json_encode($months);
        $huts = json_encode($huts);
        $tables = json_encode($tables);
    }
?>
<script type="text/javascript">    
    new Chart(document.getElementById("pie-chart"), {
    type: 'bar',
    data: {
      labels: <?php echo $months; ?>,
      datasets: [{
          label: "Huts",
          type: "line",
          borderColor: "#ff7e7e",
          data: <?php echo $huts; ?>,
          fill: false
        },
        {
          label: "Table",
          type: "line",
          borderColor: "#f8e000",
          data: <?php echo $tables; ?>,
          fill: false
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Monthly Reservation of Huts and Table'
      },
      legend: { display: true }
    }
});

</script>
<?php 
    if(!empty($year)){
        $and = 'AND YEAR(date) = '.$year;
        $months = array();
        $ontime = array();
        $late = array();
        for( $m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM biometrics_attendance WHERE MONTH(date) = '$m' AND status = 1 $and";
            $query = $this->db->query($sql);
            array_push($ontime, $query->num_rows());

            $sqli = "SELECT * FROM biometrics_attendance WHERE MONTH(date) = '$m' AND status = 0 $and";
            $lquery = $this->db->query($sqli);
            array_push($late, $lquery->num_rows());

            $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
            $month =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }

        $months = json_encode($months);
        $late = json_encode($late);
        $ontime = json_encode($ontime);
    }else{
        $and = 'AND YEAR(date) = '.$yr;
        $months = array();
        $ontime = array();
        $late = array();
        for( $m = 1; $m <= 12; $m++ ) {
            $sql = "SELECT * FROM biometrics_attendance WHERE MONTH(date) = '$m' AND status = 1 $and";
            $query = $this->db->query($sql);
            array_push($ontime, $query->num_rows());

            $sqli = "SELECT * FROM biometrics_attendance WHERE MONTH(date) = '$m' AND status = 0 $and";
            $lquery = $this->db->query($sqli);
            array_push($late, $lquery->num_rows());

            $num = str_pad( $m, 2, 0, STR_PAD_LEFT );
            $month =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);
        }

        $months = json_encode($months);
        $late = json_encode($late);
        $ontime = json_encode($ontime);
    }
?>
<script>
window.onload = function () {
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChart = new Chart(barChartCanvas)
    var barChartData = {
        labels  : <?php echo $months; ?>,
        datasets: [
          {
            label               : 'Late',
            fillColor           : 'rgba(210, 214, 222, 1)',
            strokeColor         : 'rgba(210, 214, 222, 1)',
            pointColor          : 'rgba(210, 214, 222, 1)',
            pointStrokeColor    : '#c1c7d1',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data                : <?php echo $late; ?>
          },
          {
            label               : 'Ontime',
            fillColor           : 'rgba(60,141,188,0.9)',
            strokeColor         : 'rgba(60,141,188,0.8)',
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : <?php echo $ontime; ?>
          }
        ]
    }
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
        //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
        scaleBeginAtZero        : true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines      : true,
        //String - Colour of the grid lines
        scaleGridLineColor      : 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth      : 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines  : true,
        //Boolean - If there is a stroke on each bar
        barShowStroke           : true,
        //Number - Pixel width of the bar stroke
        barStrokeWidth          : 2,
        //Number - Spacing between each of the X value sets
        barValueSpacing         : 5,
        //Number - Spacing between data sets within X values
        barDatasetSpacing       : 1,
        //String - A legend template
        legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to make the chart responsive
        responsive              : true,
        maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    var myChart = barChart.Bar(barChartData, barChartOptions)
    document.getElementById('legend').innerHTML = myChart.generateLegend();
}
</script>
<script>
    function chooseYear(){
        var loc= document.getElementById("baseurl").value;
        var year= document.getElementById("year").value;
        window.location.href  = loc+'masterfile/dashboard/'+year;
    }
</script>
<script id="example">
    $('#hutmult').multiselect({
        enableClickableOptGroups: true
    });

    $('#tablemult').multiselect({
        enableClickableOptGroups: true
    });
</script>
