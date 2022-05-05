<?php 
    $ci =& get_instance(); 
?>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
									<!-- Page-header start -->
                                    <div class="page-header card">
                                        <div class="card-block">
                                            
                                            <h5 class="m-b-10">Reservation List</h5>
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Reservation List</a></li><br>
                                               <table width="100%">
                                                    <form method="POST" action="<?php echo base_url(); ?>masterfile/generateReserve">
                                                        <tr>
                                                            <td width="8%"></td>
                                                            <td width="5%"><label>From:</label></td>
                                                            <td width="20%"> <input type="date" name= "from" value="<?php echo $from ?>" class = "form-control" required></td>
                                                            <td width="3%"></td>
                                                            <td width="5%"><label>To:</label></td>
                                                            <td width="20%"> <input type="date" name= "to" value="<?php echo $to ?>" class = "form-control" required></td>
                                                            <td width="2%"></td>
                                                            <td width="10%"><input name='generate' type="submit" class="btn btn-primary" value = "Search"></td>
                                                        </tr>
                                                    </form>            
                                                </table>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Page-header end -->
                                    
                                <!-- Page-body start -->
                                <div class="page-body">
                                    <!-- Basic table card start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <!-- <h5>Basic table</h5>
                                            <span>use class <code>table</code> inside table element</span> -->
                                            <!-- <div class="card-header-right"> -->
												<!-- <ul class="list-unstyled card-option">
													<li><i class="fa fa-chevron-left"></i></li>
													<li><i class="fa fa-window-maximize full-card"></i></li>
													<li><i class="fa fa-minus minimize-card"></i></li>
													<li><i class="fa fa-refresh reload-card"></i></li>
													<li><i class="fa fa-times close-card"></i></li>
												</ul> -->
                                                <a href="<?php echo base_url(); ?>masterfile/export_reserve/<?php echo $from; ?>/<?php echo $to; ?>" target="_blank" class = "btn btn-success pull-right">Reservations</a>
                                            <!-- </div>
                                            <br> -->
                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table" id="myTable">
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
                                                    <tbody>
                                                    <?php 
                                                        if(!empty($reserve)){ 
                                                            foreach($reserve AS $res){ 
                                                                /*$me = explode(",", $res['menu']);               
                                                                $count = count($me)-1;
                                                                $men='';
                                                                for($x=0;$x<$count;$x++){
                                                                    $men.= "<b>- ".$ci->get_menu($me[$x]). "</b><br>";
                                                                } 
                                                                $menu = substr($men, 0, -2);

                                                                $tabs = explode(",", $res['table_id']);  
                                                                $count = count($tabs);
                                                                $tab='';
                                                                for($x=0;$x<$count;$x++){
                                                                    $tab.= $ci->get_table($tabs[$x]). ", ";
                                                                } 
                                                                $table = substr($tab, 0, -2);*/
                                                    ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo $res['fullname'];?></td>
                                                            <td><?php echo $res['hut_name'];?></td>
                                                            <td><?php echo $res['table'];?></td>
                                                            <td><?php echo $res['start_date'];?></td>
                                                            <td><?php echo $res['end_date'];?></td>
                                                            <td><?php echo $res['menu'];?></td>
                                                        </tr>
                                                    <?php } } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Basic table card end -->
                                </div>
                                <!-- Page-body end -->
                            </div>
                        </div>
                        <!-- Main-body end -->

                        <div id="styleSelector">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
