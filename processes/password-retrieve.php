<?php
    session_start();
    require "../includes/connect.php";
	
	if(isset($_POST['retrieve'])){
		$email = mysqli_real_escape_string($pdo, $_POST["email"]);
		$set='123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$reset_code= substr(str_shuffle($set), 0, 12);
		
		$qry = "SELECT * FROM users WHERE email='$email'";
		$res = $pdo->query($qry);
		
		if($res->num_rows == 0){
			$_SESSION["error"] = "Email does not exist.";
		}else{
			$row = $res->fetch_assoc();
			$insqry = "UPDATE users SET reset_code = '$reset_code' WHERE email='$email'";
			$insres = $pdo->query($insqry);
			
			$recipient = $email;
			$subject = "I-Soko - Retrieve Password!";
			$body = 'Forgot pssword...<br/> Click on the link below to retrieve your password.<br/> <a href="localhost/shopika/i-soko/recover-password.php?rscde='.$reset_code.'&urs='.$row["user_id"].'"> Click here</a>';
			require "mailer.php";
		}
			header("location: ../forgot-password.php?sentr");
			exit();	
			
	}
	elseif(isset($_POST['chngpssrd'])){
		$password = mysqli_real_escape_string($pdo, $_POST["password"]);
		$cpassword = mysqli_real_escape_string($pdo, $_POST["cpassword"]);
		$rscode = mysqli_real_escape_string($pdo, $_POST["rscode"]);
		$uid = mysqli_real_escape_string($pdo, $_POST["uid"]);
		
		if($cpassword != $password){
			$err= "Passwords do not match! ";
			$_SESSION["error"] = $err;
				header ("Location: ../recover-password.php?rscde=$rscode&urs=$uid");
			exit ();
		}else{
			
			$enc_password= password_hash($password, PASSWORD_DEFAULT);
			$insqry = "UPDATE users SET password = '$enc_password' WHERE user_id='$uid' AND reset_code='$rscode'";
			$insres = $pdo->query($insqry);
			
			if($insres === TRUE){
				$_SESSION["success"] = "Password Changed Successful. Login with your new password.";
				header ("Location: ../login.php");
				exit ();
			}else{
				$_SESSION["error"] = "An error occured. Please Try Again";
				header ("Location: ../recover-password.php?rscde=".$reset_code."&urs=".$row['user_id']."");
				exit ();
			}
		}	
	}else{
		header ("Location: ../index.php");
		exit ();
	}
?>