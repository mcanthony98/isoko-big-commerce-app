<?php
    session_start();
    	
	require "../includes/connect.php";

	if (isset($_POST["sign_up"])){
	
	$fname = mysqli_real_escape_string($pdo, $_POST["fname"]);
	$lname = mysqli_real_escape_string($pdo, $_POST["lname"]);
	$email = mysqli_real_escape_string($pdo, $_POST["email"]);
	$phone = mysqli_real_escape_string($pdo, $_POST["phone"]);
	$password = mysqli_real_escape_string($pdo, $_POST["password"]);
	$cpassword = mysqli_real_escape_string($pdo, $_POST["cpassword"]);
	date_default_timezone_set("Africa/Nairobi");
	$ddate = date("Y-m-d H:i:s");
	
	if($cpassword != $password){
		$err= "Passwords do not match! ";
		$_SESSION["error"] = $err;
		header ("Location: ../register.php");
			exit ();
	}else{
		
	
    $select_qry = "SELECT * FROM users WHERE email = '$email'";
    $blog_res = $pdo->query($select_qry);

			
    if($blog_res->num_rows == 0){
 
	 $enc_password= password_hash($password, PASSWORD_DEFAULT);
	   
	$users_insert = "INSERT INTO users(firstname, lastname, email, phone, password, date_created) VALUES ('$fname', '$lname', '$email', '$phone','$enc_password', '$ddate')";
	
	if ($pdo->query($users_insert)==TRUE){
		
		$sql="SELECT * FROM users WHERE email='$email'";
		$result=mysqli_query($pdo,$sql);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		$_SESSION['sokofirstname'] = $row['firstname'];
		$_SESSION['sokoemail'] = $row['email'];
		$_SESSION['sokoid'] = $row['user_id'];
		$uid = $row['user_id'];
						if($row['type'] == 0){
							$_SESSION['sokoadmin'] = $row['user_id'];
						}
						elseif ($row['type'] == 1){
							$_SESSION['sokoseller'] = $row['user_id'];
							
							$stmtt = "SELECT * FROM shop WHERE user_id = '$uid' ";
							$loginn_res = $pdo->query($stmtt);
							$roww = $loginn_res->fetch_assoc();
							$_SESSION['sokoshop'] = $roww['shop_id'];
						}
						elseif ($row['type'] == 2){
							$_SESSION['sokobuyer'] = $row['user_id'];
						}
						
						$_SESSION["success"] = "Your Account was created succesfully";
						header("location: ../index.php");
						exit();
		
					
						
	}else{
		$err = "Failed. Please try again. <br/>" . $pdo->error;
		$_SESSION["error"] = $err;
		header ("Location: ../register.php");
		exit ();
		}
		
		
	}else{
		
		$err= "Email already exists!";
		$_SESSION["error"] = $err;
		header ("Location: ../register.php");
		exit ();
		
	}
	}
	}else{
		header ("Location: ../index.php");
		exit ();
	}
	
	?>
					
	
			
	