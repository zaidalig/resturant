<?php 
    $CI =& get_instance();
    $user_id = $_SESSION['user_id'];  
?>
<style type="text/css">
    .modaling{
        padding-right: 450px!important; 
    }
    body{
        background-image: url(../../assets/img/seafood2.png)!important;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
</style>
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h4 class="text-themecolor">Dashboard</h4>
            </div>
            <div class="col-md-7 align-self-center text-right">
                <div class="d-flex justify-content-end align-items-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url("users/dashboard/") ?>">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card oh">
                    <div class="card-body">
                        <div class="d-flex m-b-30 align-items-center no-block">
                            <h5 class="card-title "><b>RESERVATIONS</b></h5>
                        </div>
                        <center>
                            <a href="<?php echo base_url(); ?>users/hut_reserve" class="btn btn-dark btn-md" id="huts" >
                                <center>
                                    <span class="fa fa-home" aria-hidden="true" style="font-size:200px"></span><br>
                                    Reservation
                                </center>
                            </a>
                            <a data-toggle="modal" data-target="#delivery" class="btn btn-dark btn-md" id="foods">
                                <center>
                                    <span class="fa fa-cutlery" aria-hidden="true" style="font-size:200px"></span><br>
                                    Delivery
                                </center>
                            </a>
                            <!-- <a href="<?php echo base_url(); ?>users/order_delivery" class="btn btn-dark btn-md" id="foods" >
                                <center>
                                    <span class="fa fa-cutlery" aria-hidden="true" style="font-size:200px"></span><br>
                                    Delivery
                                </center>
                            </a> -->
                            <!-- <a href="<?php echo base_url(); ?>users/index" class="btn btn-dark btn-md" id="table">
                                <center>
                                    <span class="fa fa-coffee" aria-hidden="true" style="font-size:200px"></span><br>
                                    Tables
                                </center>
                            </a> -->
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>