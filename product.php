<?php 
	session_start();	
	require "includes/connect.php";
	require "processes/sokofunctions.php";
	
	if(!isset($_GET["product"])){
		echo '<script>location.replace("index.php");</script>';	
	}
	
	$pid = mysqli_real_escape_string($pdo, $_GET["product"]);
	$qry = "SELECT * FROM products WHERE product_id = '$pid' AND status='0'";
	$res=$pdo->query($qry);
	if($res->num_rows == 0){
		echo '<script>location.replace("index.php");</script>';	
	}
	
	$row = $res->fetch_assoc();
	$shid = mysqli_real_escape_string($pdo, $row["shop_id"]);
	$shqry = "SELECT * FROM shop WHERE shop_id = '$shid'";
	$shres=$pdo->query($shqry);
	if($shres->num_rows == 0){
		echo '<script>location.replace("index.php");</script>';	
	}
	$shrow = $shres->fetch_assoc();
	$logo = (!empty($shrow["logo"])) ? 'logos/'.$shrow['logo'] : 'img/default1.jpg';
	$avgqr = "SELECT AVG(rating), AVG(no_of_reviews) FROM products WHERE shop_id=".$row["shop_id"];
	$avgres=$pdo->query($avgqr);
	$avgrow=$avgres->fetch_assoc();
	if($avgrow["AVG(no_of_reviews)"] == 0){
		$rating = "N/A";
	}else{
		$rating = round($avgrow["AVG(rating)"]/$avgrow["AVG(no_of_reviews)"])."/5";
	}
	$shopcatres = $pdo->query("SELECT * FROM category WHERE category_id=".$shrow["category_id"]);
	$shopcatrow = $shopcatres->fetch_assoc();
	
	
	
	$headtitle = $row["name"] .' - '. $shrow["name"] . ' | I-Soko';
	$headtitle = ucwords($headtitle);
	$headdesc = $row["name"] .' by '. $shrow["name"];
	$headkeywords = "";
	
	$cat = $row["category_id"];
	$scat = $row["subcategory_id"];
	$sscat = $row["subsubcategory_id"];
	$cccat = $row["custom_category_id"];
	
	$cres = $pdo->query("SELECT * FROM `product-category` WHERE pcategory_id='$cat'");
	$crow=$cres->fetch_assoc();
	$scres = $pdo->query("SELECT * FROM `product-sub-category` WHERE psubcategory_id='$scat'");
	$scrow=$scres->fetch_assoc();
	$sscres = $pdo->query("SELECT * FROM `product-subsub-category` WHERE psubsubcategory_id='$sscat'");
	$sscrow=$sscres->fetch_assoc();
	$ccres = $pdo->query("SELECT * FROM custom_category WHERE category_id='$cccat'");
	$ccrow=$ccres->fetch_assoc();
	
	$headkeywords .= $sscrow["category_name"]. ", ". $scrow["category_name"]. ", ". $crow["category_name"]. ", ". $ccrow["category_name"]. ", ";
	$headkeywords .= $sscrow["description"]. ", ". $scrow["description"]. ", ". $crow["description"]. ", I-Soko , online shop, seller, product";
	date_default_timezone_set("Africa/Nairobi");
	$ddate = date("Y-m-d H:i:s");	
	
	$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type='2'";
	$imgres = $pdo->query($imgqry);
	
	$featimgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type='1'";
	$featimgres = $pdo->query($featimgqry);
	
	$commres = $pdo->query("SELECT * FROM comments WHERE product_id='$pid'");
	$relatedres = $pdo->query("SELECT * FROM products WHERE subcategory_id='$scat' AND status='0' ORDER BY no_of_reviews DESC LIMIT 6");
	
	$prores = $pdo->query("SELECT * FROM products WHERE shop_id=$shid and status='0'");
	$ores = $pdo->query("SELECT * FROM orders WHERE seller_id=$shid");
	$followres = $pdo->query("SELECT * FROM followers WHERE shop_id='$shid'");
	
	$shopprores = $pdo->query("SELECT * FROM products WHERE shop_id='$shid' AND status='0' ORDER BY view_counter DESC LIMIT 4");
	
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->
  <?php 
  $addtocartstatus = 0;
  if($row["quantity"] == 0){
	  $addtocartstatus = 1;
	echo '<div class="note-danger text-center">
  <p><strong>Sorry!</strong> This Item is out of stock</p>
</div>';
  }elseif($shrow["status"] > 0){
	  $addtocartstatus = 1;
	echo '<div class="note-danger text-center">
  <p><strong>Sorry!</strong> Seller of this item is currently not recieving orders. <a href=""><u>Learn more.</u></a></p>
</div>';
  }
  ?>
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-0">
          <div class="col-12" >
			<div id="cart-plussms">
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-md-6">
              <h3 class="d-inline-block d-sm-none text-capitalize" style="font-size:5vw;"><?php echo $row["name"];?></h3>
              <div class="col-12">
			  <?php 
				$featimgrow = $featimgres->fetch_assoc();
				$featprodimg = "products/".$featimgrow["name"];
			  ?>
                <img src="<?php echo $featprodimg;?>" class="product-image img-fluid" alt="<?php echo $row["name"];?>">
				
              </div>
              <div class="col-12 product-image-thumbs">
                <div class="product-image-thumb border-0 active"><img src="<?php echo $featprodimg;?>" alt="<?php echo $row["name"];?>"></div>
				<?php 
					while($imgrow = $imgres->fetch_assoc()){
					$prodimg = "products/".$imgrow["name"];
				?>
                <div class="product-image-thumb border-0"><img src="<?php echo $prodimg;?>" alt="<?php echo $row["name"];?>"></div>
				<?php } ?>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <h4 class="my-3 text-capitalize  d-none d-sm-block"><?php echo $row["name"];?></h4>
              <h5 class="my-3 d-inline-block d-sm-none text-capitalize text-muted" style="font-size:4vw;"><?php echo $row["name"];?></h5>
			  <div class="row">
			    <div class="col-12">
					<h6>Seller Information</h6>
					<div class="info-box">
					  <span class="info-box-icon image"><img src="<?php echo $logo;?>" class="elevation-0" alt="<?php echo $shrow["name"];?>"></span>

					  <div class="info-box-content">
						<span class="info-box-text text-capitalize"><?php echo $shrow["name"];?></span>
						<span class="info-box-text"><small class="">Avg. Rating: <span class="text-orange"><?php echo $rating;?></span></small></span>
						<span class="info-box-number">
						<a href="shop.php?shop=<?php echo $shid;?>" class="btn btn-xs btn-outline-dark text-orange text-bold">Visit Shop</a>
						</span>
					  </div>
					  <!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
			    </div>
			  </div>
              <hr>
              <dl class="row">
                  <dt class="col-sm-3">Rating: </dt>
                  <dd class="col-sm-9">
					<span style="font-size:11px;" class="text-orange">
						<?php rating($row["rating"], $row["no_of_reviews"]);?>
					</span>	
						<small> <a href="#product-comments-tab"> (<?php echo $row["no_of_reviews"];?> reviews)</a></small>
				  </dd>
                  <dt class="col-sm-3">Delivery in:</dt>
                  <dd class="col-sm-9"><span class="badge badge-info">2-4 Business Days </span></dd>
                  <dt class="col-sm-3">Delivery:</dt>
                  <dd class="col-sm-9">
				  <span class="badge badge-success">Free within Nairobi</span>
				  <span class="badge badge-warning">Additional fee to other places</span>
				  </dd>
                  <dt class="col-sm-3">Return:</dt>
                  <dd class="col-sm-9"><span class="badge badge-danger">No return </span></dd>
				  <dt class="col-12"><a href="shop.php" class="float-right btn btn-sm btn-light">View shop policies</a></dt>
                </dl>

              <div class="bg-light  py-2 px-3 mt-4">
                <h4 class="mb-0">
                  Price
                </h4>
                <h4 class="mt-0">
                  <small class="text-bold">Ksh <?php echo number_format($row["price"]);?></small>
                </h4>
              </div>
				<?php 
				if($addtocartstatus == 0){
				?>
              <div class="mt-4">
                <button type="button" id="<?php echo $pid;?>" class="btn bg-orange btn-lg btn-block cartplus">
                  <i class="fas fa-cart-plus fa-lg mr-2"></i>
                  Add to Cart
                </button>
              </div>
				<?php } else{?>
					<div class="mt-4">
						<a href="" class="btn bg-orange btn-lg btn-block disabled">
						  <i class="fas fa-cart-plus fa-lg mr-2"></i>
							Add to Cart
						</a>
						<?php 
							 if($row["quantity"] == 0){
								echo '<div class="text-sm text-danger"> This item is out of Stock</div>';
							  }elseif($shrow["status"] > 0){
								echo '<div class="text-sm text-danger"> This seller is currently not accepting orders</div>';
							  }
						?>
					  </div>
			  <?php }?>
				
			 <input type="text" value="<?php echo $url;?>" id="myInput" required class="sr-only" />
              <div class="mt-4 product-share">
				 <h6>Share this product</h6>
                <a data-toggle="tooltip" title="Facebook" class="text-primary" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url;?>" target="_blank">
                  <i class="fab fa-facebook-square fa-2x"></i>
                </a>
				<a href="https://twitter.com/share?ref_src=twsrc%5Etfw" target="_blank" data-toggle="tooltip" title="Twitter" class="twitter-share-button" data-show-count="false"> <i class="fab fa-twitter-square fa-2x"></i></a>
                <a data-toggle="tooltip" title="Whatsapp" class="text-success" href="whatsapp://send?text=<?php echo $url;?>" data-action="share/whatsapp/share">
                  <i class="fab fa-whatsapp-square fa-2x"></i>
                </a>
				<a data-toggle="tooltip" title="Copy Product Link" onclick="myFunction()">
                  <i class="fa fa-link fa-2x text-secondary"></i>
                </a>
              </div>

            </div>
          </div>
          <div class="row mt-4">
            <nav class="w-100">
              <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active text-orange" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
                <a class="nav-item nav-link text-orange" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Reviews (<?php echo $commres->num_rows;?>)</a>
              </div>
            </nav>
            <div class="tab-content p-3" id="nav-tabContent">
              <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab"> <?php echo $row["description"];?></div>
              <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab"> 
			  
						<?php 
					if($commres->num_rows == 0){
						echo '
							<div class="m-auto" style="width:100%">
							 <div align="center" style="padding-top:30px" class="ml-auto">
							 <p class="text-bold">Sorry !</p>
							 <span style="font-size:100px;">&#128542;</span>
							 <p>This product has no Reviews.</p>
							 <p><a href="#review" class="btn btn-link"><span class="text-bold text-orange">Be the first to Review this product?</span></a></p>
							 </div>
						</div>
						';
					}else{
						while($commrow=$commres->fetch_assoc()){
							
				  ?>
					<div class="product-cover">
						  <div class="row">
							<div class="col-12">
								<span class="fa fa-user"></span> <?php echo $commrow["name"];?>
								<small class="text-secondary"><i class="fa fa-ock "></i> <?php echo date('d M Y / g:i A', strtotime($commrow["date"]));?></small>
							</div>
							<div class="col-12">
								<span style="font-size:10px;" class="text-orange">
									<?php rating($commrow["rating"], 1);?>
								</span>
							</div>
						  </div>
						  <p><?php echo $commrow["comment"];?></p>
						  <hr>
					</div>
					<?php } }?>
				
					
		          <a href="#" class="btn btn-light btn-sm card-link">Review This Product</a>
			  </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
		
		<!-- Related Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-orange card-outline">
              <div class="card-header">
                <h4 class="card-title">Related Items</h4>
				<small class="float-right"><a href="subcategory.php?sb=<?php echo $scat;?>">See More &gt; </a></small>
              </div>
              <div class="card-body">
                <div class="row">
				  <?php
				  while($prodshowrow = $relatedres->fetch_assoc()){
					$pid = $prodshowrow["product_id"];
					$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
					$imgres = $pdo->query($imgqry);
					if($imgres->num_rows == 0){
						$prodimg = "img/default.jpg";
					}else{
						$imgrow = $imgres->fetch_assoc();
						$prodimg = "products/".$imgrow["name"];
					}
					
							?>
							  <div class="col-xl-2 col-md-3 col-sm-4  col-6 shadow-sm zoom product-cover">
								<a href="product.php?product=<?php echo $prodshowrow["product_id"];?>" data-toggle="tooltip" title="<?php echo $prodshowrow["name"]; ?>">
								  <img src="<?php echo $prodimg;?>" class="img-fluid mb-2" alt="<?php echo $prodshowrow["name"];?>"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 displayname text-secondary"><?php echo $prodshowrow["name"];?></div>
									<div class="col-6"><h6">Ksh <?php echo $prodshowrow["price"];?></h6></div>
									<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
									<?php rating($prodshowrow["rating"], $prodshowrow["no_of_reviews"]);?>
									</div>
								  </div>
								</a>
							  </div>
								<?php } ?>
								  
				 </div>
              </div>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
	  
	  <!-- More Items From this seller-->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-solid ">
              <div class="card-header">
                <h4 class="card-title">More From This Seller</h4>
				<small class="float-right"><a href="shop.php?shop=<?php echo $shid;?>">Visit Store &gt; </a></small>
              </div>
              <div class="card-body">
                <div class="row border border-warning bg-light">
				
				<div class="col-xl-3 col-md-12 col-sm-12  col-12 border">
                    <!-- Widget: user widget style 1 -->
            <div class="widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-light">
                <h3 class="widget-user-username"><?php echo $shrow["name"];?></h3>
                <h5 class="widget-user-desc text-md text-secondary"><?php echo $shopcatrow["category"];?> Store</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2 bg-white" src="<?php echo $logo;?>" alt="<?php echo $shrow["name"];?>">
              </div>
              <div class="card-footer bg-white">
                <div class="row">
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo number_format($ores->num_rows);?></h5>
                      <span class="description-text">SALES</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo number_format($prores->num_rows);?></h5>
                      <span class="description-text">PRODUCTS</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-4 ">
                    <div class="description-block">
                      <h5 class="description-header"><?php echo number_format($followres->num_rows);?></h5>
                      <span class="description-text">FOLLOWERs</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
				<div class="text-center mt-4">
				<a href="shop.php?shop=<?php echo $shid;?>" class="btn btn-dark btn-sm">Visit Shop &gt;&gt;</a>
				</div>
              </div>
            </div>
            <!-- /.widget-user -->
                  </div>
					<?php
				  while($shopprorow = $shopprores->fetch_assoc()){
					$shpid = $shopprorow["product_id"];
					$imgqry = "SELECT * FROM product_photos WHERE product_id='$shpid' AND type = '1'";
					$imgres = $pdo->query($imgqry);
					if($imgres->num_rows == 0){
						$prodimg = "img/default.jpg";
					}else{
						$imgrow = $imgres->fetch_assoc();
						$prodimg = "products/".$imgrow["name"];
					}
					
							?>
							  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
								<a href="product.php?product=<?php echo $shopprorow["product_id"];?>" data-toggle="tooltip" title="<?php echo $shopprorow["name"]; ?>">
								  <img src="<?php echo $prodimg;?>" class="img-fluid mb-2" alt="<?php echo $shopprorow["name"];?>"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 displayname text-secondary"><?php echo $shopprorow["name"];?></div>
									<div class="col-6"><h6">Ksh <?php echo $shopprorow["price"];?></h6></div>
									<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
									<?php rating($shopprorow["rating"], $shopprorow["no_of_reviews"]);?>
									</div>
								  </div>
								</a>
							  </div>
								<?php } ?>
								
								
				 </div>
              </div>
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
<?php 
	if(isset($_SESSION["sokoid"])){
		$uid = $_SESSION["sokoid"];
	}else{
		$uid = "0";
	}
	$views = "INSERT INTO product_views (user_id, product_id, date) VALUES ('$uid', '$pid', '$ddate')";
	$pdo->query($views);
	$viewsp = "UPDATE products SET view_counter=view_counter+1 WHERE product_id='$pid'";
	$pdo->query($viewsp);
?>

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
 <script>  
 $(document).ready(function(){  
      $('.cartplus').click(function(){  
           var cartplus = $(this).attr("id");
           $.ajax({  
                url:"processes/cartprocesses.php",  
                method:"POST",  
                data:{cartplus:cartplus},  
                success:function(data){  
                     $('#cart-plussms').html(data);   
                }  
           });    
      });  
 });  
 </script>

 <script>  
 function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
   toastr.info("Product Link Copied.");
}
 </script>

 
</body>
</html>