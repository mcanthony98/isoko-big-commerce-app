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
            <h1 class="m-0 text-dark">Product Description</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item"><a href="products.php">Products</a></li>
              <li class="breadcrumb-item active">Add Description</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">
				Description 
				<a href="#"><small>See how to write a good product description?</small></a>
              </h3>
              <!-- tools box -->
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.card-header -->
			<?php
				if(isset($_POST["details-submit"])){
				  $name = mysqli_real_escape_string($pdo, $_POST["name"]);
				  $cat = mysqli_real_escape_string($pdo, $_POST["category"]);
				  $subcat = mysqli_real_escape_string($pdo, $_POST["subcategory"]);
				  $custcat = mysqli_real_escape_string($pdo, $_POST["custcategory"]);
				  $price = mysqli_real_escape_string($pdo, $_POST["price"]);
				  $quantity = mysqli_real_escape_string($pdo, $_POST["quantity"]);
				}else{
					$_SESSION["error"] = "Enter product details first";
					header ('location: add_product.php');
				}
			?>
			<form method="POST" action="../processes/productprocesses.php">
            <div class="card-body pad">
              <div class="mb-3">
                <textarea class="textarea" name="desc" placeholder="Write your product description here..."
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
				<input type="hidden" name="name" value="<?php echo $name ;?>">		  
				<input type="hidden" name="category" value="<?php echo $cat ;?>">		  
				<input type="hidden" name="subcategory" value="<?php echo $subcat ;?>">		  
				<input type="hidden" name="custcategory" value="<?php echo $custcat ;?>">		  
				<input type="hidden" name="price" value="<?php echo $price ;?>">		  
				<input type="hidden" name="quantity" value="<?php echo $quantity ;?>">		  
              </div>
              <p class="text-sm mb-0">
                <input type="submit" name="newproduct" class="btn btn-warning" value="Submit">
              </p>
			  </form>
            </div>
          </div>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote(
	{
  toolbar: [
  ['style', ['style']],
  ['style', ['bold', 'italic', 'underline']],
  ['font', ['superscript', 'subscript']],
  ['fontsize', ['fontsize']],
  ['fontname', ['fontname']],
  ['color', ['color']],
  ['para', ['ul', 'ol', 'paragraph']],
  ['table', ['table']],
  ['view', ['fullscreen', 'help']],
],

  placeholder: 'Write your Product Description here...'
})
  })
</script>
</body>
</html>