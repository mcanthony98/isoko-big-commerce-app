<?php

      session_start();
      require "../includes/connect.php";
      require "../includes/buyer-session.php";
	  
        if(isset($_GET["create"])){
			
		  $name = mysqli_real_escape_string($pdo, $_SESSION["f1name"]);
		  $cat = mysqli_real_escape_string($pdo, $_SESSION["f2cat"]);
		  $slogan = mysqli_real_escape_string($pdo, $_SESSION["f2desc"]);
		  $phone = mysqli_real_escape_string($pdo, $_SESSION["f1phone"]);
		  $email = mysqli_real_escape_string($pdo, $_SESSION["f1email"]);
		  $paymentphone = mysqli_real_escape_string($pdo, $_SESSION["f3mpesa"]);
		  $uid = $_SESSION["sokoid"];
		  date_default_timezone_set("Africa/Nairobi");
	      $ddate = date("Y-m-d H:i:s");
		  $state = 5;
		  		  
		  	$shqry = "SELECT * FROM shop WHERE email = '$email'";
			$shres = $pdo->query($shqry);
			if($shres->num_rows > 0){
				$_SESSION["error"] = "Email address you entered is taken!";
				header('location: ../create-shop.php');
				exit();
			}else{
				$urqry = "SELECT * FROM shop WHERE user_id = '$uid'";
			    $urres = $pdo->query($urqry);
				if($urres->num_rows > 0){
					$_SESSION["error"] = "You Already have a shop";
					header('location: ../create-shop.php');
					exit();
				}else{
					$products_insert = "INSERT INTO shop(name, phone, email, slogan, category_id, user_id, status, date_created, expiry_date, payment_no) VALUES ('$name', '$phone', '$email', '$slogan','$cat', '$uid', '$state', '$ddate', '$ddate', '$paymentphone' )";
		
		
		if ($pdo->query($products_insert)===TRUE){
			
			$stmt = "SELECT * FROM shop WHERE user_id = '$uid' ";
			$login_res = $pdo->query($stmt);
			$row = $login_res->fetch_assoc();
			$_SESSION['sokoshop'] = $row['shop_id'];
			
			$recipient = $email;
			$subject = "I-Soko - Confirm Your Email!";
			$body = '<h3>You are just a step away from opening your Online Shop.</h3>
					Click on the link below to activate your online shop. <br/>
					<a href="localhost/shopika/i-soko/seller-login.php?cnfrm='.$_SESSION["sokoshop"].'"> Click Here</a>
			';
			require "mailer.php";
		
		$msg="Shop Created Successfully!";
		$_SESSION["success"] = $msg;
		$_SESSION["sokoseller"] = $_SESSION["sokobuyer"];
		unset ($_SESSION["sokobuyer"]);
		unset ($_SESSION["f1name"]);
		unset ($_SESSION["f2cat"]);
		unset ($_SESSION["f2desc"]);
		unset ($_SESSION["f1phone"]);
		unset ($_SESSION["f1email"]);
		unset ($_SESSION["f3mpesa"]);
		
				
		$stmtt = "UPDATE users SET type = 1 WHERE user_id = '$uid'";
		$login_res = $pdo->query($stmtt);
		
		
		header('location: ../confirm-email.php?email='.$email.'');
		exit();
		  
		  }else{
		$err= "Failed to create shop. Please Try Again. <br/>" . $pdo->error;
		$_SESSION["error"] = $err;
		
		header('location: ../create-shop.php');
		 exit();
	}	
				}
			}
			
		}else{
			header('location: ../create-shop.php');
			 exit();
		 }
		?>
		
		<?php 
		
			
		?>
		
		
		