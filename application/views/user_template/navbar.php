
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<body class="skin-default-dark fixed-layout">
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Ciano's SGB</p>
        </div>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url(); ?>users/hut_reserve">
                        <span>
                            <h3 style="font-family:Monotype Corsiva;">CIANOS SGB</h3>
                     	</span> 
                 	</a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto">                        
                        <li class="nav-item">
                            <a class="nav-link text-muted waves-effect waves-dark" data-toggle="modal" data-target="#navModal" title="Dashboard"><i class="fa fa-bars "></i></a>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <!-- <li class="nav-item hidden-sm-up"> <a class="nav-link nav-toggler waves-effect waves-light" href="javascript:void(0)"><i class="ti-menu"></i></a></li> -->
                        <li class="nav-item dropdown" style="border-left:1px solid rgba(0, 0, 0, 0.1)"></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-cog"></span></a>
                            <div class="dropdown-menu shadow ">
                              <a class="dropdown-item" href="<?php echo base_url(); ?>users/user_logout" style="color:#000!important">Logout</a>
                            </div>
                        </li>
                    </ul>

                </div>
            </nav>
        </header>
        <div class="modal fade" id="navModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-mlg" role="document">
                <div class="modal-content modal-nobak m-t-150">                                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-3 col-lg-3"></div>
                            <div class="col-sm-4 col-lg-4">
                                <a href="<?php echo base_url(); ?>users/hut_reserve" class="btn btn-dark btn-md" id="huts" >
                                    <center>
                                        <span class="fa fa-home" aria-hidden="true" style="font-size:200px"></span><br>
                                        Reservation
                                    </center>
                                </a>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                                <a data-toggle="modal" data-target="#delivery" class="btn btn-dark btn-md" id="foods" >
                                    <center>
                                        <span class="fa fa-cutlery" aria-hidden="true" style="font-size:200px"></span><br>
                                        Delivery
                                    </center>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="delivery" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel" style="color:#000!important">Add New Delivery</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action = "<?php echo base_url(); ?>users/add_delivery">
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Address:</label>
                                    <textarea name="address" rows = "5" class="form-control bor-radius5" placeholder="Barangay, Street, Block" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label mb-1">Remarks:</label>
                                    <textarea name="remarks" rows = "5" class="form-control bor-radius5" placeholder="Additional Informations..." required></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-info btn-block" value ="Proceed">
                                </div>
                            <input type="hidden" name="baseurl" id="baseurl" value ="<?php echo base_url(); ?>">
                            <input name="user_id" id = "user_id" type="hidden" value="<?php echo $_SESSION['user_id'];?>">
                        </form>
                    </div>                                        
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/dist/js/navbar.js"></script>