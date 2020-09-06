<?php 
	session_start();
	require "../includes/connect.php";

	if(isset($_POST['navsearch'])){
		$id = mysqli_real_escape_string($pdo, $_POST["navsearch"]);
		$id = trim($id);
		$key = "%".$id."%";
		$term = "";
		$arr=explode(' ',$id);
		foreach($arr as $v){
		 $term .= " description LIKE '%".$v."%' && ";
		}
		$term = substr($term, 0, -3);
		$output = "";
		$counter = 0;
		$order = "ORDER BY
			CASE
			WHEN description LIKE '$id' THEN 1
			WHEN description LIKE '$id%' THEN 2
			WHEN description LIKE '%$id' THEN 4
			ELSE 3
		  END
		";
		if(strlen($id) > 1){
			$ssqry = "SELECT * FROM `product-subsub-category` WHERE $term $order LIMIT 9";
			$ssres = $pdo->query($ssqry);
			if($ssres->num_rows > 0){
				while ($ssrow=$ssres->fetch_assoc()){
					$output .= '<p><a class="text-secondary" href="search.php?ss='.$ssrow["psubsubcategory_id"].'">'.$ssrow["category_name"].'</a></p>'; 
					$counter ++;
				}
			}
			if ($counter < 9){
				$sqry = "SELECT * FROM `product-sub-category` WHERE $term $order LIMIT 9";
				$sres = $pdo->query($sqry);
				if ($sres->num_rows > 0){
					while($srow = $sres->fetch_assoc()){
						$output .= '<p><a class="text-secondary" href="subcategory.php?sb='.$srow["psubcategory_id"].'">'.$srow["category_name"].'</a></p>'; 
						$counter ++;
					}
				}
			}
			if ($counter < 9){
				$csqry = "SELECT custom_category.shop_id, shop.name, custom_category.category_name FROM custom_category RIGHT JOIN shop ON custom_category.shop_id=shop.shop_id WHERE custom_category.category_name LIKE '$key' AND shop.status='0'  LIMIT 6";
				$csres = $pdo->query($csqry);
				if ($csres->num_rows > 0){
					while($csrow = $csres->fetch_assoc()){
						$output .= '<p style="overflow:auto;"><a class="text-secondary" href="shop.php?shop='.$csrow["shop_id"].'#products">'.$csrow["category_name"].' <small>  -  Sold By <span class="text-orange">'.$csrow["name"].'</span></small></a></p>'; 
						$counter ++;
					}
				}
			}
			if ($counter < 9){
				$pqry = "SELECT products.subsubcategory_id, `product-subsub-category`.category_name FROM products LEFT JOIN `product-subsub-category` ON products.subsubcategory_id=`product-subsub-category`.psubsubcategory_id WHERE products.name LIKE '$key' AND products.status='0' GROUP BY products.subsubcategory_id ORDER BY products.no_of_reviews LIMIT 6";
				$pres = $pdo->query($pqry);
				if ($pres->num_rows > 0){
					while($prow = $pres->fetch_assoc()){
						$output .= '<p><a class="text-secondary" href="search.php?ss='.$prow["subsubcategory_id"].'">'.$prow["category_name"].'</a></p>'; 
						$counter ++;
					}
				}
			}
			$shqry = "SELECT * FROM shop WHERE name LIKE '$key' AND status='0' LIMIT 3";
			$shres = $pdo->query($shqry);
			if ($shres->num_rows > 0){
				$output .= '<p class="border-top text-sm" ><a class="text-orange" href="shops.php?search='.$_POST['navsearch'].'">Search For shops containing <span class="text-bold">'.$id.'<span></a></p>';
				while($shrow = $shres->fetch_assoc()){
					$logo = (!empty($shrow["logo"])) ? 'logos/'.$shrow['logo'] : '';
					$output .= '
					<p><a class="text-secondary" href="shop.php?shop='.$shrow["shop_id"].'"><img src="'.$logo.'" style="max-width:30px;max-height:30px;" class="img-fluid elevation-2 img-circle mr-1">'.$shrow["name"].'</a></p>
					';
				}
			}
		}		
		
		echo $output;
		
		if(strlen($id) > 7){
			$id = mysqli_real_escape_string($pdo, $_POST["navsearch"]);
			date_default_timezone_set("Africa/Nairobi");
			$ddate = date("Y-m-d H:i:s");
			$inqry ="INSERT INTO searches (term, date) VALUES('$id', '$ddate')";
			$pdo->query($inqry);
		}
	}
?>