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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item"><a href="products.php">Products</a></li>
              <li class="breadcrumb-item active">Add Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
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
	  <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card card-outline card-warning">
              <!-- /.card-header -->
              <div class="card-body">
                 <form method="POST" action="add_description.php">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name (Max 50 Characters)</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter product name">
                  </div>
					<div class="row">
					 <div class="col-md-4">
					  <div class="form-group">
					  <?php 
						$catsqry = "SELECT * FROM category";
						$catsres = $pdo->query($catsqry);
					  ?>
						<label for="exampleInputPassword1">Main Category</label>
						<select id="exampleInputPassword1" name="category" class="form-control">
							<?php while($catsrow = $catsres->fetch_assoc()){?>
							<option value="<?php echo $catsrow["category_id"];?>"><?php echo $catsrow["category"];?></option>
							<?php } ?>
						</select>
					   </div>
					  </div>
					  <div class="col-md-4">
					  <div class="form-group">
						<label for="exampleInputPassword2">Sub-Category</label>
						<select id="exampleInputPassword2" name="subcategory" class="form-control">
							<option value="1">Men Trousers</option>
							<option>1</option>
							<option>1</option>
						</select>
					   </div>
					  </div>
					  <div class="col-md-4">
					  <div class="form-group">
					   <?php 
						$custsqry = "SELECT * FROM custom_category where shop_id = ".$_SESSION["sokoshop"];
						$custsres = $pdo->query($custsqry);
					  ?>
						<label for="exampleInputPassword3">Custom-Category</label>
						<select id="exampleInputPassword3" name="custcategory" class="form-control">
								<option value="0"></option>
						<?php if($custsres->num_rows < 1){
							echo '<option value="0"></option>';
						}else{
							while($custsrow = $custsres->fetch_assoc()){
								echo '<option value="'.$custsrow["category_id"].'">'.$custsrow["category_name"].'</option>';								
							}
						}?>
							
						</select>
					   </div>
					  </div>
					</div>
					
                  <div class="row">
				  <div class="col-md-4">
				  <div class="form-group">
				   <label for="exampleInputEmail2">Set a Price</label>
				  <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Ksh.</span>
                  </div>
                  <input type="number" class="form-control" name="price" id="exampleInputEmail2" >
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
                </div>
                </div>
				<div class="col-md-4">
                </div>
				<div class="col-md-4">
				  <div class="form-group">
                    <label for="exampleInputEmail3">Quantity available (You can update later)</label>
                    <input type="number" class="form-control" name="quantity" id="exampleInputEmail3" placeholder="Enter quantity">
                  </div>
                </div>
				
                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="details-submit" class="btn btn-warning">Submit</button>
                </div>
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
	
    <!-- Main content -->
    
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
</body>
</html>