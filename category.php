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
        <div class="row mb-2">
          <div class="col-12">
            <h4>Household Electronics</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body">
                <div class="row product-cover">
				  <div class="col-2 d-none d-lg-block">
					<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
					<a class="nav-link text-dark" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">HouseHold Electronics </a>
					  <ul class="list-unstyled">
                      <ul>
						  
					<?php for($i=1;$i<=3;$i++){?>
						  <li><a href="subcategory.php" class="text-orange">Televisions</a></li>
						  <li><a href="subcategory.php" class="text-orange">Hi-Fi Systems</a></li>
						  <li><a href="subcategory.php" class="text-orange">Refrigerators</a></li>
						  <li><a href="subcategory.php" class="text-orange">Washing Machines</a></li>
						  <li><a href="subcategory.php" class="text-orange">Sandwitch Tosters</a></li>
					<?php } ?>	  
                      </ul>
                     </ul>
					 
					</div>
				  </div>
				  
				  
				  
				  
				  
				  <div class="col-md-12 col-lg-10 rounded">
				  
				   <h5>Televisions <small class="float-right text-sm">See More > </small></h5>
					<div class="tab-content" id="vert-tabs-tabContent">
					  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
						 <div class="row">
							<?php for($i=1; $i<=6; $i++){?>
							  <div class="col-xl-2 col-md-2 col-sm-3 col-6 shadow-sm zoom product-cover">
								<a href="product.php" >
								  <img src="../img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 text-dark">Sub sub Category</div>
								  </div>
								</a>
							  </div>
							<?php } ?>
					</div>
					  </div>
					</div>
					<hr>
					
					<h5>Refrigerators <small class="float-right text-sm">See More > </small></h5>
					<div class="tab-content" id="vert-tabs-tabContent">
					  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
						 <div class="row">
							<?php for($i=1; $i<=6; $i++){?>
							  <div class="col-xl-2 col-md-2 col-sm-3 col-6 shadow-sm zoom product-cover">
								<a href="product.php" >
								  <img src="../img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 text-dark">Product Name</div>
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
					<hr>
					
					<h5>Blenders <small class="float-right text-sm">See More > </small></h5>
					<div class="tab-content" id="vert-tabs-tabContent">
					  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
						 <div class="row">
							<?php for($i=1; $i<=6; $i++){?>
							  <div class="col-xl-2 col-md-2 col-sm-3 col-6 shadow-sm zoom product-cover">
								<a href="product.php" >
								  <img src="../img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
								  <div class="row text-dark borde">
									<div style="font-size:14px" class="col-12 text-dark">Product Name</div>
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
					<hr>
					
				  </div>
            </div>
              </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
	  
	  <!-- Featured Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h4 class="card-title">Top Selling Household Electronics</h4>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=12; $i++){?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                    <a href="product.php" >
                      <img src="../img/product0<?php echo $i;?>.jpg" class="img-fluid mb-2" alt="sample"/>
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