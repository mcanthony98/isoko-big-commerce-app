<?php
    session_start();
    require "../includes/connect.php";
	require "sokofunctions.php";
	$username = "";
	if(isset($_SESSION["sokofirstname"])){
		$username = $_SESSION["sokofirstname"];
	}
	
	
	if(isset($_POST["custcat_id"])){
		$cat = mysqli_real_escape_string($pdo, $_POST["custcat_id"]);
		$shid = mysqli_real_escape_string($pdo, $_POST["shid"]);
		$output = "";
		
		if($cat == 0){
			$qry = "SELECT * FROM products WHERE shop_id='$shid' AND status='0' ORDER BY product_id DESC";
		}elseif($cat == 1){
			$qry = "SELECT * FROM products WHERE shop_id='$shid' AND status='0' ORDER BY rating/no_of_reviews DESC";
		}else{
			$qry = "SELECT * FROM products WHERE custom_category_id='$cat' AND status='0' ORDER BY product_id DESC";
	    }
		$res = $pdo->query($qry);
		if($res->num_rows == 0){
					$output .= '
						<div class="col-12">
						 <div align="center" style="padding-top:30px" class="mr-auto">
						 <p class="text-bold">Sorry '.$username.'!</p>
						 <span style="font-size:100px;">&#128542;</span>
						 <p>No Products To Display</p>
						 </div>
					</div>
					';
		}else{
		while($row = $res->fetch_assoc()){
			$pid = $row["product_id"];
			$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
			$imgres = $pdo->query($imgqry);
			if($imgres->num_rows == 0){
				$prodimg = "img/default.jpg";
			}else{
				$imgrow = $imgres->fetch_assoc();
				$prodimg = "products/".$imgrow["name"];
			}
			$output .= '
				<div class="col-xl-3 col-md-4 col-sm-4 col-6 shadow-sm zoom product-cover">
								<a href="product.php?product='.$row["product_id"].'" data-toggle="tooltip" title="'.$row["name"].'">
								  <img src="'.$prodimg.'" class="img-fluid mb-2" alt="'.$row["name"].'"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 displayname text-secondary">'.$row["name"].'</div>
									<div class="col-6"><h6">Ksh '.$row["price"].'</h6></div>
									<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
									'.rating2($row["rating"], $row["no_of_reviews"]).'
									</div>
								  </div>
								</a>
							  </div>
			';
		}
								}
		echo $output;
	}
	
	if(isset($_POST["shopterm"])){
		$term = mysqli_real_escape_string($pdo, $_POST["shopterm"]);
		$shid = mysqli_real_escape_string($pdo, $_POST["shid"]);
		$output = "";
		$where = "";
		
		$term = trim($term);
		$arr=explode(' ',$term);
		foreach($arr as $v){
		 $where .= " name LIKE '%".$v."%' && ";
		}
		$where = substr($where, 0, -3);
		
		$qry = "SELECT * FROM products WHERE $where AND shop_id='$shid' AND status='0' ORDER BY product_id DESC";
		$res = $pdo->query($qry);
		if($res->num_rows == 0){
					$output .= '
						<div class="col-12">
						 <div align="center" style="padding-top:30px" class="mr-auto">
						 <p class="text-bold">Sorry '.$username.'!</p>
						 <span style="font-size:100px;">&#128542;</span>
						 <p>No Results Found.</p>
					     <p class="text-muted"> Try searching for more general terms and avoid using words like "the, for,and" ...etc</p>
						 </div>
					</div>
					';
		}else{
		while($row = $res->fetch_assoc()){
			$pid = $row["product_id"];
			$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
			$imgres = $pdo->query($imgqry);
			if($imgres->num_rows == 0){
				$prodimg = "img/default.jpg";
			}else{
				$imgrow = $imgres->fetch_assoc();
				$prodimg = "products/".$imgrow["name"];
			}
			$output .= '
				<div class="col-xl-3 col-md-4 col-sm-4 col-6 shadow-sm zoom product-cover">
								<a href="product.php?product='.$row["product_id"].'" data-toggle="tooltip" title="'.$row["name"].'">
								  <img src="'.$prodimg.'" class="img-fluid mb-2" alt="'.$row["name"].'"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 displayname text-secondary">'.$row["name"].'</div>
									<div class="col-6"><h6">Ksh '.$row["price"].'</h6></div>
									<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
									'.rating2($row["rating"], $row["no_of_reviews"]).'
									</div>
								  </div>
								</a>
							  </div>
			';
		}
								}
		echo $output;
	}
	
	
	if(isset($_POST["sortby"])){
		$sortby = mysqli_real_escape_string($pdo, $_POST["sortby"]);
		$shid = mysqli_real_escape_string($pdo, $_POST["shid"]);
		$output = "";
		$where = "";
		$order = "ORDER BY product_id DESC";
		
		if($sortby == 2){
			$order = "ORDER BY no_of_reviews DESC";
		}elseif($sortby == 3){
			$order = "ORDER BY product_id DESC";
		}elseif($sortby == 4){
			$order = "ORDER BY price DESC";
		}elseif($sortby == 5){
			$order = "ORDER BY price";
		}elseif($sortby == 6){
			$order = "ORDER BY rating/no_of_reviews DESC";
		}else{
			$order = "ORDER BY product_id DESC";
		}
		
		
		$qry = "SELECT * FROM products WHERE shop_id='$shid' AND status='0' $order";
		$res = $pdo->query($qry);
		if($res->num_rows == 0){
					$output .= '
						<div class="col-12">
						 <div align="center" style="padding-top:30px" class="mr-auto">
						 <p class="text-bold">Sorry '.$username.'!</p>
						 <span style="font-size:100px;">&#128542;</span>
						 <p>No Products To Display</p>
						 </div>
					</div>
					';
		}else{
		while($row = $res->fetch_assoc()){
			$pid = $row["product_id"];
			$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
			$imgres = $pdo->query($imgqry);
			if($imgres->num_rows == 0){
				$prodimg = "img/default.jpg";
			}else{
				$imgrow = $imgres->fetch_assoc();
				$prodimg = "products/".$imgrow["name"];
			}
			$output .= '
				<div class="col-xl-3 col-md-4 col-sm-4 col-6 shadow-sm zoom product-cover">
								<a href="product.php?product='.$row["product_id"].'" data-toggle="tooltip" title="'.$row["name"].'">
								  <img src="'.$prodimg.'" class="img-fluid mb-2" alt="'.$row["name"].'"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 displayname text-secondary">'.$row["name"].'</div>
									<div class="col-6"><h6">Ksh '.$row["price"].'</h6></div>
									<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
									'.rating2($row["rating"], $row["no_of_reviews"]).'
									</div>
								  </div>
								</a>
							  </div>
			';
		}
								}
		echo $output;
	}
	
	
	if(isset($_POST["clicked"])){
		$sortby = mysqli_real_escape_string($pdo, $_POST["clicked"]);
		$shid = mysqli_real_escape_string($pdo, $_POST["shid"]);
		$displaybtn = "Relevance";
		
		if($sortby == 2){
			$displaybtn = "Popularity";
		}elseif($sortby == 3){
			$displaybtn = "Newest Arrival";
		}elseif($sortby == 4){
			$displaybtn = "Highest Price";
		}elseif($sortby == 5){
			$displaybtn = "Lowest Price";
		}elseif($sortby == 6){
			$displaybtn = "Highest Rated";
		}else{
			$displaybtn = "Relevance";
		}
		
		echo $displaybtn;
	
	}
	
?>