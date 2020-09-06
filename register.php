<?php
	session_start();	
	require "includes/connect.php";
	$headtitle = "I-Soko - Create an Account";
	$headdesc = "Create your i-Soko account today.";
	$headkeywords = "";
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
<div class="login-box shadow" style="margin:30px 0px;min-width:50%">
  <div class="login-logo">
    <a href="index.php"><img src="img/isoko4.JPG" style="max-width:100px"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg text-orange text-bold">Create a new Account</p>
      
      <form action="processes/register.php" method="post" class="text-left" id="regiForm">
	  <div class="row">
	  <div class="col-md-6">
        <div class="mb-3">
		  <label>First name </label>
          <input type="text" class="form-control" name="fname" placeholder="First name" required>
        </div>
	  </div>
	  <div class="col-md-6">
		<div class="mb-3">
		  <label>Last name </label>
          <input type="text" class="form-control"name="lname" placeholder="Last name" required>
        </div>
	  </div>		
	  </div>		
        <div class="mb-3">
		<label>Email </label>
          <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" required>
        </div>
		<div class="mb-3">
		  <label>Phone number</label>
          <input type="text" class="form-control" name="phone" placeholder="Phone Number" autocomplete="off" required data-inputmask='"mask": "+254 999 999 999"' data-mask>
        </div>
		<div class="mb-3">
		  <label>Password</label>
          <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off" required>
        </div>
		<div class="mb-3">
		  <label>Confirm Password</label>
          <input type="password" class="form-control" name="cpassword" placeholder="Retype password" required>
        </div>
        <div class="row">
          <div class="col-sm-8">
            <div class="icheck-orange mb-3">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
              <label for="agreeTerms">
               I agree to the <a href="#" class="text-orange">terms and conditions</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-sm-4">
            <button type="submit" name="sign_up" class="btn btn-default bg-orange btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
       <br/>
	  <hr>
      <p class="mb-0">
		Already have an account?<br/>
        <a href="login.php" class="text-orange text-bold">Login</a>
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
  $('#regiForm').validate({
    rules: {
      fname: {
        required: true,
        nowhitespace: true,
        lettersonly: true,
		maxlength: 30,
      },
	  lname: {
        required: true,
        nowhitespace: true,
        lettersonly: true,
		maxlength: 30,
      },
	  phone: {
        required: true,
      }, 
	  email: {
        required: true,
        email: true,
		maxlength: 50,
      },
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
      terms: {
        required: true
      },
    },
    messages: {
	   fname: {
        required: "Please enter a first name",
      },
	   lname: {
        required: "Please enter a last name",
      },
	   phone: {
        required: "Please enter a phone number",
      },
      email: {
        required: "Please enter an email address",
        email: "Please enter a vaild email address"
      },
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
      cpassword: {
        required: "Please provide a confirmation password",
        minlength: "Your password must be at least 6 characters long",
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
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
