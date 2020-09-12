<?php
	session_start();	
	require "includes/connect.php";
	$headtitle = "I-Soko - Retrieve Your Password";
	$headdesc = "";
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
<?php if(!isset($_GET["sentr"])){?>
 <div class="bg-white" align="center">
<div class="login-box shadow" style="margin:30px 0px;">
  <div class="login-logo">
    <a href="index.php"><img src="img/isoko4.jpg" style="max-width:100px"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Enter your Email to retrieve your password.</p>

      <form action="processes/password-retrieve.php" method="post" id="forgoForm">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required maxlength="50">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="retrieve" class="btn btn-default bg-orange btn-block">Retrieve Password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Create a new account</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
</div>
<?php }else{
?>
<div class="wrapper">
	 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
  <!-- Main content -->
    <section class="content">

		<div class="callout callout-danger" style="margin-top:30px">
		  <h5>Password Recovery Email Sent.</h5>

		  <p>An email was sent with the link to retrieve your password.<br/>
			If you did not recieve the email, confirm the email address you entered is correct or try resending the email.
		  </p>
		  <div class="card-boy">
			<a class="btn btn-sm btn-outline-warning" href="forgot-password.php">Resend Email</a>
			<a class="btn btn-sm btn-outline-secondary" href="forgot-password.php">Change Email Address</a>
		  </div>
		</div>
			  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<?php } ?>
<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
</body>
</html>
