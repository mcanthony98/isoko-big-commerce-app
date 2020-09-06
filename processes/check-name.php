<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['inputVal'])){
		$id = mysqli_real_escape_string($pdo, $_POST["inputVal"]);
		
		if(strlen($id) > 2){
			$stmt = "SELECT * FROM shop WHERE name = '$id'";
			$res = $pdo->query($stmt);
			$row = $res->fetch_assoc();
			
			if($res->num_rows > 0){
				echo 'Shop name already taken. Try a different name';
			}
		}
	}
?>