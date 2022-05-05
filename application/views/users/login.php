<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Minimal Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<style type="text/css">
    body,#main-wrapper{
        background-image: url(<?php echo base_url() ?>assets/img/seafood2.png);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }
    @import url('https://fonts.googleapis.com/css?family=Playfair+Display:400,900|Poppins:400,500');
    * {
      margin: 0;
      padding: 0;
      text-decoration: none;
      box-sizing: border-box;
    }
    body {
      margin: 0;
      padding: 0;
      background: #f6f6f6;
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      height: 100vh;
      margin: auto;
      display: flex;
      background-image: url(<?php echo base_url() ?>/assets/img/seafood2.png);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
    }

    img {
        max-width: 100%;
    }

    .app {
      background-color: #fff;
      width: 330px;
      height: 540px;
      margin: 2em auto;
      border-radius: 5px;
      padding: 1em;
      position: relative;
      overflow: hidden;
      box-shadow: 0 6px 31px -2px rgba(0, 0, 0, .3);
    }

    a {
        text-decoration: none;
        color: #257aa6;
    }

    p {
        font-size: 13px;
        color: #333;
        line-height: 2;
    }
        .light {
            text-align: right;
            color: #fff;
        }
            .light a {
                color: #fff;
            }

    .bg {
        width: 400px;
        height: 550px;
        background: #257aa6;
        position: absolute;
        top: -5em;
        left: 0;
        right: 0;
        margin: auto;
        background-image: url(<?php echo base_url() ?>assets/img/cianos_img.jpg);
        background-position: left;
        background-size: 85%;
        background-repeat: no-repeat;
        clip-path: ellipse(69% 46% at 48% 46%);
    }

    form {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        text-align: center;
        padding: 2em;
    }

    header {
        width: 220px;
        height: 220px;
        margin: 1em auto;
      }

    form input {
        width: 100%;
        padding: 13px 15px;
        margin: 0.7em auto;
        border-radius: 100px;
        border: none;
        box-shadow: 1px 1px 5px 2px #fff9;
        background: rgb(0 0 0 / 53%);
        font-family: 'Poppins', sans-serif;
        outline: none;
        color: #fff;
    }
    input::placeholder {
        color: #fff;
        font-size: 13px;
    }

    .inputs {
        margin-top: -4em;
    }

    footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 2em;
        text-align: center;
    }

    button {
        width: 100%;
        padding: 13px 15px;
        border-radius: 100px;
        border: none;
        background: #dc5a2c;
        font-family: 'Poppins', sans-serif;
        outline: none;
        color: #fff;
    }
    
    @media screen and (max-width: 640px) {
            .app {
                width: 100%;
                height: 100vh;
                border-radius: 0;
            }

            .bg {
                top: -7em;
                width: 450px;
                height: 95vh;
            }
            header {
                width: 90%;
                height: 250px;
            }
            .inputs {
                margin: 0;
            }
            input, button {
                padding: 18px 15px;
            }
        }
</style>
<div class="app">
    <div class="bg"></div>
    <form  method="POST" action="<?php echo base_url(); ?>users/login">
        <header></header>
        <div class="inputs">
            <?php
                $error_msg= $this->session->flashdata('error_msg');  
                if($error_msg){
            ?>
            <div style="padding:10px;background:#ff4f4fd6;text-align:center;border-radius: 10px">
                <center><?php echo $error_msg; ?></center>                    
            </div>
            <?php } ?>
            <input type="email" name="email" placeholder="Email Address" required="" >
            <input type="password" name="password" placeholder="Password" required="" >
            <p class="light" id = "flip" style="cursor:pointer;cursor: pointer;color: #020202;background: #fff9;font-weight: 550;text-align: center">Forgot password?</p>
        </div>
        <br>
        <br>
        <input type="submit" value="Login" style="background: #dc5a2c;">
         <p>Don't have an account? <a href="<?php echo base_url(); ?>users/register">Register</a></p>
    </form>
    <form style = "display:none" action="<?php echo base_url(); ?>users/reset" method="post">
        <header></header>
        <div class="row">
            <div class="col-md-12">
                <h3 style="background: #fff9;font-weight: 550">Enter your e-mail to reset it.</h3>
            </div>
        </div>
        <div class="login-mail">
            <input type="email" placeholder="Email Address" class="trans" name="email" required="">
            <i class="fa fa-user"></i>
        </div>
         <div class="row">
             <div class="col-md-6">
                    <input type="submit" class="btn btn-danger btn-md waves-effect btn-block" value="Reset">
            </div>
            <div class="col-md-6">
                    <button type="button" id = "back" class="btn btn-default btn-block btn-md">Back</button>
            </div>
        </div>
    </form>
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