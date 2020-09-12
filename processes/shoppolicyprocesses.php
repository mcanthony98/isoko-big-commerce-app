<?php
	session_start();
    require "../includes/connect.php";
    require "../seller-admin/includes/sessions.php";
	
	$shid = mysqli_real_escape_string($pdo, $_SESSION["sokoshop"]);
	
	if(isset($_POST["ptime"])){
		$ptime = mysqli_real_escape_string($pdo, $_POST["ptime"]);
		$selectres = $pdo->query("SELECT * FROM processing_time WHERE shop_id='$shid'");
		if($selectres->num_rows == 0){
			$qry = "INSERT INTO processing_time (shop_id, days) VALUES ('$shid', '$ptime')";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Processing Time updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php");
				exit();
			}
		}else{
			$qry = "UPDATE processing_time SET days='$ptime' WHERE shop_id='$shid'";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Processing Time updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php");
				exit();
			}
		}
	}elseif(isset($_POST["free-del"])){
		$val = mysqli_real_escape_string($pdo, $_POST["free-del"]);
		
		$qry = "UPDATE shop SET offers_free_delivery='$val' WHERE shop_id='$shid'";
		if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Delivery Status updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}
		
	}
	elseif(isset($_POST["add-del"])){
		$county = mysqli_real_escape_string($pdo, $_POST["county"]);
		$cost = mysqli_real_escape_string($pdo, $_POST["cost"]);
		$period = mysqli_real_escape_string($pdo, $_POST["period"]);
		
		$selectres = $pdo->query("SELECT * FROM shop_delivery WHERE shop_id='$shid' AND county_id='$county'");
		if($selectres->num_rows == 0){
			$qry = "INSERT INTO shop_delivery (shop_id, county_id, cost, period) VALUES ('$shid', '$county', '$cost', '$period')";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Delivery Option Added Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}
		}else{
			$qry = "UPDATE shop_delivery SET cost='$cost', period='$period' WHERE shop_id='$shid' AND county_id='$county'";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Delivery Option Updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}
		}
	}
	elseif(isset($_GET["deldel"])){
		$delid = mysqli_real_escape_string($pdo, $_GET["deldel"]);
		
		$qry = "DELETE FROM shop_delivery WHERE shop_id='$shid' AND id='$delid'";
		
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Delivery Option Deleted Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}
	}
	elseif(isset($_POST["delinfo"])){
		$delid = mysqli_real_escape_string($pdo, $_POST["del-info"]);
		
		$selectres = $pdo->query("SELECT * FROM shop_info WHERE shop_id='$shid'");
		if($selectres->num_rows == 0){
			$qry = "INSERT INTO shop_info (shop_id, delivery_info) VALUES ('$shid', '$delid')";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Delivery Info Set Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.".$pdo->error;
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}
		}else{
			$qry = "UPDATE shop_info SET deliverY_info='$delid' WHERE shop_id='$shid'";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Delivery Info Set Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#del");
				exit();
			}
		
		}
	
	}
	elseif(isset($_POST["pickupstat"])){
		$val = mysqli_real_escape_string($pdo, $_POST["pickupstat"]);
		
		$qry = "UPDATE shop SET has_pickup='$val' WHERE shop_id='$shid'";
		if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Pick Up Status updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}
		
	}
	elseif(isset($_POST["add-pickup"])){
		$loc = mysqli_real_escape_string($pdo, $_POST["location"]);
		$county = mysqli_real_escape_string($pdo, $_POST["county"]);
		$city = mysqli_real_escape_string($pdo, $_POST["city"]);
		$open = mysqli_real_escape_string($pdo, $_POST["open"]);
		$close = mysqli_real_escape_string($pdo, $_POST["close"]);
		$cost = mysqli_real_escape_string($pdo, $_POST["cost"]);
		$period = mysqli_real_escape_string($pdo, $_POST["period"]);
		
		if(isset($_POST["pickid"])){
			$pid = mysqli_real_escape_string($pdo, $_POST["pickid"]);
			
			$qry = "UPDATE shop_pickup SET location='$loc', county_id='$county', city_id='$city', open_time='$open', close_time='$close', cost='$cost', period='$period' WHERE id='$pid' AND  shop_id='$shid'";
			
		}else{
			$qry = "INSERT INTO shop_pickup (shop_id, location, county_id, city_id, open_time, close_time, cost, period) VALUES ('$shid', '$loc', '$county', '$city', '$open', '$close', '$cost', '$period')";
		}
		
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Pick Up Station Updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.".$pdo->error;
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}
	}
	elseif(isset($_GET["picdelete"])){
		$delid = mysqli_real_escape_string($pdo, $_GET["picdelete"]);
		
		$qry = "DELETE FROM shop_pickup WHERE shop_id='$shid' AND id='$delid'";
		
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Pick Up Deleted Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}
	}
	elseif(isset($_POST["pickinfo"])){
		$info = mysqli_real_escape_string($pdo, $_POST["pick-info"]);
		
		$selectres = $pdo->query("SELECT * FROM shop_info WHERE shop_id='$shid'");
		if($selectres->num_rows == 0){
			$qry = "INSERT INTO shop_info (shop_id, pickup_info) VALUES ('$shid', '$info')";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Pick Up Info Set Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}
		}else{
			$qry = "UPDATE shop_info SET pickup_info='$info' WHERE shop_id='$shid'";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Pick Up Info Set Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#pic");
				exit();
			}
		
		}
	
	}
	elseif(isset($_POST["returninfo"])){
		$info = mysqli_real_escape_string($pdo, $_POST["return-info"]);
		
		$selectres = $pdo->query("SELECT * FROM shop_info WHERE shop_id='$shid'");
		if($selectres->num_rows == 0){
			$qry = "INSERT INTO shop_info (shop_id, return_info) VALUES ('$shid', '$info')";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Return Info Set Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#ret");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#ret");
				exit();
			}
		}else{
			$qry = "UPDATE shop_info SET return_info='$info' WHERE shop_id='$shid'";
			if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Return Info Set Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#ret");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#ret");
				exit();
			}
		
		}
	
	}
	elseif(isset($_POST["returns"])){
		$val = mysqli_real_escape_string($pdo, $_POST["returns"]);
		
		$qry = "UPDATE shop SET accept_returns='$val' WHERE shop_id='$shid'";
		
		if($pdo->query($qry) === TRUE){
				$_SESSION["success"] = "Return Status Updated Successfully";
				header ("Location: ../seller-admin/shoppolicy.php#ret");
				exit();
			}else{
				$_SESSION["error"] = "An error occured. Please Try again.";
				header ("Location: ../seller-admin/shoppolicy.php#ret");
				exit();
			}
	}

?>