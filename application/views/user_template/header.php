<?php
    if (isset($this->session->userdata['logged_in'])) {
    $email = ($this->session->userdata('email'));
    $password = ($this->session->userdata('password'));
    } else {
        echo "<script>alert('You are not logged in. Please login to continue.'); 
            window.location ='".base_url()."masterfile/login'; </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="">
    <title>CIANOS SGB</title>
    <link href="<?php echo base_url(); ?>assets/node_modules/morrisjs/morris.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/node_modules/c3-master/c3.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/pages/dashboard1.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/dist/css/jquery.dataTables.min.css" rel="stylesheet">      
    <link href='<?php echo base_url(); ?>assets/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?php echo base_url(); ?>assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <link href="<?php echo base_url(); ?>assets/css/theme.css" rel="stylesheet" media="all">
</head>
<style type="text/css">
    body{
        background-image: url(<?php echo base_url() ?>assets/img/seafood2.png)!important;
        background-repeat: no-repeat;
        background-size: cover;   
        background-position: center;
        background-attachment: fixed;
    }
    fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
        color:  #fff!important;
        font-weight: 800;
    }
    h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6{
        color:  #fff!important;
    }
    .page-titles .breadcrumb li a{
        color:  #fff!important;
    }
    .card{
        background: #ffffff40
    }
    .text-themecolor{
        color: #fff!important;
    }

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
    .thumbnail a>img,.thumbnail>img{
        display:block;
        max-width:309%!important;
        height:auto;
        margin-left: 259px;
        border-radius:10px;
        box-shadow: 0px 0px 10px 5px #aeaeae;
    }
    .img-rounded{
        border-radius:6px
    }
    .img-thumbnail{
        display:inline-block;
        max-width:309%!important;
        height:auto;
        padding:4px;
        line-height:1.42857143;
        background-color:#fff;
        border:1px solid #ddd;
        border-radius:4px;
        -webkit-transition:all .2s ease-in-out;
        -o-transition:all .2s ease-in-out;
        transition:all .2s ease-in-out;
    }
    .btn-dark {
        background-color: #585858b5;
        border-radius: 0px;
        border-radius: 20px;
        padding: 40px;
        font-size: 20px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin: 10px;
    }
    .widget-box {
        background: #fff0;
        border-top: 1px solid #CDCDCD;
        border-left: 1px solid #CDCDCD;
        border-right: 1px solid #CDCDCD;
        clear: both;
        margin-top: 16px;
        margin-bottom: 16px;
        position: relative;
    }

    .widget-title, .modal-header, .table th, div.dataTables_wrapper .ui-widget-header {
        background-color: #efefef;
        border-bottom: 1px solid #CDCDCD;
        height: 36px;
    }

    .widget-content {
        padding: 12px 15px;
        border-bottom: 1px solid #cdcdcd;
    }

    .tab-content {
        overflow: auto;
    }

    .widget-title .nav-tabs li a {
        border-bottom: medium none !important;
        border-left: 1px solid #DDDDDD;
        border-radius: 0 0 0 0;
        border-right: 1px solid #DDDDDD;
        border-top: medium none;
        color: #999999;
        margin: 0;
        outline: medium none;
        padding: 9px 10px 8px;
        font-weight: bold;
        text-shadow: 0 1px 0 #FFFFFF;
    }

    .widget-title .nav-tabs li.active a {
        background-color: #F9F9F9 !important;
        color: #444444;
    }

    .nav-tabs>.active>a, .nav-tabs>.active>a:hover, .nav-tabs>.active>a:focus {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd;
        border-bottom-color: transparent;
    }
    .nav-tabs>li>a {
        padding-top: 8px;
        padding-bottom: 8px;
        line-height: 20px;
        border: 1px solid transparent;
        -webkit-border-radius: 4px 4px 0 0;
        -moz-border-radius: 4px 4px 0 0;
        border-radius: 4px 4px 0 0;
    }
    .nav-tabs>li>a, .nav-pills>li>a {
        padding-right: 12px;
        padding-left: 12px;
        margin-right: 2px;
        line-height: 14px;
    }
    .nav>li>a {
        display: block;
    }
</style>
<body class="skin-default-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">Reservation System</p>
        </div>
    </div>