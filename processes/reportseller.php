<?php
	session_start();	
	require "../includes/connect.php";
	require "../includes/sessions.php";
	
	date_default_timezone_set("Africa/Nairobi");
	$ddate = date("Y-m-d H:i:s");
	
	if(isset($_POST["report_shop"])){
		$complaint = trim($_POST["complaint"]);
		$complaint = htmlspecialchars($complaint);
		$complaint = mysqli_real_escape_string($pdo, $_POST["complaint"]);
		$shid = mysqli_real_escape_string($pdo, $_POST["shop"]);
		$uid = $_SESSION["sokoid"];
		
		$qry = "INSERT INTO shop_complaints(user_id, shop_id, reason, date) VALUES ('$uid' , '$shid', '$complaint', '$ddate')";
		
		if($pdo->query($qry) === TRUE){
			$_SESSION["success"] = "Your Complaint was recieved successfully.<br/> Thank You.";
			header('location: ../shop.php?shop='.$shid.'#about');
			exit();
		}else{
			$err = "Failed. Please try again. <br/>";
			$_SESSION["error"] = $err;
			header ('location: ../shop.php?shop='.$shid.'#about');
			exit ();
		}
	}
?>