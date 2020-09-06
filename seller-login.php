<?php
	session_start();	
	require "includes/connect.php";
    require "includes/seller-session.php";
	$headtitle = "I-Soko - Login to Your Shop";
	$headdesc = "Login to I-Soko Shop Admin Panel";
	$headkeywords = "";
	
?>
<?php include "includes/header.php";?>
  <?php
	if(isset ($_GET["cnfrm"])){
		$sid = mysqli_real_escape_string($pdo, $_GET["cnfrm"]);
		$qry = "UPDATE shop SET status = 1 WHERE shop_id = '$sid'";
		if($pdo->query($qry) === TRUE){
			$_SESSION["success"] = "Email confirmed Successfully. Enter your I-Soko Password to manage your shop.";
		}else{
			$_SESSION["error"] = "An error occured. Please reply to the confirmation email for help.";
		}
	}
  ?>
  <?php 
	require "includes/sessions.php";
	require "includes/seller-session.php";
	
	if(!isset($_SESSION["sokoshop"])){
		echo '<script>location.replace("index.php");</script>';	
	}
	$shop = $_SESSION["sokoshop"];
	$res = $pdo->query("SELECT * FROM shop WHERE shop_id='$shop'");
	if($res->num_rows == 0){
		echo '<script>location.replace("index.php");</script>';	
	}
	$row=$res->fetch_assoc();
	
  ?>
  
<body class="hold-transition lockscreen">
  <?php include "includes/messages.php";?>
  
<!-- Automatic element centering -->
<div class="lockscreen-wrapper shadow-sm bg-white" style="padding:20px 0px">
  <div class="lockscreen-logo">
    <a href="index.php"><img src="img/isoko4.JPG" style="max-width:200px"></a>
  </div><!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your <a class="text-orange" href="index.php">I-Soko</a> password to enter Admin Panel<br/>
	<small>Password you use to login to I-Soko</small>
  </div><br/>
  <!-- User name -->
  <div class="lockscreen-name text-capitalize ml-5"><?php echo $row["name"];?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
	<?php $logo = (!empty($row["logo"])) ? 'logos/'.$row['logo'] : 'img/default1.jpg';?>
      <img src="<?php echo $logo;?>" alt="<?php echo $row["name"];?>">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" action="processes/seller-login.php" id="pForm" method="POST">
      <div class="input-group border rounded ">
        <input type="password" class="form-control bg-light" placeholder="password" name="password" autofocus>

        <div class="input-group-append">
          <button type="submit" name="seller-login" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="text-center">
    <a href="login.php" class="text-orange">Sign in as a different user</a><br/>
    <a href="forgot-password.php" class="mt-2" >Forgot Your Password?</a><br/>
    <a href="index.php" class="mt-2 btn btn-sm btn-default" >Cancel</a>
	
  </div>
  <div class="lockscreen-footer text-center">
    Copyright &copy; 2019-<script>document.write(new Date().getFullYear());</script> <a class="text-orange" href="index.php">I-Soko</a>.<br>
    All rights reserved
</div>
<!-- /.center -->

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
<script>
$(function () {
  $('#pForm').validate({
    rules: {
      password: {
        required: true,
		maxlength: 30,
      },
    },
    messages: {
      password: {
        required: "Please provide a password",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback text-left');
      element.closest('.rounded').append(error);
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
