<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="mediumModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Position</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>masterfile/insert_position" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Position Name:</label>
                        <input id="" name="position_name" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Rate per Hour:</label>
                        <input id="" name="rate" type="text" class="form-control bor-radius5" placeholder="">
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
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="updatePosition">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Position</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>masterfile/update_position" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Position Name:</label>
                        <input id="position_name" name="position_name" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Rate per Hour:</label>
                        <input id="rate" name="rate" type="text" class="form-control bor-radius5" placeholder="">
                        <input id="position_id" name="position_id" type="hidden" class="form-control bor-radius5">
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
                                            
                                            <h5 class="m-b-10">Position List
                                                <span data-toggle="modal" data-target="#mediumModal">
                                                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-sm" data-toggle="tooltip" data-placement="left" title="Add New Position">
                                                        <span class="fa fa-plus" ></span>
                                                    </a>
                                                </span>
                                            </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Position List</a></li>
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
                                                            <th>Position Name</th>
                                                            <th>Rate Per Hour</th>
                                                            <th width="10%" class="text-center"><span class="fa fa-list"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php foreach($position AS $p){ ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo $p->position_name; ?></td>
                                                            <td><?php echo number_format($p->rate,2); ?></td>
                                                            <td>
                                                                <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="">
                                                                    <span data-target="#updatePosition" data-toggle="modal">
                                                                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="left" title="Update Position" id ="upPosition" data-id="<?php echo $p->position_id; ?>" data-name="<?php echo $p->position_name; ?>" data-rate="<?php echo $p->rate; ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                    </span>
                                                                    <a href="<?php echo base_url(); ?>masterfile/delete_position/<?php echo $p->position_id;?>" onclick="confirmationDelete(this);return false;" class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delete" title="Delete" alt='Delete'>
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
