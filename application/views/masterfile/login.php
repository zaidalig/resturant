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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets_user/css/style.css">
</head>
<style type="text/css">
    .image {
      margin: 0;
      padding: 0;
      background: #f6f6f6;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      height: 100vh;
      margin: auto;
      display: flex;
      background-image: url(<?php echo base_url() ?>assets/img/seafood2.png) !important;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }
    .auth-box {
        background-color: #fff2;
        border-radius: 8px;
        margin: 0px 0 0 0;
        padding: 20px;
        -webkit-box-shadow: 0 2px 18px -2px black;
        box-shadow: 0 2px 18px -2px black;
    }

    .input::placeholder{
        color:#fff;
    }
</style>
<body class="fix-menu">
        <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg image">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto" style="background-image: url(<?php echo base_url() ?>assets/img/cianos_background.jpg);margin: auto;overflow-x: hidden;background-repeat: no-repeat;background-size: cover;background-position: center;">
                        <form class="md-float-material" method="POST" action="<?php echo base_url(); ?>masterfile/login">
                            <div class="text-center">
                                <!-- <img src="<?php echo base_url(); ?>assets_user/images/logo.png" alt="logo.png"> -->
                                <!-- <h2 style = "color:#000;font-family: sans-serif;">Admin Login</h2> -->
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h2 class="txt-primary" style="color:#000;font-family: sans-serif;">Admin Login</h2>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="text" name="username" class="form-control input" placeholder="Your Username" style="border-color:#0000003d;background: #0000003d;color: white">
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control input" placeholder="Password" style="border-color:#0000003d;background: #0000003d;color: white">
                                    <span class="md-line"></span>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <!-- <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" value="">
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div> -->
                                    </div>
                                    <!-- <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="#" id = "flip" class="text-right f-w-600 text-inverse"> Forgot Your Password?</a>
                                    </div> -->
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <!-- <button type="button" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button> -->
                                        <input type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20" value="Sign in">
                                    </div>
                                </div>
                                <!-- <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
                                        <p class="text-inverse text-left"><b>Your Authentication Team</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="<?php echo base_url(); ?>assets_user/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                    </div>
                                </div> -->

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" style = "display:none" action="reset.php" method="post">
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3>Enter your e-mail to reset it.</h3>
                                        <!-- <h3 class="text-left txt-primary">Sign In</h3> -->
                                    </div>
                                </div>
                                <input type="email" id="inputEmail" name = "email" class="form-control a" placeholder="Email Address" required>

                                 <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="button" id = "back" class="btn btn-default btn-md text-center m-b-20">Back</button>
                                        <input type="submit" class="btn btn-primary btn-md waves-effect text-center m-b-20" value="Reset">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/modernizr/css-scrollbars.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets_user/js/common-pages.js"></script>
    <script>
        $(document).ready(function(){
            $("#flip").click(function(){
                $("form").animate({
                    height: 'toggle'
                });
                var label = $("label");  
                label.animate({left: '100px'}, "slow");
                label.animate({fontSize: '43px'}, "slow");
            });
            $("#back").click(function(){
                $("form").animate({
                    height: 'toggle'
                });
                var label = $("label");  
                label.animate({left: '100px'}, "slow");
                label.animate({fontSize: '14px'}, "slow");
            });
        });
    </script>
</body>

</html>
