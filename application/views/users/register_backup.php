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
		    min-height: 100%;
		}
		.trans {
		    background: transparent;
		    border: none;
		}
	</style>
	<body class="bgimg-1">
		<div class="login">
			<div class="login-bottom">
				<h2>Register</h2>
				<form method="POST" action="<?php echo base_url(); ?>users/insert_registration">
					<div class="col-md-6">
						<div class="login-mail">
							<input type="text" class="trans" name="fname" placeholder="Firstname" required="">
							<i class="fa fa-user"></i>
						</div>
						<div class="login-mail">
							<input type="text" class="trans" name="mname" placeholder="Middlename">
							<i class="fa fa-user"></i>
						</div>
						<div class="login-mail">
							<input type="text" class="trans" name="lname" placeholder="Lastname" required="">
							<i class="fa fa-user"></i>
						</div>
						<div class="login-mail">
							<input type="number" maxlength="13" class="trans" name="contact_no" placeholder="Contact Number" required="">
							<i class="fa fa-user"></i>
						</div>
						<div class="login-mail">
							<input type="email" class="trans" name="email" placeholder="Email" required="">
							<i class="fa fa-envelope"></i>
						</div>
						<div class="login-mail">
							<input type="password" class="trans" name="password"  id ="password" class="trans" placeholder="Password" required="">
							<i class="fa fa-lock"></i>
						</div>
						<div class="login-mail">
							<input type="password" class="trans" name="re_password" id ="re_password" onblur="checkpassword()"  placeholder="Repeated password" required="">
							<i class="fa fa-lock"></i>
						</div>
					</div>
					<div class="col-md-6 login-do">
						<label class="hvr-shutter-in-horizontal login-sub">
							<input type="submit" value="Submit" id='updatepw'>
							</label>
							<p>Already registered?</p>
						<a href="<?php echo base_url(); ?>users/index" class="hvr-shutter-in-horizontal">Login</a>
					</div>
				</form>
				<div class="clearfix"> </div>
				<div class='msg'></div>
			</div>
		</div>
		<script type="text/javascript">
		    function checkpassword(){
		        var re_password = $('#re_password').val();
		        var password = $('#password').val();

		        if(password!=re_password){
		             $('div.msg').text('Error: Password did not match.');
		             $('div.msg').addClass("success bor-radius10 shadow alert-danger alert-shake animated headShake");
		             $('div.msg').attr("style", "padding:20px;text-align:center");
		             $("#updatepw").attr("disabled", true);
		        } else {
		            $('div.msg').hide();
		            $("#updatepw").removeAttr("disabled");
		        }
		    }
		</script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/script.js"></script>
	</body>
</html>