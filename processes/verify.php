<?php
    session_start();
    require "../includes/connect.php";
	
	if(isset($_POST['login'])){
		
		$email = mysqli_real_escape_string($pdo, $_POST["email"]);
		$password = mysqli_real_escape_string($pdo, $_POST["password"]);

		try{

			$stmt = "SELECT * FROM users WHERE email = '$email' ";
			$login_res = $pdo->query($stmt);
			if($login_res->num_rows > 0){
				$row = $login_res->fetch_assoc();
				if($row['status'] == 0){
					if(password_verify($password, $row['password'])){
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
						
						if(!isset($_POST['return'])){
						header("location: ../index.php");
						exit();
						}else{
							$return = $_POST['return'];
						header('location: ../'.$return);
                        exit();						
						}
			           
					}
					else{
						$_SESSION['error'] = 'Incorrect Password';
					}
				}
				elseif ($row['status'] == 2){
					$_SESSION['error'] = 'Your account has been blacklisted. Please contact Customer care.';
				}
			}
			else{
				$_SESSION['error'] = 'Email not found. Create a new account.';
			}
		}
		catch(PDOException $e){
			echo "There is some problem in connection: " . $e->getMessage();
		}

	}
	else{
		$_SESSION['error'] = '';
	}
	
	                   if(!isset($_POST['return'])){
						header("location: ../login.php");
						exit();
						}else{
							$return = $_POST['return'];
						header('location: ../login.php?return='.$return);
                        exit();						
						} 
	

?>