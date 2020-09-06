<?php
	session_start();	
	require "includes/connect.php";
	
	if(!isset($_GET["shop"])){
		echo '<script>location.replace("index.php");</script>';	
	}
	
	$shid = mysqli_real_escape_string($pdo, $_GET["shop"]);
	$qry = "SELECT * FROM shop WHERE shop_id = '$shid'";
	$res=$pdo->query($qry);
	if($res->num_rows == 0){
		echo '<script>location.replace("index.php");</script>';	
	}
	
	$headtitle = "";
	$headdesc = "";
	$headkeywords = "Online Shop, I-Soko Shop , Seller of ";
	$row = $res->fetch_assoc();
	$ccres = $pdo->query("SELECT * FROM custom_category WHERE shop_id='$shid'");
	while($ccrow=$ccres->fetch_assoc()){
		$headkeywords .= $ccrow["category_name"].", ";
	}
	
	require "processes/sokofunctions.php";
	$headtitle = $row["name"] . " - Online Shop | I-Soko";
	$headdesc = $row["slogan"];
	$logo = (!empty($row["logo"])) ? 'logos/'.$row['logo'] : 'img/default1.jpg';
	
	if(isset($_SESSION["sokoid"])){
		$user_id = mysqli_real_escape_string($pdo, $_SESSION["sokoid"]);
		$follres = $pdo->query("SELECT * FROM followers WHERE shop_id='$shid' AND user_id='$user_id'");
	}
	
	$catres = $pdo->query("SELECT * FROM category WHERE category_id=".$row["category_id"]);
	$catrow = $catres->fetch_assoc();
	
	$prores = $pdo->query("SELECT * FROM products WHERE shop_id=$shid AND status='0'");
	$ores = $pdo->query("SELECT * FROM orders WHERE seller_id=$shid");
	$followres = $pdo->query("SELECT * FROM followers WHERE shop_id='$shid'");
	
	$username = "";
	if(isset($_SESSION["sokofirstname"])){
		$username = $_SESSION["sokofirstname"];
	}
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->

  
  <!--Shop Navbar -->
  <nav class="navbar navbar-expand-md navbar-light fixed-top bg-white shadow-sm" id="navbar">
      <a class="navbar-brand" href="#">
		<img src="<?php echo $logo;?>" alt="<?php echo $row["name"];?>" class="img-fluid brand-image" style="max-height:50px;max-width:70px">
	  </a>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#products">Products </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#policies">Shop Policies</a>
          </li>
        </ul>
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
		  <li class="nav-item">
		  <?php if(isset($_SESSION["sokoid"])){?>
		  <?php if ($follres->num_rows == 0){?>
				<a href="processes/followprocesses.php?follow=<?php echo $shid;?>" class="btn btn-sm btn-outline-white my-2 mr-2 my-sm-0"><span class="text-orange"><i class="fas fa-paper-plane"></i> Follow</span></a>
		  <?php }elseif($follres->num_rows == 1){ ?>
				<a href="processes/followprocesses.php?unfollow=<?php echo $shid;?>" class="btn btn-sm btn-outline-white my-2 mr-2 my-sm-0"><span class="text-orange"><i class="fas fa-paper-plane"></i> Following...</span></a>
		  <?php }?>
		  <?php }else{ ?>
			<a href="login.php?return=shop.php?shop=<?php echo $shid;?>" class="btn btn-sm btn-outline-white my-2 mr-2 my-sm-0 clickreport"><span class="text-orange"><i class="fas fa-paper-plane"></i> Follow</span></a>
		  <?php } ?>
		  </li>
		  </ul>
		 </div>
		 <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
		 <li class="nav-item d-md-none">
		 <?php if(isset($_SESSION["sokoid"])){?>
			<?php if ($follres->num_rows == 0){?>
				<a class="nav-link" href="processes/followprocesses.php?follow=<?php echo $shid;?>" data-toggle="tooltip" title="Follow"><i class="fas fa-paper-plane text-orange text-lg"></i></a>
		    <?php }elseif($follres->num_rows == 1){ ?>
				<a class="nav-link" href="processes/followprocesses.php?unfollow=<?php echo $shid;?>" data-toggle="tooltip" title="Following..."><i class="fas fa-paper-plane text-orange text-lg"></i></a>
		    <?php }?>
		 <?php }else{ ?>
			<a class="nav-link clickreport" href="login.php?return=shop.php?shop=<?php echo $shid;?>" data-toggle="tooltip" title="Follow"><i class="fas fa-paper-plane text-orange text-lg"></i></a>
		  <?php } ?>
        </li>
		<li class="nav-item">
          <a href="mailing.php" class="btn btn-sm bg-orange my-2 mr-2 my-sm-0" type="submit"><span class="text-white"><i class="fas fa-comments"></i> Chat with Seller</span></a>
        </li>
		  </ul>
     
    </nav>
   <!-- /.shop navbar -->
    <?php 
  if($row["status"] > 0){
	echo '<div class="note-danger text-center">
	  <p><strong>Sorry!</strong> This seller is currently not recieving orders. <a href=""><u>Learn more.</u></a></p>
	</div>';
  }
  ?>
   
   
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
		<?php 
		date_default_timezone_set("Africa/Nairobi");
	    $now = date("Y-m-d");
		$annres = $pdo->query("SELECT * FROM shop_announcement WHERE shop_id='$shid' AND date_until>'$now'");
		?>
	  <?php if($annres->num_rows){
		  $annrow = $annres->fetch_assoc();
		  ?>
        <div class="row mb-2">
          <div class="col-12">
			<div class="card card-outline card-orange">
              <div class="card-header">
                <h6 style="font-size:16px" class="card-title">Announcement!</h6>
                <div class="card-tools">
                  <button type="button" class="btn btn-xs btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body" style="font-size:13px">
                <?php echo $annrow["announcement"];?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
	  <?php } ?>
		<!-- Carousel & Shop Info -->
		<div class="row">
          <div class="col-lg-8">
		  <?php 
			$carores = $pdo->query("SELECT * FROM shop_carousel WHERE shop_id='$shid' LIMIT 3");
			if($carores->num_rows == 0){
		  ?>
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" ></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block img-fluid w-100" src="https://placehold.it/500x230/f39c12/ffffff&text=<?php echo $row["name"];?>" alt="<?php echo $row["name"];?>">
                    </div>
					<div class="carousel-item">
                      <img class="d-block img-fluid w-100" src="https://placehold.it/500x230/c9c6c5/ffffff&text=<?php echo $catrow["category"] . " Store";?>" alt="<?php echo $row["name"];?>">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
			<?php }else{?>
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <?php for($i=1;$i<$carores->num_rows; $i++){?>
						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>"></li>
					<?php } ?>
                  </ol>
                  <div class="carousel-inner">
						<?php 
							$active = 0;
							while($carorow = $carores->fetch_assoc()){
						?>
						<div class="carousel-item <?php if($active == 0){ echo "active";}?>">
						  <img class="img-fluid d-block w-100" src="carousels/<?php echo $carorow["name"];?>" alt="<?php echo $row["name"];?>">
						</div>
							<?php $active++; } ?>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
			<?php } ?>
				<hr class="d-lg-none">
          </div>
          <!-- /.col-md-8 -->
		  
		  
		  <div class="col-lg-4 text-center bg-white product-cover">
						  <img src="<?php echo $logo;?>" class="img-fluid mb-2" style="max-height:180px;max-width:200px" alt="<?php echo $row["name"];?>"/>
						  <div class="row ">
							<div style="font-size:20px" class="col-12 text-dark text-capitalize"><?php echo $row["name"];?></div>
							<div style="font-size:15px" class="col-12 text-muted"><?php echo $catrow["category"];?> Store</div>
						  </div>
						  <div class="row">
							  <div class="col-4 border-right">
								<div class="description-block">
								  <h5 class="description-header"><?php echo number_format($ores->num_rows);?></h5>
								  <span class="description-text">SALES</span>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-4 border-right">
								<div class="description-block">
								  <h5 class="description-header"><?php echo number_format($followres->num_rows);?></h5>
								  <span class="description-text">FOLLOWERS</span>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-4">
								<div class="description-block">
								  <h5 class="description-header"><?php echo number_format($prores->num_rows);?></h5>
								  <span class="description-text">PRODUCTS</span>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-6 border-right">
								<div class="description-block">									  
									  <?php if(isset($_SESSION["sokoid"])){?>
									  <?php if ($follres->num_rows == 0){?>
											<a href="processes/followprocesses.php?follow=<?php echo $shid;?>" class="btn btn-sm btn-outline-dark"><i class="fa fa-paper-plane"></i> Follow</a>
									  <?php }elseif($follres->num_rows == 1){ ?>
											<a href="processes/followprocesses.php?unfollow=<?php echo $shid;?>" class="btn btn-sm btn-outline-dark"><i class="fa fa-paper-plane"></i> Following...</a>
									  <?php }?>
									  <?php }else{ ?>
											<a href="login.php?return=shop.php?shop=<?php echo $shid;?>" class="btn btn-sm btn-outline-dark clickreport"><i class="fa fa-paper-plane"></i> Follow</a>
									  <?php } ?>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-6 " id="products">
								<div class="description-block">
								  <a href="mailing.php" class="btn btn-sm btn-outline-dark"><i class="fa fa-envelope"></i> Conctact</a>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							</div>
							<!-- /.row -->
						<hr>
					</div>
					</div>
		            <!-- /.row -->
		
		
		
		 <!-- Shop Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-solid">
              <div class="card-body">
						<h4><b>Items</b></h4>
				<div class="row">
					<div class="col-3 d-none d-lg-block">
					</div>
					<div class="col-12 col-lg-5">
						<div class="input-group input-group-md">
						  <input type="text" placeholder="Search Items in this shop" class="border border-dark border-right-0 form-control shopsearch">
						  <span class="input-group-append">
							<button type="button" class="btn btn-white border border-dark border-left-0"><i class="fas fa-search"></i></button>
						  </span>
						</div>
						<!-- /input-group -->
					</div>
					<div class="col-12 d-lg-none product-cover"> 
					  <div class="form-group">
                        <select class="form-control bg-dark border border-dark custcatsm">
                          <option class="bg-white" value="0">All Items</option>
                          <option class="bg-white" value="1">Top Selling Items</option>
						  <?php
							$ccres = $pdo->query("SELECT * FROM custom_category WHERE shop_id='$shid'");
							while($ccrow=$ccres->fetch_assoc()){
						  ?>
                          <option class="bg-white text-capitalize" value="<?php echo $ccrow["category_id"];?>"><?php echo $ccrow["category_name"];?></option>
						  <?php } ?>
                        </select>
                       </div>
					</div>
					<div class="col-12 col-lg-4 product-cover">
						<div class="btn-group float-right ">
						  <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sort By: <span id="displaybtn">Relevance</span>
						  </button>
						  <div class="dropdown-menu dropdown-menu-right">
							<button class="dropdown-item sort" id="1" type="button">Relevance</button>
							<button class="dropdown-item sort" id="2" type="button">Popularity</button>
							<button class="dropdown-item sort" id="3"type="button">Newest Arrival </button>
							<button class="dropdown-item sort" id="4" type="button">Highest Price </button>
							<button class="dropdown-item sort" id="5" type="button">Lowest Price </button>
							<button class="dropdown-item sort" id="6" type="button">Highest Rated </button>
						  </div>
						</div>
					</div>
				</div>
                <div class="row product-cover">
				  <div class="col-3 d-none d-lg-block">
					<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
					  <a class="nav-link text-dark custcat" id="0" data-toggle="pill" href="#products" role="tab"  aria-selected="true">All Items <span class="badge badge-dark float-right"><?php echo $prores->num_rows;?></span></a>
					  <a class="nav-link text-dark custcat" id="1" data-toggle="pill" href="#products" role="tab" aria-selected="true">Top Selling Items </a>
					  <?php
							$ccres = $pdo->query("SELECT * FROM custom_category WHERE shop_id='$shid'");
							while($ccrow=$ccres->fetch_assoc()){
								$prodcountres = $pdo->query("SELECT * FROM products WHERE custom_category_id=".$ccrow["category_id"]." AND status='0'");
						  ?>
					  <a class="nav-link text-dark custcat" id="<?php echo $ccrow["category_id"];?>" data-toggle="pill" href="#products" role="tab" aria-selected="false"><?php echo $ccrow["category_name"];?> <span class="badge badge-dark float-right"><?php echo $prodcountres->num_rows;?></span></a>
					   <?php } ?>
					</div>
				  </div>
				  <div class="col-md-12 col-lg-9">
					<div class="tab-content" id="vert-tabs-tabContent">
					  <div class="tab-pane text-left fade show active" id="all" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
						 <div class="row" id="itemsbycat">
							<?php 
								$prodshowres = $pdo->query("SELECT * FROM products WHERE shop_id='$shid' AND status='0'");
								if($prodshowres->num_rows == 0){
									echo '
										<div class="col-12">
										 <div align="center" style="padding-top:30px" class="mr-auto">
										 <p class="text-bold">Sorry '.$username.'!</p>
										 <span style="font-size:100px;">&#128542;</span>
										 <p>No Products In This Shop.</p>
										 <p><a href="shops.php?shopcat='.$catrow["category_id"].'" class="btn btn-link"><span class="text-bold text-orange">See Other Shops in this Category!</span></a></p>
										 </div>
									</div>
									';
								}else{
								while($prodshowrow = $prodshowres->fetch_assoc()){
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
							  <div class="col-xl-3 col-md-4 col-sm-4 col-6 shadow-sm zoom product-cover">
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
								<?php } }?>
					</div>
					  </div>
					</div>
				  </div>
            </div>
              </div>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
		
		 <!-- Report Seller and Contact seller -->
		<div class="row product-cover">
          <div class="col-12">
            <div class="card card-solid">
              <div class="card-body">
				<div class="row">
					<div class="col-md-6">
					</div>
					<div class="col-sm product-cover">
						<span class="float-sm-right"><a href="mailing.php" class="btn btn-outline-dark"><i class="fa fa-envelope"></i> Contact this seller!</a></span>
					</div>
					<div class="col-sm product-cover" id="about">
						<span class="float-sm-right">
						 <?php if(isset($_SESSION["sokoid"])){?>
						<button class="btn btn-outline-dark" data-toggle="modal" data-target="#modal-report"><i class="fa fa-times-circle"></i> Report this seller to I-Soko!</button>
						 <?php }else{ ?>
						 <a href="login.php?return=shop.php?shop=<?php echo $shid;?>" class="btn btn-outline-dark clickreport" ><i class="fa fa-times-circle"></i> Report this seller to I-Soko!</a>
						  <?php } ?>
						</span>
					</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
        <!-- /.row -->
		
		
		
		 <!-- Shop details -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-danger">
              <div class="card-body">
                <div class="row">
					<div class="col-lg-4 text-center">
						  <img src="<?php echo $logo;?>" class="img-fluid mb-2" style="max-height:180px;max-width:200px" alt="<?php echo $row["name"];?>"/>
						  <div class="row ">
							<div style="font-size:20px" class="col-12 text-dark text-capitalize"><?php echo $row["name"];?></div>
						  </div>
						  <div class="row">
							  <div class="col-4 border-right">
								<div class="description-block">
								  <h5 class="description-header"><?php echo number_format($ores->num_rows);?></h5>
								  <span class="description-text">SALES</span>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-4 border-right">
								<div class="description-block">
								  <h5 class="description-header"><?php echo number_format($followres->num_rows);?></h5>
								  <span class="description-text">FOLLOWERS</span>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-4">
								<div class="description-block">
								  <h5 class="description-header"><?php echo number_format($prores->num_rows);?></h5>
								  <span class="description-text">PRODUCTS</span>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-6 border-right">
								<div class="description-block">									  
									  <?php if(isset($_SESSION["sokoid"])){?>
									  <?php if ($follres->num_rows == 0){?>
											<a href="processes/followprocesses.php?follow=<?php echo $shid;?>" class="btn btn-sm btn-outline-dark"><i class="fa fa-paper-plane"></i> Follow</a>
									  <?php }elseif($follres->num_rows == 1){ ?>
											<a href="processes/followprocesses.php?unfollow=<?php echo $shid;?>" class="btn btn-sm btn-outline-dark"><i class="fa fa-paper-plane"></i> Following...</a>
									  <?php }?>
									  <?php }else{ ?>
											<a href="login.php?return=shop.php?shop=<?php echo $shid;?>" class="btn btn-sm btn-outline-dark clickreport"><i class="fa fa-paper-plane"></i> Follow</a>
									  <?php } ?>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							  <div class="col-6">
								<div class="description-block">
								  <a href="mailing.php" class="btn btn-sm btn-outline-dark"><i class="fa fa-envelope"></i> Conctact</a>
								</div>
								<!-- /.description-block -->
							  </div>
							  <!-- /.col -->
							</div>
							<!-- /.row -->
							
					<hr>
					</div>
					<div class="col-lg-8 border-lg">
						
						  <h5 class="text-center product-cover"><b>About Shop</b></h5>
						<dl class="row">
						  <dd class="col-md-12" id="policies"><?php echo $row["slogan"];?>
						  </dd>
						</dl>
						  <h5 class="text-center product-cover"><b>Shop Policy</b></h5>
						<dl class="row">
						  <dt class="col-md-2">Delivery time</dt>
						  <dd class="col-md-9">Deliveries are made within 2 Business Days within Nairobi and upto 6 Business Days to upcountry. </dd>
						  <dt class="col-md-2">Delivery Cost</dt>
						  <dd class="col-md-9">Delivery is free within Nairobi CBD. Fixed rate of Ksh 200, for places outside Nairobi.</dd>
						  <dt class="col-md-2">Pick-Up</dt>
						  <dd class="col-md-9">Orders can be picked directly at Nairobi/ Rahimtula 2nd Floor, Moi Avenue. Delivery Cost will not be charged.</dd>
						  <dt class="col-md-2">Returns</dt>
						  <dd class="col-md-9">Varries with Items. Check Product description for details. Returns are only accepted within 2days after purchase.</dd>
						</dl>
					</div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
		
		
		<!-- Shop Reviews -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-dark card-outline">
			  <div class="card-header">
                <h3 class="card-title"><b>Reviews</b></h3>
              </div>
              <div class="card-body">
                <p class="text-center">
				Average Rating  
				<span style="font-size:14px;padding-left:3px" class="text-orange">
				<?php
					$avgqr = "SELECT AVG(rating), AVG(no_of_reviews) FROM products WHERE shop_id='$shid'";
					$avgres=$pdo->query($avgqr);
					$avgrow=$avgres->fetch_assoc();
					if($avgrow["AVG(no_of_reviews)"] == 0){
						echo "N/A";
					}else{
						rating($avgrow["AVG(rating)"], $avgrow["AVG(no_of_reviews)"]);
					}
				
				?>
				</span>
				<small> from</small>
				(<?php echo $row["no_of_reviews"];?>) Reviews
				<hr>
				</p>
				<?php 
					$commqry = "SELECT * FROM comments";
					$commres = $pdo->query($commqry);
					while($commrow = $commres->fetch_assoc()){
						$pid = $commrow["product_id"];
						$prodcomres = $pdo->query("SELECT * FROM products WHERE product_id='$pid' AND status='0' AND shop_id='$shid'");
						if($prodcomres->num_rows == 0){
							continue;
						}else{
						$prodcomrow = $prodcomres->fetch_assoc();	
						$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
						$imgres = $pdo->query($imgqry);
						if($imgres->num_rows == 0){
							$prodimg = "img/default.jpg";
						}else{
							$imgrow = $imgres->fetch_assoc();
							$prodimg = "products/".$imgrow["name"];
						}	
									
				?>
				<div class="product-cover">
					  <div class="row">
						<div class="col-12">
							<span class="fa fa-user"></span> <?php echo $commrow["name"];?>
							<small class="text-secondary"><i class="fa fa-ock "></i><?php echo date('d M Y / g:i A', strtotime($commrow["date"]));?></small>
						</div>
						<div class="col-12">
							<span style="font-size:10px;" class="text-orange">
								<?php rating($commrow["rating"], 1);?>
							</span>
						</div>
						<div class="col-12">
							<p><?php echo $commrow["comment"];?></p>
						</div>
						<div class="col-xl-2 col-md-3 col-sm-4 col-6">
								<a href="product.php?product=<?php echo $commrow["product_id"];?>" >
								  <img src="<?php echo $prodimg;?>" class="img-fluid mb-2 border" style="height:150px" alt="<?php echo $prodcomrow["name"];?>"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 text-secondary"><?php echo $prodcomrow["name"];?></div>
								  </div>
								</a>
						</div>
					  </div>
					  
					  <hr>
				</div>	
					<?php }}?>
			  </div>
			</div>
		  </div>
		</div>
        <!-- /.row -->
		
		
		
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
		
	  
	  	
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- ./wrapper -->

