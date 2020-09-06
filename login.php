<?php
	session_start();	
	require "includes/connect.php";
	$headtitle = "I-Soko - Login to I-Soko";
	$headdesc = "Login and start shopping";
	$headkeywords = "I-Soko, i-soko login, login, sign up";
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
<?php 
	if(isset($_SESSION["follerror"])){
		$_SESSION["error"] = $_SESSION["follerror"];
		unset($_SESSION["follerror"]);
	}
?>
	<script>
		if (sessionStorage.follerror) {
		  toastr.error("You need to be logged in")
		  sessionStorage.removeItem("follerror");
		}
	</script>
   <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->
 </div> 
 <div class="bg-white" align="center">
<div class="login-box shadow" style="margin:30px 0px;">
  <div class="login-logo">
    <a href="index.php"><img src="img/isoko4.JPG" style="max-width:100px"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-orange text-bold">Login</p>
	  
      <form action="processes/verify.php" method="POST" id="logiForm">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<?php 
			  if(isset($_GET["return"])){
				 $return = htmlspecialchars($_GET["return"]);
	
			  ?>
              <input type="hidden" name="return" value="<?php echo $return;?>" class="form-control" required>
			  <?php 
			  }
			  ?>
        <div class="row">
          <div class="col-sm-8 text-left">
            <div class="icheck-orange">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" name="login" class="btn btn-default bg-orange btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
       <br/>
      <p class="mb-1 text-left">
        <a href="forgot-password.php" class="text-orange">Forgot password?</a>
      </p>
	  <hr>
      <p class="mb-0">
		New to I-Soko?<br/>
        <a href="register.php" class="text-orange text-bold">Create a new Account</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
<div class="wrapper">
 <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
<script>
$(document).ready(function(){
$.validator.addMethod( "nowhitespace", function( value, element ) {
	return this.optional( element ) || /^\S+$/i.test( value );
}, "Name can only consist of letters" );
$.validator.addMethod( "lettersonly", function( value, element ) {
	return this.optional( element ) || /^[a-z]+$/i.test( value );
}, "Name can only consist of letters" );
$.validator.addMethod( "integer", function( value, element ) {
	return this.optional( element ) || /^-?\d+$/.test( value );
}, "A positive or negative non-decimal number please" );

  })
</script>
<script>
$(function () {
  $('#logiForm').validate({
    rules: {
	  email: {
        required: true,
        email: true,
		maxlength: 50,
      },
      password: {
        required: true,
		maxlength: 30,
      },
    },
    messages: {
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address",
      },
      password: {
        required: "Please provide a password",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback text-left');
      element.closest('.mb-3').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
