<?php
    session_start();
    require "../includes/connect.php";
    require "../includes/sessions.php";
	$user =  mysqli_real_escape_string($pdo, $_SESSION["sokoid"]);
	date_default_timezone_set("Africa/Nairobi");
	$ddate = date("Y-m-d H:i:s");
	
	if(isset($_GET["follow"])){
		$shid = mysqli_real_escape_string($pdo, $_GET["follow"]);
		
		$qry = "INSERT INTO followers (shop_id, user_id, date) VALUES ('$shid', '$user', '$ddate')";
		
		if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "You are now following this shop";
			}else{
				$_SESSION["error"] = "Error happens. Please Try again" . $pdo->error;
			}
			
	}
	
	if(isset($_GET["unfollow"])){
		$shid = mysqli_real_escape_string($pdo, $_GET["unfollow"]);
		
		$qry = "DELETE FROM followers WHERE shop_id='$shid' AND user_id='$user'";
		
		if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "You unfollowed this shop";
			}else{
				$_SESSION["error"] = "Error happens. Please Try again" . $pdo->error;
			}
			
	}
	
	
		header('location: ../shop.php?shop='.$shid.'');
		exit();	
	
?>