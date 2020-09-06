<?php

      session_start();
    require "../includes/connect.php";
	  
	  $shop_id = $_SESSION["sokoshop"];
        if(isset($_POST["StatusToggle"])){
			
			
			$row = $pdo->query("SELECT * FROM shop WHERE shop_id = '$shop_id'")->fetch_assoc();
			$current = $row["status"];
			
			if($current == 0){
				if ($pdo->query("UPDATE shop SET status=4 WHERE shop_id='$shop_id'")===TRUE){
					$_SESSION["success"] = "Shop Closed successfully. ";
				}else{
					$_SESSION["error"] = "Error Happens. Please try Again";
				}
				
			}elseif($current == 4){
			    if ($pdo->query("UPDATE shop SET status=0 WHERE shop_id='$shop_id'")===TRUE){
					$_SESSION["success"] = "Shop Activated successfully. ";
				}else{
					$_SESSION["error"] = "Error Happens. Please try Again";
				}
			}elseif($current == 1){
				
				    $_SESSION["error"] = "Unable to activate shop. Please pay for your subscription to activate shop.";
				
			}else{
				$_SESSION["error"] = "Unable to activate shop. Contact Customer Care for assistance.";
			}
			
			header('location: ../seller/shop.php');
			exit();
			}
			
		if(isset($_POST["logoedit"])){
			$image = $_FILES['photos']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
			
			date_default_timezone_set("Africa/Nairobi");
	       $ddate = date("Y_m_d_H_i_s");	
		
		  $file_name = $_FILES["photos"]["name"];
	      $_FILES["photos"]["type"];
	      $tmp_file = $_FILES["photos"]["tmp_name"];
		
		   $destination = "../logos/" . $file_name;
		
		move_uploaded_file($tmp_file, $destination);
		$new = $ddate.$file_name;
		$new_name = rename('../logos/'.$file_name , '../logos/'.$new);
		
		if($new_name === TRUE){
			$logo_edit = "UPDATE shop SET logo='$new' WHERE shop_id='$shop_id'";
			 if ($pdo->query($logo_edit)===TRUE){
				 $_SESSION["success"] = "Shop logo Updated Successfully";
			 }else{
				 $_SESSION["error"] = "Error happens. Please Try again";
			 }
		}else{
			$_SESSION["error"] = "Error happens. Try resizing image before uploading.";
		}
			
			header('location: ../seller-admin/shopoutlook.php');
			exit();
			
		}
		
		if(isset($_POST["shopedit"])){
			$name = mysqli_real_escape_string($pdo, $_POST["name"]);	
			$phone = mysqli_real_escape_string($pdo, $_POST["phone"]);	
			$email = mysqli_real_escape_string($pdo, $_POST["email"]);	
			$cat = mysqli_real_escape_string($pdo, $_POST["cat"]);	
			$slogan = mysqli_real_escape_string($pdo, $_POST["slogan"]);	
			$pphone = mysqli_real_escape_string($pdo, $_POST["pphone"]);

            $stmt = "UPDATE shop SET name='$name', phone='$phone', email='$email', slogan='$slogan', category_id='$cat', payment_no='$pphone' WHERE shop_id='$shop_id'";
			
			if($pdo->query($stmt) === TRUE){
				$_SESSION["success"] = "Shop Details Updated Successfully";
			}else{
				$_SESSION["error"] = "Error happens. Please Try again" . $pdo->error;
			}
			
           	header('location: ../seller-admin/shopinfo.php');
			exit();	
		}
		
		if(isset($_POST["announcement"])){
			$text = mysqli_real_escape_string($pdo, $_POST["text"]);	
			$date = mysqli_real_escape_string($pdo, $_POST["until"]);
			
			
			$slct = "SELECT * FROM shop_announcement where shop_id='$shop_id'";
			$sres = $pdo->query($slct);
			if($sres->num_rows < 1){
				$stmt = "INSERT INTO shop_announcement (announcement, date_until, shop_id) VALUES ('$text' ,'$date', '$shop_id')";
			}else{	
				$stmt = "UPDATE shop_announcement SET announcement='$text', date_until='$date'  WHERE shop_id='$shop_id'";
			} 
			
			if($pdo->query($stmt) === TRUE){
				$_SESSION["success"] = "Announcement Updated Successfully";
			}else{
				$_SESSION["error"] = "Error happens. Please Try again" . $pdo->error;
			}
			
           	header('location: ../seller-admin/shopoutlook.php');
			exit();	
		}
		
		if(isset($_POST["newcarousel"])){
			$image = $_FILES['photos']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
			
			date_default_timezone_set("Africa/Nairobi");
	       $ddate = date("Y_m_d_H_i_s");	
		
		  $file_name = $_FILES["photos"]["name"];
	      $_FILES["photos"]["type"];
	      $tmp_file = $_FILES["photos"]["tmp_name"];
		
		   $destination = "../carousels/" . $file_name;
		
		move_uploaded_file($tmp_file, $destination);
		$new = $ddate.$file_name;
		$new_name = rename('../carousels/'.$file_name , '../carousels/'.$new);
		
		if($new_name === TRUE){
			$cnew = "INSERT INTO shop_carousel (name, shop_id) VALUES ('$new', '$shop_id')";
			 if ($pdo->query($cnew)===TRUE){
				 $_SESSION["success"] = "Carousel Image set Successfully";
			 }else{
				 $_SESSION["error"] = "Error happens. Please Try again";
			 }
		}else{
			$_SESSION["error"] = "Error happens. Try resizing image before uploading.";
		}
			
			header('location: ../seller-admin/shopoutlook.php');
			exit();
			
			
		}
		
		if(isset($_POST["changecaro"])){
			$changecaro = mysqli_real_escape_string($pdo, $_POST["changecaro"]);	
			$image = $_FILES['photos']['tmp_name'];
			$imgContent = addslashes(file_get_contents($image));
			
			date_default_timezone_set("Africa/Nairobi");
	       $ddate = date("Y_m_d_H_i_s");	
		
		  $file_name = $_FILES["photos"]["name"];
	      $_FILES["photos"]["type"];
	      $tmp_file = $_FILES["photos"]["tmp_name"];
		
		   $destination = "../carousels/" . $file_name;
		
		move_uploaded_file($tmp_file, $destination);
		$new = $ddate.$file_name;
		$new_name = rename('../carousels/'.$file_name , '../carousels/'.$new);
		
		if($new_name === TRUE){
			$cupd = "UPDATE shop_carousel SET name='$new' WHERE shop_id='$shop_id' AND carousel_id='$changecaro'";
			 if ($pdo->query($cupd)===TRUE){
				 $_SESSION["success"] = "Carousel Image set Successfully";
			 }else{
				 $_SESSION["error"] = "Error happens. Please Try again";
			 }
		}else{
			$_SESSION["error"] = "Error happens. Try resizing image before uploading.";
		}
			
			header('location: ../seller-admin/shopoutlook.php');
			exit();
			
			
		}
   		
?>