<?php
	session_start();	
	require "includes/connect.php";
	require "processes/sokofunctions.php";
	$headtitle = "I-Soko - Browse Products Online and Purchase";
	$headdesc = "The Online Mall Where you can Purchase Products From Your Favourite Sellers!";
	$headkeywords = "";
	date_default_timezone_set("Africa/Nairobi");
	$ddate = date("Y-m-d H:i:s");
	$catname ="";
	$order = "";
	
	if(isset($_GET["search"])){
		$search = mysqli_real_escape_string($pdo, $_GET["search"]);
		$inqry ="INSERT INTO search_page (term, date) VALUES('$search', '$ddate')";
		$pdo->query($inqry);
		$qry = "SELECT * FROM products WHERE name LIKE '%$search%' AND status='0' $order";
		$res = $pdo->query($qry);
		
		$shoqry = "SELECT * FROM products WHERE name LIKE '%$search%' AND status='0' GROUP BY shop_id";
	}elseif(isset($_GET["ss"])){
		$search = mysqli_real_escape_string($pdo, $_GET["ss"]);
		$qry = "SELECT * FROM products RIGHT JOIN `product-subsub-category` ON products.subsubcategory_id=`product-subsub-category`.psubsubcategory_id WHERE products.subsubcategory_id='$search' AND products.status='0' '$order'";
		$res = $pdo->query($qry);
		if($res->num_rows > 0){
		$inrow = $res->fetch_assoc();
		$catname = $inrow["category_name"];
		$inqry ="INSERT INTO search_page (term, date) VALUES('$catname', '$ddate')";
		$pdo->query($inqry);

		$headtitle = $catname." - I-Soko";
		$headdesc = $inrow["description"] . " - I-Soko";
		$headkeywords = $inrow["description"] . " - I-Soko";
		}
		$shoqry = "SELECT * FROM products WHERE subsubcategory_id='$search' AND status='0' GROUP BY shop_id";
		$res = $pdo->query($qry);
	}else{
		$qry = "SELECT * FROM products WHERE status='0' $order";
		$shoqry = "SELECT * FROM products WHERE status='0' GROUP BY shop_id";
		$res = $pdo->query($qry);
	}
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
			<?php 
				if(isset($_GET["search"])){
					echo '
						<h5 class="text-dark">Results for "'.$_GET["search"].'" <span class="text-muted text-sm float-right">'.$res->num_rows.' Results</span></h5> 
						<small><a class="text-orange" href="shops.php?search='.$_GET["search"].'">Search for Shop Instead?</a></small>
					';
				}elseif(isset($_GET["ss"])){
					echo '<h5 class="text-dark">'.$catname.' <span class="text-muted text-sm float-right">'.$res->num_rows.' Results</span></h5>';
				}
			?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	  
		 <!-- Shop Items -->
		<div class="row ">
          
          <div class="col-12">
            <div class="card card-solid">
			<?php if($res->num_rows == 0){?>
				<div class="card-body">
					 <div align="center" style="padding-top:30px" class="mr-auto">
					 <p class="text-bold">Sorry <?php if(isset($_SESSION["sokoid"])){echo $_SESSION["sokofirstname"];}?>!</p>
					 <span style='font-size:100px;'>&#128542;</span>
					 <p>No Results Found.</p>
					 <p class="text-muted"> Try searching for more general terms and avoid using words like "the, for,and" ...etc</p>
					 <p><a href="index.php" class="btn bg-orange"><span class="text-bold text-white">Go To Homepage</span></a></p>
					 </div>
				</div>
			<?php }else{ ?>
              <div class="card-body">
				<div class="row">
					<div class="col-6">
						<span class=" d-lg-none text-muted fa fa-bars"></span>
					</div>
					<div class="col-6">
						<div class="btn-group float-right">
						  <button type="button" class="btn btn-xs btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sort By: Highest Price
						  </button>
						  <div class="dropdown-menu dropdown-menu-right">
							<a class="dropdown-item" href="">Relevance</a>
							<a class="dropdown-item" href="">Popularity</a>
							<a class="dropdown-item" href="">Newest Arrival</a>
							<a class="dropdown-item" href="">Highest Price</a>
							<a class="dropdown-item" href="">Lowest Price</a>
							<a class="dropdown-item" href="">Highest Rated</a>
						  </div>
						</div>
					</div>
				</div>
                <div class="row">
				  <div class="col-3 shadow-lg d-none d-lg-block rounded">
					<div class="" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
					  <h6 class="mt-1">Related Categories</h6>
					
					  <ul class="list-unstyled pl-2 text-sm" style="max-height:150px;overflow-y:scroll">
							<?php 
							if(isset($_GET["search"])){
								$cssqry = "SELECT COUNT(Product_id) AS NumberOfProducts, subsubcategory_id FROM products WHERE name LIKE '%$search%' AND status='0' GROUP BY subsubcategory_id ORDER BY COUNT(Product_id) DESC";
								$cssres = $pdo->query($cssqry);
								if($cssres->num_rows == 0){
								}else{
									while($cssrow=$cssres->fetch_assoc()){
										$sssid = $cssrow["subsubcategory_id"];
										$sssqry = "SELECT * FROM `product-subsub-category` WHERE psubsubcategory_id='$sssid'";
										$sssres = $pdo->query($sssqry);
										if($sssres->num_rows == 0){
										}else{
											$sssrow=$sssres->fetch_assoc();
											echo '<li><a href="?ss='.$sssrow["psubsubcategory_id"].'" class="text-secondary">'.$sssrow["category_name"].'</a></li>';
										}
									}
								}	
							}elseif(isset($_GET["ss"])){
								$ssqry = "SELECT * FROM `product-subsub-category` WHERE psubcategory_id = (SELECT psubcategory_id FROM `product-subsub-category` WHERE psubsubcategory_id='$search' )";
								$ssres = $pdo->query($ssqry);
								if($ssres->num_rows == 0){
								}else{
									while($ssrow=$ssres->fetch_assoc()){
										echo '<li><a href="?ss='.$ssrow["psubsubcategory_id"].'" class="text-secondary">'.$ssrow["category_name"].'</a></li>';
								    }
								}
							}else{
								$ssqry = "SELECT * FROM `product-category`";
								$ssres = $pdo->query($ssqry);
								while($ssrow=$ssres->fetch_assoc()){
										echo '<li><a href="subcategory.php?sb='.$ssrow["pcategory_id"].'" class="text-secondary">'.$ssrow["category_name"].'</a></li>';
								    }
							}
							?>
                     </ul>
					<h6 class="text-orange">Filter</h6>
					
					
					 <h6>Related Shops</h6>
					 <dl class="row" style="max-height:350px;overflow-y:scroll">
						<?php
						$shores = $pdo->query($shoqry);
						while($shorow=$shores->fetch_assoc()){
							$shid = $shorow["shop_id"];
							$shqry="SELECT * FROM shop WHERE shop_id = '$shid' GROUP BY shop_id";
							$shres=$pdo->query($shqry);
							while($shrow=$shres->fetch_assoc()){
								$avgqr = "SELECT AVG(rating), AVG(no_of_reviews) FROM products WHERE shop_id=".$shrow["shop_id"];
								$avgres=$pdo->query($avgqr);
								$avgrow=$avgres->fetch_assoc();
								$logo = (!empty($shrow["logo"])) ? 'logos/'.$shrow['logo'] : 'img/default1.jpg';
								?>
								
								  <dt class="col-sm-4"><img src="<?php echo $logo;?>" class="img-fluid" style="max-width:50px;max-height:50px" alt="<?php echo $shrow["name"];?>"></dt>
								  <dd class="col-sm-8 text-sm">
								  <a class="text-secondary" href="shop.php?shop=<?php echo $shrow["shop_id"];?>"> <?php echo $shrow["name"];?>
									<div style="font-size:11px" class="text-orange ">
										<?php rating($avgrow["AVG(rating)"], $avgrow["AVG(no_of_reviews)"]);?>	
									</div>
									</a>
									<hr>
								  </dd>			
		
								<?php
							}
						}
							
						?>
						</dl>
					
					 
					</div>
				  </div>
				  <div class="col-md-12 col-lg-8 m-auto">
					<div class="tab-content" id="vert-tabs-tabContent">
					  <div class="" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
						 <div class="row justify-content-start">
							<?php 
								$res = $pdo->query($qry);
								if($res->num_rows == 0){
									
								}else{
									while($row=$res->fetch_assoc()){
										$pid = $row["product_id"];
										$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
										$imgres = $pdo->query($imgqry);
										if($imgres->num_rows == 0){
											continue;
										}else{
										$imgrow = $imgres->fetch_assoc();
							?>
									  <div class="col-xl-3 col-md-4 col-sm-4 col-6 shadow-sm zoom product-cover">
										<a href="product.php?product=<?php echo $row["product_id"];?>" data-toggle="tooltip" title="<?php echo $row["name"]; ?>">
										  <img src="products/<?php echo $imgrow["name"];?>" class="img-fluid mb-2" alt="<?php echo $row["name"];?>"/>
										  <div class="row text-dark">
											<div style="font-size:14px" class="col-12 displayname text-secondary"><?php echo $row["name"];?></div>
											<div class="col-6"><h6>Ksh <?php echo $row["price"];?></h6></div>
											<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
											 <?php rating($row["rating"], $row["no_of_reviews"]);?>
											</div>
										  </div>
										</a>
									  </div>
									<?php } } }?>
					</div>
					  </div>
					</div>
				  </div>
            </div>
			<nav style="padding-top:20px" aria-label="Page navigation example">
			  <ul class="pagination pagination-circle justify-content-end">
				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				  </a>
				</li>
				<li class="page-item active"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item"><a class="page-link" href="#">4</a></li>
				<li class="page-item"><a class="page-link" href="#">5</a></li>
				<li class="page-item"><a class="page-link" href="#">6</a></li>
				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				  </a>
				</li>
			  </ul>
			</nav>
              </div>
			<?php } ?>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->	
	   
	  
			  
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
</body>
</html>