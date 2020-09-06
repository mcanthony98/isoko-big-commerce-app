<?php
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";
	$headtitle = "";
?>
<?php include "includes/head.php";?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =4;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->
<?php 
		if (isset($_SESSION["error"])){ 
			echo '<script type="text/javascript">toastr.error("'.$_SESSION["error"].'")</script>';
			unset($_SESSION["error"]);
		} if (isset($_SESSION["success"])){ 
			echo '<script type="text/javascript">toastr.success("'.$_SESSION["success"].'")</script>';
			unset($_SESSION["success"]);
		} if (isset($_SESSION["info"])){ 
			echo '<script type="text/javascript">toastr.info("'.$_SESSION["info"].'")</script>';
			unset($_SESSION["info"]);
		} if (isset($_SESSION["warning"])){ 
			echo '<script type="text/javascript">toastr.warning("'.$_SESSION["warning"].'")</script>';
			unset($_SESSION["warning"]);
		}
	?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Product Images</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item"><a href="products.php">Products</a></li>
              <li class="breadcrumb-item active">Product Photos</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <?php
		if(!isset($_GET['product'])){ ?>
			<script>
			window.location.replace("products.php");
			</script>
		<?php }else{ 
		$product = $_GET['product'];
		$proqry = "SELECT * FROM products WHERE product_id ='$product'";
		$prores = $pdo->query($proqry);
		$prorow=$prores->fetch_assoc();
		?>
	
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-warning card-outline">
              <div class="card-header">
                <h4 class="card-title"><?php echo $prorow["name"];?><br/><small class="text-primary"> *Products MUST have a feature photo for them to be published.<br/>
					*A product can have upto 6 images excluding the feature image.<br/>
				</small></h4>
              </div>
              <div class="card-body">
                <div class="row">
				<div class="col-sm-5">
				</div>
                  <div class="col-sm-2">
					<div class="ribbon-wrapper ribbon-lg">
						  <div class="ribbon bg-warning">
							  Feature Image
						  </div>
					</div>
					<?php
					   $stmt = "SELECT * FROM product_photos WHERE product_id = '$product' AND type = 1  ORDER BY photo_id DESC LIMIT 1";
					   $login_res = $pdo->query($stmt);
					   if($login_res->num_rows < 1){ 
					?>
					<form method="POST" action="../processes/add_photo.php" accept-charset="UTF-8" enctype="multipart/form-data">
					   <div class="form-group">
						  <div class="btn btn-default btn-xs btn-file">
							<img src="../img/noimage.png" class="img-fluid mb-2" alt="black sample"/>
							<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
							<input type="hidden" value="<?php echo $product;?>" name="featureupload"   required>
						  </div>
						</div>
						</form>
					 <?php }else{
					   $row = $login_res->fetch_assoc();
					   
						 $fom = '
					   <form method="POST" action="../processes/add_photo.php" accept-charset="UTF-8" enctype="multipart/form-data">
					   <div class="form-group">
						  <div class="btn btn-primary btn-file">
							<i class="fas fa-edit"></i> Change
							<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
							<input type="hidden" value="'.$row["photo_id"].'" name="change"   required>
							<input type="hidden" value="'.$product.'" name="product"   required>
						  </div>
						</div>
						</form>
						';
					   
					  ?>
					   <a href="../products/<?php echo $row["name"];?>" data-toggle="lightbox" data-title="Product Feature Image" data-footer='<?php echo $fom;?>' data-gallery="gallery">
                      <img src="../products/<?php echo $row["name"];?>" class="img-fluid mb-2" alt="Not found"/>
                    </a>
					 <?php } ?>
                  </div>
				<div class="col-sm-5">
				</div>
                  </div>
				  <div class="row">
					<?php
						$qry = "SELECT * FROM product_photos WHERE product_id = '$product' AND type = 2 ";
						   $res = $pdo->query($qry);
						   if($res->num_rows > 0){
							   while( $picrow = $res->fetch_assoc()){
								   $btns = '
								   <div class="row">
								   <div class="col-6">
								   <form method="POST" action="../processes/add_photo.php" accept-charset="UTF-8" enctype="multipart/form-data">
								   <div class="form-group">
									  <div class="btn btn-primary btn-file">
										<i class="fas fa-edit"></i> Change
										<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
										<input type="hidden" value="'.$picrow["photo_id"].'" name="change"   required>
										<input type="hidden" value="'.$product.'" name="product"   required>
									  </div>
									</div>
									</form>
									</div>
								   <div class="col-5">
									<a href="../processes/add_photo.php?delete='.$picrow["photo_id"].'&product='.$product.'"  class="btn btn-danger"><i class="fas fa-trash"></i> Delete</a>
									</div>
									';
						?>
                  <div class="col-sm-2">
                    <a href="../products/<?php echo $picrow["name"];?>" data-toggle="lightbox" data-title="Product Image" data-footer='<?php echo $btns;?>' data-gallery="gallery">
                      <img src="../products/<?php echo $picrow["name"];?>" class="img-fluid mb-2" alt="not found"/>
                    </a>
					
                  </div>
					<?php
						   }}
							$count = 1;
							$limit = 6 - $res->num_rows;
							while ($count <= $limit){
								
						?>	
					<div class="col-sm-2">
						<form method="POST" action="../processes/add_photo.php" accept-charset="UTF-8" enctype="multipart/form-data">
					   <div class="form-group">
						  <div class="btn btn-default btn-xs btn-file">
							<img src="../img/noimage.png" class="img-fluid mb-2" alt="black sample"/>
							<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
							<input type="hidden" value="<?php echo $product;?>" name="other"  required>
						  </div>
						</div>
						</form>
					</div>	
						<?php $count++; }?>
					
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
    <?php include "includes/footer.php";?>
  <!-- ./Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Filterizr-->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script>
</body>
</html>
<?php } ?>