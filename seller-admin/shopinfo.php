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
  <?php $sdpg =62;?>
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
            <h1 class="m-0 text-dark">Shop Information</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item active">Shop Info</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
		<section class="content">
      <div class="row">
        <div class="col-md-6">
		  <div class="card card-outline card-danger">
            <div class="card-header">
			  <div class="row">
				<div class="col-6">
					<h3 class="card-title">Enter Maintenance Mode</h3>
                </div>
				<div class="col-6">
                    <div class="float-right custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="customSwitch3">
                      <label class="custom-control-label" for="customSwitch3"></label>
                    </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="callout callout-info">
					<p><span class="far fa-lightbulb"></span> <small>You can close/open your shop whenever you want. Closed Shops will not be accessible by customers.</small></p>					
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		  <form method="POST" action="../processes/myshopprocesses.php">
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Shop Name</label>
                <input type="text" value="<?php echo $logo_row["name"];?>" name="name" id="inputName" class="form-control" required>
              </div>
			  <div class="form-group">
                <label for="inputProjectLeader">Shop Mobile Number</label>
                <input type="text" value="<?php echo $logo_row["phone"];?>" name="phone" id="inputProjectLeader" class="form-control" required data-inputmask='"mask": "+254 999 999 999"' data-mask>
              </div>
			  <div class="form-group">
                <label for="inputClientCompany">Shop Email</label>
                <input type="email" value="<?php echo $logo_row["email"];?>" name="email" id="inputClientCompany" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="inputStatus">Shop Category</label>
                <select id="inputStatus" name="cat" class="form-control custom-select" required>
				<?php 
					$cqry = 'SELECT * FROM category WHERE category_id='.$logo_row["category_id"];
					$cres = $pdo->query($cqry);
					$crow = $cres->fetch_assoc();
				?>
				<option value="<?php echo $crow["category_id"];?>"><?php echo $crow["category"];?></option>
				<?php 
					$catres = $pdo->query("SELECT * FROM category");
					while ($catrow = $catres->fetch_assoc()){
				?>
                  <option value="<?php echo $catrow["category_id"];?>"><?php echo $catrow["category"];?></option>
					<?php } ?>
                </select>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-outline card-success">
            <div class="card-header">
              <h3 class="card-title">Payment Information</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget">M-Pesa Number to Recieve Payment</label>
                <input type="number"name="pphone"  value="<?php echo $logo_row["payment_no"];?>" id="inputEstimatedBudget" class="form-control" required>
              </div>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		  
		  <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Shop Slogan</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputDescription">Shop Slogan</label>
                <textarea id="inputDescription"  name="slogan" class="form-control" required rows="4"><?php echo $logo_row["slogan"];?></textarea>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <a href="index.php" class="btn btn-secondary">Cancel</a>
          <input type="submit" value="Save Changes" name="shopedit" class="btn btn-success float-right">
        </div>
		</form>
      </div>
	  </br>
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<script>
  $(function () {
    //Kenyan Phone numbers
    $('[data-mask]').inputmask()

  })
</script>
</body>
</html>