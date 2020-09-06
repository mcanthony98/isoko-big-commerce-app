<?php
	session_start();	
	require "includes/connect.php";
	$headtitle = "I-Soko - The Online Shop with multiple sellers.";
	$headdesc = "Shop online from your best sellers and vendors all over Kenya. Mett your favourite sellers online.";
	$headkeywords = "I-Soko, isoko, online shop";
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

 <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
			<?php 
			 if(isset($_SESSION["sokoid"])){
			?>
            <h1 class="m-0 text-dark">  <small>Welcome, <?php echo $_SESSION["sokofirstname"];?>!</small></h1>
			 <?php } ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 d-none d-lg-block">
		  
            <div class="card card-outline card-orange">
              <div class="card-body">
                <h6 class="card-title">Shop By Category</h6>

                <p class="card-text ">
                 			
				 <dl class="row">
                  <dt class="col-sm-1"><i class="text-orange fas fa-tshirt"></i></dt>
                  <dd class="col-sm-11 ">Fashion</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-utensils"></i></dt>
                  <dd class="col-sm-11">Household and Kitchen</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-mobile-alt"></i></dt>
                  <dd class="col-sm-11">Phones and Accessories</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-blender"></i></dt>
                  <dd class="col-sm-11">Household Electronics</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-wrench"></i></dt>
                  <dd class="col-sm-11">Automotive and Parts</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-hamburger"></i></dt>
                  <dd class="col-sm-11">Foods and Drinks</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-baby"></i></dt>
                  <dd class="col-sm-11">Baby Products</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-spa"></i></dt>
                  <dd class="col-sm-11">Jewelery and Make Up</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-laptop"></i></dt>
                  <dd class="col-sm-11">Computers and Laptops</dd>
                  <dt class="col-sm-1"><i class="text-orange fas fa-dumbbell"></i></dt>
                  <dd class="col-sm-11">Sports</dd>
                </dl>
				</p>
                <a href="categories.php" class="card-link">All Categories</a>
				
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-8">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="img/banner06.jpg" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="img/banner07.jpg" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="https://placehold.it/500x230/f39c12/ffffff&text=I+Love+Maina" alt="Third slide">
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
            </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
		
        <!-- /Our Great Things -->
		<div class="row product-cover">
          <div class="col-md-3 col-sm-6  col-xs-6 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Messages</span>
                <span class="info-box-number">1,410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-6 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Bookmarks</span>
                <span class="info-box-number">410</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-6 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Uploads</span>
                <span class="info-box-number">13,648</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-6 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">93,139</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
		
        <!-- Featured Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h4 class="card-title">Featured Items</h4>
				<small class="float-right">See More > </small>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=6; $i++){?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star "></i>
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
		
		 <!-- Deals of the Week -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-danger">
              <div class="card-header">
                <h4 class="card-title">Deals of the Week</h4>
				<small class="float-right">See All > </small>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=6; $i++){?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star "></i>
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
		
		 <!-- Top Sellers  -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-fuchsia">
              <div class="card-header">
                <h4 class="card-title">Top Sellers</h4>
				<small class="float-right">See All > </small>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=4; $i++){?>
				  <div class="col-xl-1 col-md-2 col-sm-3  col-4 shadow-sm zoom product-cover">
                    <a href="shop.php" >
                      <img src="img/logo.png" class="img-fluid mb-2" alt="sample"/>
					  <div class="row ">
						<div style="font-size:14px" class="col-12 text-secondary">Llanna House Limited</div>
					  </div>
                    </a>
                  </div>
				  <div class="col-xl-1 col-md-2 col-sm-3  col-4 shadow-sm zoom product-cover">
                    <a href="shop.php" >
                      <img src="img/logoblack1.png" class="img-fluid mb-2" alt="sample"/>
					  <div class="row ">
						<div style="font-size:14px" class="col-12 text-secondary">Motor Arcade Limited</div>
					  </div>
                    </a>
                  </div>
				  <div class="col-xl-1 col-md-2 col-sm-3  col-4 shadow-sm zoom product-cover">
                    <a href="shop.php" >
                      <img src="img/logo2.PNG" class="img-fluid mb-2" alt="sample"/>
					  <div class="row ">
						<div style="font-size:14px" class="col-12 text-secondary">Epic Jewelery</div>
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
		
		
		<!-- Block Promotion Images  -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-fuchsia">
              <div class="card-body">
                <div class="row">
				  <div class="col-sm-6 col-lg-4 col-12">
					<a href="product.php" >
                      <img src="img/banner06.jpg" class="img-fluid mb-2 shadow" alt="sample"/>
                    </a>
				  </div>
				  <div class="col-sm-6 col-lg-4 col-12">
					<a href="product.php" >
                      <img src="img/banner08.jpg" class="img-fluid mb-2 shadow" alt="sample"/>
                    </a>
				  </div>
				  <div class="col-sm-6 col-lg-4 col-12 d-none d-lg-block">
					<a href="product.php" >
                      <img src="img/banner09.jpg" class="img-fluid mb-2 shadow" alt="sample"/>
                    </a>
				  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
		
		 <!-- By Categories 1 -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-lightblue card-outline">
              <div class="card-header">
                <h4 class="card-title">For your Kitchen</h4>
				<small class="float-right">See All > </small>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=6; $i++){?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star "></i>
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
		
		 <!-- By Categories 2 -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-pink">
              <div class="card-header">
                <h4 class="card-title">Pastries  Yummy!</h4>
				<small class="float-right">See All > </small>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=2; $i++){?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/cake1.jpg"  class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star "></i>
						</div>
					  </div>
                    </a>
                  </div>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/cake5.jpg"  class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star "></i>
						</div>
					  </div>
                    </a>
                  </div>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/cake6.jpg"  class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star "></i>
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
		
		 <!-- By Categories 1 -->
		<div class="row product-cover">
          <div class="col-12">
            <div class="card card-indigo card-outline">
              <div class="card-header">
                <h4 class="card-title">New on I-Soko</h4>
				<small class="float-right">See All > </small>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=6; $i++){?>
				  <div class="col-xl-2 col-md-3 col-sm-4 col-6 shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 text-secondary">Britain Watch kilo 60 with bumper...</div>
						<div class="col-6"><h6>Ksh 1300</h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="far fa-star "></i>
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
		
		<!-- Block Promotion Images  -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-fuchsia">
              <div class="card-body">
                <div class="row">
				  <div class="col-sm-6 col-lg-4 col-12">
					<a href="product.php" >
                      <img src="img/banner06.jpg" class="img-fluid mb-2 shadow" alt="sample"/>
                    </a>
				  </div>
				  <div class="col-sm-6 col-lg-4 col-12">
					<a href="product.php" >
                      <img src="img/banner08.jpg" class="img-fluid mb-2 shadow" alt="sample"/>
                    </a>
				  </div>
				  <div class="col-sm-6 col-lg-4 col-12 d-none d-lg-block">
					<a href="product.php" >
                      <img src="img/banner09.jpg" class="img-fluid mb-2 shadow" alt="sample"/>
                    </a>
				  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
		
		
		 <!-- About Us -->
		<div class="row product-cover"> 
          <div class="col-12">
            <div class="card card-orange border shadow-lg">
              <div class="card-body bg-light">
				<div class="text-center">
					<h2 style="font-family:Century Schoolbook">What is <span class="text-orange">I-SOKO</span></h2>
					<h6 class="text-orange">Learn More About Us</h6>
				</div>
				<div>
					<p>
						I-Soko is a cross-platform site that houses multiple vendor-shops in one roof. I-Soko is a big online "mall" with several individual and independent shops under one roof. We are missioned to provide customers with the best online services and expirience to shop at their prefered outlets.
					</p>
				</div>
                 <dl class="row">
                  <dt class="col-sm-4">Description lists</dt>
                  <dd class="col-sm-8">A description list is perfect for defining terms.</dd>
                  <dt class="col-sm-4">Euismod</dt>
                  <dd class="col-sm-8">Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</dd>
                  <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
                  <dt class="col-sm-4">Malesuada porta</dt>
                  <dd class="col-sm-8">Etiam porta sem malesuada magna mollis euismod.</dd>
                  <dt class="col-sm-4">Felis euismod semper eget lacinia</dt>
                  <dd class="col-sm-8">Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo
                    sit amet risus.
                  </dd>
                </dl>
				
				<div class="marketing">
				<div class="row text-center">
          <div class="col-lg-3">
            <img class="rounded-circle" src="img/mpesa.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>M-Pesa Enabled</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="img/isoko7.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-3">
            <img class="rounded-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" width="140" height="140">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
              </div>
              </div>
            </div>
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
		
      </div><!-- /.container-fluid -->
    </div>
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
