<?php
    if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata('username'));
    $password = ($this->session->userdata('password'));
    } else {
        echo "<script>alert('You are not logged in. Please login to continue.'); 
            window.location ='".base_url()."masterfile/index'; </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>CIANOS SGB </title>
    <!-- HTML5 Shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4. The starter version of Gradient Able is completely free for personal project." />
    <meta name="keywords" content="free dashboard template, free admin, free bootstrap template, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes">
    <!-- Favicon icon -->
    <link rel="icon" href="" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/icon/themify-icons/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/icon/font-awesome/css/font-awesome.min.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/css/jquery.mCustomScrollbar.css">
    <link href="<?php echo base_url(); ?>assets/dist/css/jquery.dataTables.min.css" rel="stylesheet">      
    <link href='<?php echo base_url(); ?>assets/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo base_url(); ?>assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    
</head>
<style type="text/css">
    .fc{
        text-align:center!important;
    }
    .fc-title{
        color:white!important;
        font-size:x-large;
        font-weight: 900;
    }
    .fc-unthemed td.fc-today {
        background: #f5e282a6!important;
    }
    
    /* chart style*/
    #legend ul {
        list-style: none;
    }

    #legend ul li {
        display: inline;
        padding-left: 30px;
        position: relative;
        margin-bottom: 4px;
        border-radius: 5px;
        padding: 2px 8px 2px 28px;
        font-size: 14px;
        cursor: default;
        -webkit-transition: background-color 200ms ease-in-out;
        -moz-transition: background-color 200ms ease-in-out;
        -o-transition: background-color 200ms ease-in-out;
        transition: background-color 200ms ease-in-out;
    }

    #legend li span {
        display: block;
        position: absolute;
        left: 0;
        top: 0;
        width: 20px;
        height: 100%;
        border-radius: 5px;
    }
</style>
<body>
    <!-- <div class="fixed-button">
        <a href="https://codedthemes.com/item/gradient-able-admin-template" target="_blank" class="btn btn-md btn-primary">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> Upgrade To Pro
        </a>
      </div> -->
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">