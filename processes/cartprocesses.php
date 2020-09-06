<?php
     session_start();
    require "../includes/connect.php";
	
	if(isset($_SESSION["sokoid"])){
		$uid = mysqli_real_escape_string($pdo, $_SESSION["sokoid"]);
		
		//add to cart dtb
		if(isset($_POST["cartplus"])){
			$pid = mysqli_real_escape_string($pdo, $_POST["cartplus"]);
			$qty = 1;
			
			$navcartres = $pdo->query("SELECT * FROM cart WHERE user_id='$uid'");
			$chekres = $pdo->query("SELECT * FROM cart WHERE user_id = '$uid' AND product_id = '$pid'");
			
			if($chekres->num_rows == 0){
				$qry = "INSERT INTO cart(user_id, product_id, quantity) VALUES('$uid', '$pid', '$qty')";
				if($pdo->query($qry) === TRUE){
					echo '<script>toastr.success("Product added to cart successfully. <br/><a href=\"cart.php\"><u>Go to cart?</u></a>");
						document.getElementById("cartnumz").innerHTML =1+'.$navcartres->num_rows.' ;
					</script>';
				}else{
					echo '<script>toastr.error("An error occured. Please try again.")</script>';
				}
				
			}else{
				echo '<script>toastr.info("This product is already in your cart. <br/><a href=\"cart.php\"><u>Go to cart?</u></a>")</script>';
			}
	
	}
	elseif(isset($_GET["emptycart"])){
		
		$dltqry = "DELETE FROM cart WHERE user_id = '$uid'";
		
		if ($pdo->query($dltqry)===TRUE && $uid==$_GET["emptycart"]){
			  
			  $_SESSION["success"] = "Cart Emptied Sucessfully.";
			  header('location: ../cart.php');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again";
			  header('location: ../cart.php');
		  }
		
	}
	if(isset($_POST["personcurrently"])){
		$personcurrently = mysqli_real_escape_string($pdo, $_POST["personcurrently"]);
		$qty = mysqli_real_escape_string($pdo, $_POST["qty"]);
		$pid = mysqli_real_escape_string($pdo, $_POST["pid"]);
		
		$qry = "UPDATE cart SET quantity='$qty' WHERE cart_id='$pid' and user_id='$uid'";
		
		if ($pdo->query($qry)===TRUE && $uid==$personcurrently){
			  
			  $_SESSION["success"] = "Product Quantity Updated Sucessfully.";
			  header('location: ../cart.php#item'.$pid);
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again";
			   header('location: ../cart.php#item'.$pid);
		  }
		
	}
	elseif(isset($_GET["delete"])){
		$personcurrently = mysqli_real_escape_string($pdo, $_GET["delete"]);
		$cartid = mysqli_real_escape_string($pdo, $_GET["cid"]);
		
		$dltqry = "DELETE FROM cart WHERE user_id = '$personcurrently' AND cart_id='$cartid'";
		
		if ($pdo->query($dltqry)===TRUE && $uid==$personcurrently){
			  
			  $_SESSION["success"] = "Product Removed From Cart Sucessfully.";
			  header('location: ../cart.php');
			  
		  }else{
			  $_SESSION["error"] = "Error Occured. Please Try Again";
			  header('location: ../cart.php');
		  }
		
	}

	
	
	
	
	
	}else{
		
		//add to cart sess                                                                           order: product_id => qty
		if(isset($_POST["cartplus"])){
			$pid = mysqli_real_escape_string($pdo, $_POST["cartplus"]);
			$qty = 1;
			
			if(!isset($_SESSION["sokoshoppingcart"])){
				$_SESSION["sokoshoppingcart"] = array($pid => $qty);
				echo '<script>toastr.success("Product added to cart successfully. <br/><a href=\"cart.php\"><u>Go to cart?</u></a>");
						document.getElementById("cartnumz").innerHTML ='.count($_SESSION["sokoshoppingcart"]).' ;
				</script>';
			}else{
				if(array_key_exists($pid, $_SESSION["sokoshoppingcart"])){
					echo '<script>toastr.info("This product is already in your cart. <br/><a href=\"cart.php\"><u>Go to cart?</u></a>")</script>';
				}else{
					$_SESSION["sokoshoppingcart"][$pid] = $qty;
					echo '<script>toastr.success("Product added to cart successfully. <br/><a href=\"cart.php\"><u>Go to cart?</u></a>");
						document.getElementById("cartnumz").innerHTML ='.count($_SESSION["sokoshoppingcart"]).' ;
					</script>';
				}
			}
	
		}
		elseif(isset($_POST["qty"])){
			$qty = mysqli_real_escape_string($pdo, $_POST["qty"]);
			$pid = mysqli_real_escape_string($pdo, $_POST["pid"]);
			
			if(array_key_exists($pid, $_SESSION["sokoshoppingcart"])){
				$_SESSION["sokoshoppingcart"][$pid] = $qty;
				$_SESSION["success"] = "Product Quantity Updated Sucessfully.";
				header('location: ../cart.php#item'.$pid);
			}else{
				$_SESSION["error"] = "Error Occured. Please Try Again";
				header('location: ../cart.php');
			}			
		
		}
		elseif(isset($_GET["delete"])){
			$pid = mysqli_real_escape_string($pdo, $_GET["delete"]);
			
			unset($_SESSION["sokoshoppingcart"][$pid]);
			$_SESSION["success"] = "Product Removed From Cart Sucessfully.";
			header('location: ../cart.php');
		}
		
		elseif(isset($_GET["emptycart"])){
			unset($_SESSION["sokoshoppingcart"]);
			
			$_SESSION["success"] = "Cart Emptied Sucessfully.";
			header('location: ../cart.php');
		}
		
	}
	?>