<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="mediumModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Menu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>masterfile/insert_menu" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Menu Category Name:</label>
                        <select id="" name="menu_category" class="form-control bor-radius5" placeholder="">
                            <option value=""></option>
                            <?php foreach($menu_category AS $mc){ ?>
                            <option value="<?php echo $mc->menucat_id; ?>"><?php echo $mc->menu_category; ?></option>
                            <?php } ?>
                        </select>
                        <label for="" class="control-label mb-1">Menu Name:</label>
                        <input id="" name="menu_name" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Menu Price:</label>
                        <input id="" name="menu_price" type="text" onkeypress="return isNumberKey(this, event)" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Menu Description:</label>
                        <textarea name="menu_desc" id="" cols="30" class="form-control bor-radius5" rows="3" style="resize:none"></textarea>
                        <label for="" class="control-label mb-1">Menu Image:</label>
                        <input name="menu_img" type="file" class="form-control bor-radius5" placeholder="">
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
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="updateMenu">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Menu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>masterfile/update_menu" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Menu Category Name:</label>
                        <select id="menu_category" name="menu_category" class="form-control bor-radius5" placeholder="">
                            <option value=""></option>
                            <?php foreach($menu_category AS $mc){ ?>
                            <option value="<?php echo $mc->menucat_id; ?>"><?php echo $mc->menu_category; ?></option>
                            <?php } ?>
                        </select>
                        <label for="" class="control-label mb-1">Menu Name:</label>
                        <input id="menu_name" name="menu_name" type="text" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Menu Price:</label>
                        <input id="menu_price" name="menu_price" type="text" onkeypress="return isNumberKey(this, event)" class="form-control bor-radius5" placeholder="">
                        <label for="" class="control-label mb-1">Menu Description:</label>
                        <!-- <input id="menu_desc" name="menu_desc" type="text" class="form-control bor-radius5" placeholder=""> -->
                        <textarea name="menu_desc" id="menu_desc" cols="30" class="form-control bor-radius5" rows="3" style="resize:none"></textarea>
                        <input id="menu_id" name="menu_id" type="hidden" class="form-control bor-radius5">
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
<div class="modal fade modal-icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="edit_photo">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Photo</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method = "POST" action="<?php echo base_url();?>masterfile/update_menuimg" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="" class="control-label mb-1">Photo:</label>
                        <input id="image" name="image" type="file" class="form-control bor-radius5" placeholder="" required>
                        <input id="menu_idimg" name="menu_idimg" type="hidden" class="form-control bor-radius5">
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
                                            
                                            <h5 class="m-b-10">Menu List
                                                <span data-toggle="modal" data-target="#mediumModal">
                                                    <a href="javascript:void(0)" class="btn btn-primary pull-right btn-sm" data-toggle="tooltip" data-placement="left" title="Add New Menu">
                                                        <span class="fa fa-plus" ></span>
                                                    </a>
                                                </span>
                                            </h5>
                                            <!-- <p class="text-muted m-b-10">lorem ipsum dolor sit amet, consectetur adipisicing elit</p> -->
                                            <ul class="breadcrumb-title b-t-default p-t-10">
                                                <li class="breadcrumb-item">
                                                    <a href="<?php echo base_url(); ?>masterfile/dashboard"> <i class="fa fa-home"></i> </a>
                                                </li>
                                               <li class="breadcrumb-item"><a href="#!">Menu List</a></li>
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
                                                            <th>Menu Category</th>
                                                            <th>Menu Name</th>
                                                            <th>Menu Price</th>
                                                            <th>Menu Description</th>
                                                            <th>Menu Image</th>
                                                            <th width="10%" class="text-center"><span class="fa fa-list"></span></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($menu AS $m){ ?>
                                                        <tr class="icon-btn">
                                                            <td><?php echo $m['menu_category'];?></td>
                                                            <td><?php echo $m['menu_name'];?></td>
                                                            <td><?php echo $m['menu_price'];?></td>
                                                            <td><?php echo $m['menu_desc'];?></td>
                                                            <td>
                                                                <a href="#edit_photo" data-toggle="modal" id = "menuimg" class="photo" data-id="<?php echo $m['menu_id']; ?>">
                                                                    <img style = "width:80px;border-radius:10px;box-shadow: 0px 0px 10px 5px #aeaeae;" src="<?php echo is_file("uploads/{$m['menu_img']}") ? base_url("uploads/{$m['menu_img']}") : base_url("uploads/default/no-image-available.png") ?>" alt="image" />
                                                                    <span class="fa fa-edit"></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group " role="group" data-toggle="tooltip" data-placement="top" title="">
                                                                    <span data-target="#updateMenu" data-toggle="modal">
                                                                        <button type="button" class="btn btn-primary btn-mini waves-effect waves-light" title="Update Menu" id ="upMenu" data-target="#updateMenu" data-toggle="modal" data-id="<?php echo $m['menu_id']; ?>" data-name="<?php echo $m['menu_name']; ?>" data-price="<?php echo $m['menu_price']; ?>" data-desc="<?php echo $m['menu_desc']; ?>" data-img="<?php echo $m['menu_img']; ?>" data-menucat="<?php echo $m['menucat_id']; ?>">
                                                                            <i class="fa fa-pencil"></i>
                                                                        </button>
                                                                    </span>
                                                                    <a href="<?php echo base_url(); ?>masterfile/delete_menu/<?php echo $m['menu_id'];?>" onclick="confirmationDelete(this);return false;" class="btn btn-danger btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="Delete" title="Delete" alt='Delete'>
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
