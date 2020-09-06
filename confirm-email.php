<?php
	session_start();	
	require "includes/connect.php";
    require "includes/seller-session.php";
	$headtitle = "I-Soko - Confirm your email";
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
  <!-- Main content -->
    <section class="content">

		<div class="callout callout-danger" style="margin-top:30px">
		  <h5>Confirm Your Email Address.</h5>

		  <p>A confirmation email was sent to <?php if(isset ($_GET["email"])){ echo '<b>'.$_GET["email"].'</b>';}?> with the link to activate your shop.<br/>
			If you did not recieve the email, confirm the email address you entered is correct or try resending the email.
		  </p>
		  <div class="card-boy">
			<a class="btn btn-sm btn-outline-warning">Resend Email</a>
			<a class="btn btn-sm btn-outline-secondary">Change Email Address</a>
		  </div>
		</div>
			  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
</body>
</html>