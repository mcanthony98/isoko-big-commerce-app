<?php
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";
	$headtitle = "Shop Outlook | " . $logo_row["name"] . " - I-Soko";
?>
<?php include "includes/head.php";?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =61;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->

  <?php include "../includes/messages.php";?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Shop Outlook</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item active">Shop Outlook</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	
	     
	    <!-- Main content -->
    <section class="content">	
      <div class="row">
        <div class="col-md-12">
          <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Carousel</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
				<?php 
					$carores = $pdo->query("SELECT * FROM shop_carousel WHERE shop_id='$shop_id' LIMIT 3");
					if($carores->num_rows == 0){
				?>	
				
						<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					  </ol>
					  <div class="carousel-inner">
						<div class="carousel-item active">
						  <img class="d-block w-100" src="https://placehold.it/900x500/39CCCC/ffffff&text=Make+your+shop+Amazing!" alt="First slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block w-100" src="https://placehold.it/900x500/3c8dbc/ffffff&text=We+Love+Shopping" alt="Second slide">
						</div>
						<div class="carousel-item">
						  <img class="d-block w-100" src="https://placehold.it/900x500/f39c12/ffffff&text=Online+Business+is+great" alt="Third slide">
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
					  <div class="col-12">
						<form method="POST" action="../processes/myshopprocesses.php" accept-charset="UTF-8" enctype="multipart/form-data">
						<div style="color:white" class="btn btn-outline-white btn-file mt-1">
							<span class="text-orange"><i class="fa fa-plus"></i> Add new Image</span>
							<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
							<input type="hidden" value="<?php echo $shop_id;?>" name="newcarousel"   required>
						  </div>
					  </form>
					  </div>							
					
				<?php }else{
					
				?>
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
                      <img class="img-fluid d-block w-100" src="../carousels/<?php echo $carorow["name"];?>" alt="Carousel Image">
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
				  <div class="col-12 product-image-thumbs">
					<?php 
					$carores = $pdo->query("SELECT * FROM shop_carousel WHERE shop_id='$shop_id' LIMIT 3");
					while($carorow = $carores->fetch_assoc()){
						
						 $fom = '
						   <form method="POST" action="../processes/myshopprocesses.php" accept-charset="UTF-8" enctype="multipart/form-data">
						   <div class="form-group">
							  <div class="btn btn-primary btn-file">
								<i class="fas fa-edit"></i> Change
								<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
								<input type="hidden" value="'.$carorow["carousel_id"].'" name="changecaro"   required>
							  </div>
							</div>
							</form>
							';
						?>
						<div class="product-image-thumb"> 
						<a href="../carousels/<?php echo $carorow["name"];?>" data-toggle="lightbox" data-title="Carousel Image" data-footer='<?php echo $fom;?>' data-gallery="gallery">
						  <img src="../carousels/<?php echo $carorow["name"];?>" class="img-fluid" alt="Carousel Image"> 
						</a>
						</div>
					<?php }?>
					<?php if($carores->num_rows < 3){?>
					<div>
						<form method="POST" action="../processes/myshopprocesses.php" accept-charset="UTF-8" enctype="multipart/form-data">
						<div style="color:white" class="btn btn-outline-white btn-file mt-1">
							<span class="text-orange"><i class="fa fa-plus"></i> Add new</span>
							<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
							<input type="hidden" value="<?php echo $shop_id;?>" name="newcarousel"   required>
						  </div>
					  </form>
					</div>
					<?php } ?>
				  </div>
				  <br/>
				  <p class="text-primary text-sm">* Click on an image to change.</p>
				<?php } ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
		  <div class="col-md-6">
            <div class="card">
              <div class="card-header">
				<div class="row">
					<div class="col-6">
						<h3 class="card-title">Shop Logo</h3>
					</div>
					<div class="col-6">
					  <form method="POST" action="../processes/myshopprocesses.php" accept-charset="UTF-8" enctype="multipart/form-data">
						<div style="color:white" class="btn btn-primary btn-xs btn-file float-right">
							<i class="fas fa-edit"></i> Change
							<input type="file" name="photos" OnInput = "this.form.submit();" accept="image/*">
							<input type="hidden" value="<?php echo $shop_id;?>" name="logoedit"   required>
						  </div>
					  </form>
					</div>
				</div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-sm-3">
                      <img src="<?php echo $logo;?>" class="img-fluid mb-2" alt="<?php echo $logo_row["name"];?>"/>
                 </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
			<div class="card">
              <div class="card-header">
                <h3 class="card-title">Announcements</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-info">
					<p><span class="far fa-lightbulb"></span> <small>Use announcements to make short messages to anyone who visits your shop. *Promotions, offers, after-sale services etc...</small></p>					
                </div>
				<?php
					$slct = "SELECT * FROM shop_announcement where shop_id='$shop_id'";
					$sres = $pdo->query($slct);
					if($sres->num_rows < 1){
				?>
				<form method="POST" action="../processes/myshopprocesses.php">
					<div class="form-group">
                        <label>Announcement </label>
                        <textarea class="form-control" name="text" rows="3" placeholder="Write Announcement here..."></textarea>
                    </div>
					<div class="form-group">
						<label>Visible until: </label>
						<input type="date" name="until" class="form-control">
                    </div>
					<div class="form-group">
						<input type="submit" value="Submit" name="announcement" class="btn btn-warning float-right">
                    </div>
					</form>
					<?php 
					}else{
						$srow = $sres->fetch_assoc();
					?>
					<form method="POST" action="../processes/myshopprocesses.php">
						<div class="form-group">
							<label>Announcement </label>
							<textarea class="form-control" name="text" rows="3" placeholder="Write Announcement here..."><?php echo $srow["announcement"];?></textarea>
						</div>
						<div class="form-group">
							<label>Visible until: </label>
							<input type="date" value="<?php echo $srow["date_until"];?>" name="until" class="form-control">
						</div>
						<div class="form-group">
							<input type="submit" value="Save Changes" name="announcement" class="btn btn-warning float-right">
						</div>
						</form>
					
					<?php 
					}
					?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
  <!-- Main Footer -->
    <?php include "includes/footer.php";?>
  <!-- ./Main Footer -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
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