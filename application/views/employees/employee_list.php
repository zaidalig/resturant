<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="mediumModal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Employee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>employees/insert_employee" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="control-label mb-1">Biometric No.:</label>
                        <input id="" name="bio_num" type="text" class="form-control bor-radius5" placeholder="" required>
                        <label for="" class="control-label mb-1">Firstname:</label>
                        <input id="" name="fname" type="text" class="form-control bor-radius5" placeholder="" required>
                        <label for="" class="control-label mb-1">Lastname:</label>
                        <input id="" name="lname" type="text" class="form-control bor-radius5" placeholder="" required>
                        <label for="" class="control-label mb-1">Address:</label>
                        <input id="" name="address" type="text" class="form-control bor-radius5" placeholder="" required>
                        <label for="" class="control-label mb-1">Birthdate:</label>
                        <input id="" name="bday" type="date" class="form-control bor-radius5" placeholder="" required>
                        <label for="" class="control-label mb-1">Contact Info:</label>
                        <input id="" name="contact_info" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Gender:</label>
                        <select class="form-control bor-radius5" name="gender" id="gender">
                            <option value="">- Select Gender -</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="control-label mb-1">SSS Deduction:</label>
                        <input id="" name="sss_amount" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Pag-Ibig Deduction:</label>
                        <input id="" name="pagibig_amount" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">PhilHealth Deduction:</label>
                        <input id="" name="philhealth_amount" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Position:</label>
                        <select class="form-control bor-radius5" name="position" id="position">
                            <option value="">- Select Position -</option>
                            <?php foreach($position AS $p){ ?>
                            <option value="<?php echo $p->position_id;?>"><?php echo $p->position_name;?></option>
                            <?php } ?>
                        </select>
                        <label for="" class="control-label mb-1">Schedule:</label>
                        <select class="form-control bor-radius5" name="schedule" id="schedule" required="">
                            <option value="">- Select Schedule -</option>
                            <?php foreach($schedule AS $p){ ?>
                            <option value="<?php echo $p->schedule_id;?>"><?php echo $p->time_in." - ".$p->time_out;?></option>
                            <?php } ?>
                        </select>
                        <label for="" class="control-label mb-1">Photo:</label>
                        <input id="" name="photo" type="file" class="form-control bor-radius5" placeholder="">
                    </div>
                </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
            </div>                                        
        </div>
    </div>
</div>
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="updateEmp">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Employee</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>employees/update_employee" enctype="multipart/form-data">
                    <div class="form-group">
                        <div id = 'employ'></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url(); ?>">
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                    </div>
                </form>
            </div>                                        
        </div>
    </div>
</div>
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="edit_photo">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>employees/update_photo" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Photo:</label>
                        <input id="image" name="image" type="file" class="form-control bor-radius5" placeholder="" required>
                        <input id="employee_id" name="employee_id" type="hidden" class="form-control bor-radius5">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
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
                                            
                                            <h5 class="m-b-10">Employee List
                                                <span data-toggle="modal" data-target="#mediumModal">
                                                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-sm" data-toggle="tooltip" data-placement="left" title="Add New Employee">
                                                        <span class="fa fa-plus" ></span>
                                                    </a>
                                                </span>
                                            </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Employee List</a></li>
                                                        <!-- <li class="breadcrumb-item"><a href="#!">Bootstrap Basic Tables</a>
                                                        </li> -->
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
                                                            <th>Biometric No.</th>
                                                            <th>Photo</th>
                                                            <th>Name</th>
                                                            <th>Position</th>
                                                            <th>Schedule</th>
                                                            <th>Deductions</th>
                                                            <th>Member Since</th>
                                                            <th width="10%" class="text-center"><span class="fa fa-list"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(!empty($employeee)){ foreach($employeee AS $e){ ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo $e['employee_number'];?></td>
                                                            <td>
                                                                <a href="#edit_photo" data-toggle="modal" id = "img" class="photo" data-id="<?php echo $e['employee_id']; ?>">
                                                                    <img style = "width:80px;border-radius:10px;box-shadow: 0px 0px 10px 5px #aeaeae;" src="<?php echo base_url() ?>uploads/<?php echo $e['photo']; ?>" alt="image" />
                                                                    <span class="fa fa-edit"></span>
                                                                </a>
                                                            </td>
                                                            <td><?php echo $e['firstname']." ".$e['lastname'];?></td>
                                                            <td><?php echo $e['position'];?></td>
                                                            <td><?php echo $e['schedule'];?></td>
                                                            <td><?php echo "<b>SSS:</b>".$e['sss_amount']."<br><b>Pag-Ibig: </b>".$e['pagibig_amount'].'<br><b>PhilHealth: </b>'.$e['philhealth_amount'];?></td>
                                                            <td><?php echo date('M d, Y', strtotime($e['created_on'])); ?></td>
                                                            <td>
                                                                <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="">
                                                                    <span data-target="#updateEmp" data-toggle="modal">
                                                                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Update Employee" id ="upEmp" data-id="<?php echo $e['employee_id']; ?>" data-name="<?php echo $e['firstname']; ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                    </span>
                                                                    <a href="<?php echo base_url(); ?>employees/delete_employee/<?php echo $e['employee_id']; ?>" onclick="confirmationDelete(this);return false;" class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delete" title="Delete" alt='Delete'>
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
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