<!-- MODALS -->

<div class="modal fade" id="modal-report">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Report This Seller</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="processes/reportseller.php" method="POST">
				  <div class="form-group">
                    <label for="exampleInputEmail1">What is your reason for reporting this seller?</label>
                    <textarea name="complaint" class="form-control" rows=5 placeholder="eg inappropriate images.." required> </textarea>
                    <input type="hidden" value="<?php echo $shid;?>" name="shop">
                  </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Report Shop" name="report_shop" class="btn btn-danger">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
<?php 
	if(isset($_SESSION["sokoid"])){
		$uid = $_SESSION["sokoid"];
	}else{
		$uid="0";
	}
	$views = "INSERT INTO shop_views (user_id, shop_id, date) VALUES ('$uid', '$shid', '$now')";
	$pdo->query($views);
	$viewsp = "UPDATE shop SET view_counter=view_counter+1 WHERE shop_id='$shid'";
	$pdo->query($viewsp);
?>

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
<script>
// When the user scrolls down 20px from the top of the document, slide down the navbar
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 230 || document.documentElement.scrollTop > 230) {
    document.getElementById("navbar").style.top = "0";
  } else {
    document.getElementById("navbar").style.top = "-50px";
  }
}
</script>
<script>  
 $(document).ready(function(){  
      $('.custcat').click(function(){  
           var custcat_id = $(this).attr("id");
		   var shid = <?php echo $shid;?>;
           $.ajax({  
                url:"processes/shopproducts.php",  
                method:"POST",  
                data:{custcat_id:custcat_id,shid:shid},  
                success:function(data){  
                     $('#itemsbycat').html(data);   
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.custcatsm').on("keyup input", function(){
           var custcat_id = $(this).val();
		   var shid = <?php echo $shid;?>;
           $.ajax({  
                url:"processes/shopproducts.php",  
                method:"POST",  
                data:{custcat_id:custcat_id,shid:shid}, 
                success:function(data){  
                     $('#itemsbycat').html(data);  
                }  
           });		   
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.shopsearch').on("keyup input", function(){
           var shopterm = $(this).val();
		   var shid = <?php echo $shid;?>;
           $.ajax({  
                url:"processes/shopproducts.php",  
                method:"POST",  
                data:{shopterm:shopterm,shid:shid}, 
                success:function(data){  
                     $('#itemsbycat').html(data);  
                }  
           });		   
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.sort').click(function(){  
           var sortby = $(this).attr("id");
		   var shid = <?php echo $shid;?>;
           $.ajax({  
                url:"processes/shopproducts.php",  
                method:"POST",  
                data:{sortby:sortby,shid:shid},  
                success:function(data){  
                     $('#itemsbycat').html(data);   
                }  
           });  
		   $.ajax({  
                url:"processes/shopproducts.php",  
                method:"POST",  
                data:{clicked:sortby,shid:shid},  
                success:function(data){  
                     $('#displaybtn').html(data);   
                }  
           });  
      });  
 });  
 </script>
  <script>  
 $(document).ready(function(){  
      $('.clickreport').click(function(){  
           sessionStorage.setItem("follerror", "Shop");   
      });  
 });  
 </script>
</body>
</html>
