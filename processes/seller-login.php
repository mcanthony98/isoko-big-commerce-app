<?php
    session_start();
    require "../includes/connect.php";
	require "../includes/sessions.php";
	require "../includes/seller-session.php";
	
	if(isset($_POST['seller-login'])){
		$password = mysqli_real_escape_string($pdo, $_POST["password"]);
		$user = mysqli_real_escape_string($pdo, $_SESSION["sokoid"]);
		
		$stmt = "SELECT * FROM users WHERE user_id = '$user'";
		$res = $pdo->query($stmt);
		if($res->num_rows > 0){
			$row = $res->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION["sokosellerlogin"] = $user;
				header ("Location: ../seller-admin/index.php");
				exit ();
			}else{
				$_SESSION["error"] = "Incorrect Password.";
				header ("Location: ../seller-login.php");
				exit ();
			}
		}else{
			header ("Location: logout.php");
	        exit ();
		}
		
	}
?>