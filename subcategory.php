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
            <h4>Televisions</h4>
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
				  
				  <div class="col-12">
				  
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
                <h4 class="card-title">Top Selling Televisions</h4>
              </div>
              <div class="card-body">
                <div class="row">
				<?php for($i=1; $i<=6; $i++){?>
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
	  
	  
		 <!-- Shop Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-solid">
              <div class="card-body">
				<h5><b>Televisions</b></h5>
				<div class="row">
					<div class="col-12 d-lg-none product-cover"> 
					  <div class="form-group">
                        <select class="form-control bg-dark border border-dark ">
                          <option class="bg-white">All Televisions</option>
                          <option class="bg-white">Top Selling</option>
                          <option class="bg-white">Sub Sub Category</option>
                          <option class="bg-white">Sub Sub Category</option>
                          <option class="bg-white">Sub Sub Category</option>
                          <option class="bg-white">Sub Sub Category</option>
                          <option class="bg-white">Sub Sub Category</option>
                        </select>
                       </div>
					</div>
					<div class="col-12 product-cover">
						<div class="btn-group float-right">
						  <button type="button" class="btn btn-sm btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Sort By: Highest Price
						  </button>
						  <div class="dropdown-menu dropdown-menu-right">
							<button class="dropdown-item" type="button">Action</button>
							<button class="dropdown-item" type="button">Another action</button>
							<button class="dropdown-item" type="button">Something else </button>
						  </div>
						</div>
					</div>
				</div>
                <div class="row product-cover">
				  <div class="col-3 d-none d-lg-block">
					<div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
					  <a class="nav-link text-dark" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">All <span class="text-muted float-right">(52,440 results)</span></a>
					  <a class="nav-link text-dark" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">Top Selling </a>
					  <a class="nav-link text-dark" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Men's Khaki Trousers </a>
					  <a class="nav-link text-dark" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">Crop Tops </a>
					  <a class="nav-link text-dark" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Men's Suits </a>
					  <a class="nav-link text-dark" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Ladies' Suits </a>
					  <a class="nav-link text-dark" id="vert-tabs-settings-tab" data-toggle="pill" href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings" aria-selected="false">Men's Shoes </a>
					</div>
				  </div>
				  <div class="col-md-12 col-lg-9">
					<div class="tab-content" id="vert-tabs-tabContent">
					  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
						 <div class="row">
							<?php for($i=1; $i<=12; $i++){?>
							  <div class="col-xl-3 col-md-4 col-sm-4 col-6 shadow-sm zoom product-cover">
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