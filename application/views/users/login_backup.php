<html>
	<head>
		<title>CIANOS SGB</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<link href="<?php echo base_url(); ?>assets/css/loginbootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel='stylesheet' type='text/css' />
		<link href="<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.css" rel="stylesheet"> 
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
		<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"> </script>
	</head>
	<style type="text/css">
		.bgimg-1, .bgimg-2, .bgimg-3 {
		    position: relative;
		    background-attachment: fixed;
		    background-position: center;
		    background-repeat: no-repeat;
		   /* background-size: cover;*/
		}
		.bgimg-1 {
		    background-image: url(../assets/img/cianos_img.jpg);
		    /*min-height: 100%;*/
		    max-width: 100%
		    height: auto;
		}
		.trans {
		    background: transparent;
		    border: none;
		}
	</style>
	<body class="bgimg-1">
		<div class="login">
			<!-- <h1><a href="<?php echo base_url(); ?>masterfile/index">Reservation System </a></h1> -->
			<div class="login-bottom" style="margin-top:100px;">
				<h2>Login</h2>
				<form method="POST" action="<?php echo base_url(); ?>users/login">
				<div class="col-md-6">
					<div class="login-mail">
						<input type="text" placeholder="Email Address" class="trans" name="email" required="">
						<i class="fa fa-user"></i>
					</div>
					<div class="login-mail">
						<input type="password" placeholder="Password" class="trans" name="password" required="">
						<i class="fa fa-lock"></i>
					</div>

				
				</div>
				<div class="col-md-6 login-do">
					<label class="hvr-shutter-in-horizontal login-sub">
						<input type="submit" value="Login">
						</label>
						<p id = "flip" style="cursor:pointer;color:#e03f3f"> Forgot Your Password?</p>
						<p>Do not have an account?</p>
					<a href="<?php echo base_url(); ?>users/register" class="hvr-shutter-in-horizontal">Signup</a>
				</div>
				
				<div class="clearfix"> </div>
				</form>
				<br>
	            <?php
                    $error_msg= $this->session->flashdata('error_msg');  
	                if($error_msg){
	            ?>
	                <div class="alert bor-radius10 alert-danger alert-shake animated headShake">
	                    <center><?php echo $error_msg; ?></center>                    
	                </div>
	            <?php } ?>
	            <form style = "display:none" action="reset.php" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Enter your e-mail to reset it.</h3>
                        </div>
                    </div>
                    <div class="login-mail">
						<input type="email" placeholder="Email Address" class="trans" name="email" required="">
						<i class="fa fa-user"></i>
					</div>
                     <div class="row">
                        <div class="col-md-6">
	                            <button type="button" id = "back" class="btn btn-default btn-block btn-md">Back</button>
                        </div>
                        <div class="col-md-6">
	                            <input type="submit" class="btn btn-danger btn-md waves-effect btn-block" value="Reset">
                        </div>
                    </div>
	            </form>
			</div>
		</div>
		<script>
	        $(document).ready(function(){
	            $("#flip").click(function(){
	                $("form").animate({
	                    height: 'toggle'
	                });
	                var label = $("label");  
	                //label.animate({left: '100px'}, "slow");
	                //label.animate({fontSize: '43px'}, "slow");
	            });
	            $("#back").click(function(){
	                $("form").animate({
	                    height: 'toggle'
	                });
	                var label = $("label");  
	                //label.animate({left: '100px'}, "slow");
	                //label.animate({fontSize: '14px'}, "slow");
	            });
	        });
	    </script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
	</body>
</html>