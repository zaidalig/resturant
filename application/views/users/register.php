<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<style type="text/css">
    body {
      font-family: 'Poppins', sans-serif;
      margin: 0;
      height: 100vh;
      width: 100%;
      background-image:url(../assets/img/seafood2.png);
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-panel {
        width: 50%;
        height: 500px;
        background-color: #fff;
        border-radius: 20px;
    }

    .login-panel div {
        width: 50%;
        height: 100%;
        float: left;
    }

    .left-side {
        background-image:url(../assets/img/cianos_img.jpg);
        );
        background-size: cover;
        border-radius: 20px 0px 0px 20px;
    }

    .right-side {
        padding: 50px 25px;
        box-sizing: border-box;
    }

    .right-side h1 {
        text-transform: uppercase;
        margin: 0;
    }

    .right-side p {
        font-size: 10px;
        color: #888;
        margin-top: 0;
        margin-bottom: 20px;
        text-transform: lowercase;
    }

    .right-side input {
        margin: 6px 0;
        padding: 2.5px 0;
        width: 100%;
        border: 0;
        border-bottom: 2px solid #888;
    }

    input.submit-btn {
        border:0;
        border-radius: 15px;
        width: 100%;
        font-size: 14px;
        font-weight: 600;
        padding: 5px;
        color:white;
    }
    input.submit-btn:hover {
      border: 0;
      color: #fff;
      cursor: pointer;
    }

    .submit-btn1 {
        border:0;
        border-radius: 15px;
        width: 100%;
        font-size: 14px;
        font-weight: 600;
        padding: 5px;
        color:white;
    }
    .submit-btn1:hover {
      border: 0;
      color: #fff;
      cursor: pointer;
    }

    @media only screen and (max-width: 1100px) {
      .login-panel {
        width: 70%;
        height: 400px;
        background-color: #fff;
      }
    }
    @media only screen and (max-width: 800px) {
      .login-panel {
        width: 70%;
        height: 500px;
        background-color: #fff;
      }
      .login-panel div:first-of-type {
        width: 100%;
        height: 100px;
      }
      .login-panel div {
        width: 100%;
        height: 400px;
      }
    }

    *:focus {
        outline: none;
    }

    a {
        text-decoration: none;
        color: #257aa6;
    }
</style>
<section class="login-panel">
    <form method="POST" action="<?php echo base_url(); ?>users/insert_registration">
        <div class="left-side" style="text-align:center">
          <div class='msg'></div>
        </div>
        <div class="right-side">
            <h1 style="font-family: sans-serif, arial;">Sign Up</h1>
            <input type="text" class="trans" name="fname" placeholder="Firstname" required="">
            <input type="text" class="trans" name="mname" placeholder="Middlename">
            <input type="text" class="trans" name="lname" placeholder="Lastname" required="">
            <input type="number" maxlength="13" class="trans" name="contact_no" placeholder="Contact Number" required="">
            <input type="email" class="trans" name="email" placeholder="Email" required="">
            <input type="password" class="trans" name="password"  id ="password" class="trans" placeholder="Password" required="">
            <input type="password" class="trans" name="re_password" id ="re_password" onblur="checkpassword()"  placeholder="Repeated password" required="">
            <br>
            <br>
            <input type="submit" value="Register" class="submit-btn" style="background: #dc5a2c;">
            <center><a href="<?php echo base_url(); ?>users/index" style="border:0;border-radius: 15px;width: 100%;font-size: 14px;font-weight: 600;padding: 5px;">Login</a></center>
        </div>
    </form>
</section>

<script type="text/javascript">
    function checkpassword(){
        var re_password = $('#re_password').val();
        var password = $('#password').val();

        if(password!=re_password){
             $('div.msg').text('Error: Password did not match.');
             $('div.msg').addClass("success bor-radius10 shadow alert-danger alert-shake animated headShake");
             $('div.msg').attr("style", "padding-top:10px;width:100%;margin-top:400px;height:30px;background:#ff4f4fd6;text-align:center");
             $("#updatepw").attr("disabled", true);
        } else {
            $('div.msg').hide();
            $("#updatepw").removeAttr("disabled");
        }
    }
</script>