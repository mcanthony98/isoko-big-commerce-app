<?php
if(!isset($_SESSION['sokoseller']) OR !isset($_SESSION['sokoshop'])  OR !isset($_SESSION['sokosellerlogin']) ){
		echo '<script>window.location.replace("../login.php");</script>';				
}else{
	$shop_id = $_SESSION["sokoshop"];
	$logoqry = "SELECT * FROM shop WHERE shop_id = '$shop_id' ";
	$logo_res = $pdo->query($logoqry);
	$logo_row = $logo_res->fetch_assoc();
}
?>