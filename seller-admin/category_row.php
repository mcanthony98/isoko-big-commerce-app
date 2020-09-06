<?php 
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";

	if(isset($_POST['category_id'])){
		$id = $_POST['category_id'];
		

		$stmt = "SELECT * FROM custom_category WHERE category_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		echo '
			 <label for="edit_name">Category Name</label>
             <input type="text" class="form-control" value="'.$row["category_name"].'" name="cat_name" >
			 <input type="hidden" class="catid" value="'.$row["category_id"].'" name="cat_id">
		';
	}
?>