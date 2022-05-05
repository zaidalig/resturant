<?php 
    $ci =& get_instance();  
?>
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="mediumModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Import Attendance</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="upload_excel" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Upload Attendance:</label>
                        <input id="" name="csv" type="file" class="form-control bor-radius5" placeholder="" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Upload">
                    </div>
                </form>
            </div>                                        
        </div>
    </div>
</div>
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
                                            
                                            <h5 class="m-b-10">Import Attendance List
                                                <span data-toggle="modal" data-target="#mediumModal">
                                                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-sm" data-toggle="tooltip" data-placement="left" title="Import Attendance">
                                                        <span class="fa fa-plus" ></span>
                                                    </a>
                                                </span>
                                            </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Import Attendance List</a></li>
                                                <br>
                                                <table width="100%">
                                                    <form method="POST" action="<?php echo base_url(); ?>employees/generateImport">
                                                        <tr>
                                                            <td width="8%"></td>
                                                            <td width="5%"><label>From:</label></td>
                                                            <td width="20%"> <input type="date" name= "from" class = "form-control" value="<?php echo $from ?>" required></td>
                                                            <td width="3%"></td>
                                                            <td width="5%"><label>To:</label></td>
                                                            <td width="20%"> <input type="date" name= "to" class = "form-control" value="<?php echo $to ?>" required></td>
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
                                            <div class="card-header-right">
												<ul class="list-unstyled card-option">
													<li><i class="fa fa-chevron-left"></i></li>
													<li><i class="fa fa-window-maximize full-card"></i></li>
													<li><i class="fa fa-minus minimize-card"></i></li>
													<li><i class="fa fa-refresh reload-card"></i></li>
													<li><i class="fa fa-times close-card"></i></li>
												</ul>
											</div>

                                        </div>
                                        <div class="card-block table-border-style">
                                            <div class="table-responsive">
                                                <table class="table" id="myTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Employee Number</th>
                                                            <th>Employee Name</th>
                                                            <th>Time In</th>
                                                            <th>Time Out</th>
                                                            <th>Break Out</th>
                                                            <th>Break In</th>
                                                            <th>Number of Hours</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 
                                                        foreach($import AS $i){ 
                                                            if($i->status==1){ 
                                                                $status = '<span class="label label-warning pull-right">ontime</span>'; 
                                                            } else { 
                                                                $status = '<span class="label label-danger pull-right">late</span>'; 
                                                            } 
                                                    ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo $i->date; ?></td>
                                                            <td><?php echo $i->biometric_num; ?></td>
                                                            <td><?php echo $i->employee_name; ?></td>
                                                            <td><?php echo (!empty($i->time_in)) ? date('h:i A', strtotime($i->time_in)).$status : ''; ?></td>
                                                            <td><?php echo (!empty($i->time_out)) ? date('h:i A', strtotime($i->time_out)) : ''; ?></td>
                                                            <td><?php echo (!empty($i->dtr_breakout)) ? date('h:i A', strtotime($i->dtr_breakout)) : ''; ?></td>
                                                            <td><?php echo (!empty($i->dtr_breakin)) ? date('h:i A', strtotime($i->dtr_breakin)) : ''; ?></td>
                                                            <td><?php echo number_format($i->num_hr,2)." hr/s"; ?></td>
                                                        </tr>
                                                    <?php } ?>
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
