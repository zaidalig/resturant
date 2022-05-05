<?php 
    $ci =& get_instance();  
?>
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="mediumModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Cash Advance</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>employees/insert_cashad" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Date:</label>
                        <input id="" name="date" type="date" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Employee Name:</label>
                        <select class="form-control bor-radius5" name="employee_name">
                            <option value="">- Select Employee -</option>
                            <?php foreach($employees AS $e){ ?>
                            <option value="<?php echo $e->employee_id;?>"><?php echo $e->firstname." ".$e->lastname;?></option>
                            <?php } ?>
                        </select>
                        <label for="" class="control-label mb-1">Amount:</label>
                        <input id="" name="amount" type="text" class="form-control bor-radius5" placeholder="">
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
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="updateCh">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Cash Advance</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>employees/update_cashad" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Date:</label>
                        <input id="date" name="date" type="date" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Employee Name:</label>
                        <select class="form-control bor-radius5" id="employee_name" name="employee_name">
                            <option value="">- Select Employee -</option>
                            <?php foreach($employees AS $e){ ?>
                            <option value="<?php echo $e->employee_id;?>"><?php echo $e->firstname." ".$e->lastname;?></option>
                            <?php } ?>
                        </select>
                        <label for="" class="control-label mb-1">Amount:</label>
                        <input id="amount" name="amount" type="text" class="form-control bor-radius5" placeholder="">
                        <input id="cash_id" name="cash_id" type="hidden" class="form-control bor-radius5">
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
                                            
                                            <h5 class="m-b-10">Cash Advance List
                                                <span data-toggle="modal" data-target="#mediumModal">
                                                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-sm" data-toggle="tooltip" data-placement="left" title="Add Cash Advance">
                                                        <span class="fa fa-plus" ></span>
                                                    </a>
                                                </span>
                                            </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Cash Advance List</a></li>
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
                                                            <th>Date</th>
                                                            <th>Employee ID</th>
                                                            <th>Employee Name</th>
                                                            <th>Amount</th>
                                                            <th width="10%" class="text-center"><span class="fa fa-list"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($cashadvance AS $c){ ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo date("M d, Y",strtotime($c->date_advance)); ?></td>
                                                            <td><?php echo $ci->get_empnum($c->employee_id); ?></td>
                                                            <td><?php echo $ci->get_name($c->employee_id); ?></td>
                                                            <td><?php echo number_format($c->amount,2); ?></td>
                                                            <td>
                                                                <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="">
                                                                    <span data-target="#updateCh" data-toggle="modal">
                                                                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Update Overtime" id ="upCh" data-id="<?php echo $c->cash_id; ?>" data-date="<?php echo $c->date_advance; ?>" data-emp="<?php echo $c->employee_id; ?>" data-amount="<?php echo $c->amount; ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                    </span>
                                                                    <a href="<?php echo base_url(); ?>employees/delete_cashad/<?php echo $c->cash_id;?>" onclick="confirmationDelete(this);return false;" class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delete" title="Delete" alt='Delete'>
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
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
