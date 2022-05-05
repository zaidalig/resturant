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
                                            
                                            <h5 class="m-b-10">Delivery List
                                                <!-- <span data-toggle="modal" data-target="#mediumModal">
                                                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-sm" data-toggle="tooltip" data-placement="left" title="Add New Huts">
                                                        <span class="fa fa-plus" ></span>
                                                    </a>
                                                </span> -->
                                            </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Delivery List</a></li>
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
                                                <table class="table" id="delivery_tab">
                                                    <thead>
                                                        <tr>
                                                            <th>Dlivery Date</th>
                                                            <th>Fullname</th>
                                                            <th>Contact No.</th>
                                                            <th>Address</th>
                                                            <th>Remarks</th>
                                                            <th>Orders</th>
                                                            <th>Total Price</th>
                                                            <th width="10%" class="text-center"><span class="fa fa-list"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(!empty($delivery)){ foreach($delivery AS $h){ ?>
                                                        <tr class="icon-btn" <?php echo ($h['delivered']!=0) ? 'style="background-color: #c1c0c0ad;"' : ''; ?>>
                                                            <td align="center"><?php echo $h['delivery_date']; ?></td>
                                                            <td align="center"><?php echo $h['fullname']; ?></td>
                                                            <td align="center"><?php echo $h['contact_no']; ?></td>
                                                            <td><?php echo $h['address']; ?></td>
                                                            <td><?php echo $h['remarks']; ?></td>
                                                            <td><?php echo $h['menu']; ?></td>
                                                            <td align="center"><?php echo $h['price']; ?></td>
                                                            <td align="center">
                                                                <a href="<?php echo base_url(); ?>masterfile/delivery_done/<?php echo $h['delivery_id']; ?>" class="btn btn-success btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delivered" <?php echo ($h['delivered']!=0) ? 'style="pointer-events: none;background-color:#2ed8b675;border-color:#2ed8b642"' : ''; ?> onclick="return confirm('Do you really want to tag as Delivered this order?');">
                                                                    <span class="fa fa-truck"></span>
                                                                </a>
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
