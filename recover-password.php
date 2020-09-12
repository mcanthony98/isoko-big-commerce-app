<?php
	session_start();	
	require "includes/connect.php";
	$headtitle = "I-Soko - Retrieve Your Password";
	$headdesc = "";
	$headkeywords = "";
	
	if(!isset($_GET["rscde"])){
		echo '<script>location.replace("index.php");</script>';	
	}
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

 <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->
 </div> 
 <div class="bg-white" align="center">
<div class="login-box shadow" style="margin:30px 0px;">
  <div class="login-logo">
    <a href="index.php"><img src="img/isoko4.jpg" style="max-width:100px"></a>
  </div>
  <!-- /.login-logo -->
   <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Enter a new password that you will use to login</p>

      <form action="processes/password-retrieve.php" method="post" id="retForm">
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" autocomplete="off" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
		<input type="hidden" name="rscode" value="<?php echo $_GET["rscde"];?>" required>
		<input type="hidden" name="uid" value="<?php echo $_GET["urs"];?>" required>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="chngpssrd" class="btn btn-default bg-orange btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1 text-left">
        <a href="login.php" class="text-orange">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
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
  $('#retForm').validate({
    rules: {
	   password: {
        required: true,
        minlength: 6,
		maxlength: 30,
      },
	  cpassword: {
        required: true,
        minlength: 6,
		maxlength: 30,
      },
    },
    messages: {
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
      cpassword: {
        required: "Please provide a confirmation password",
        minlength: "Your password must be at least 6 characters long",
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
