<?php
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";
	$headtitle = "Shop Policy";
?>
<?php include "includes/head.php";?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php $sdpg =63;?>
  <?php include "includes/sidebar.php";?>
  <!-- /.sidebar -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Shop Policy</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $logo_row["name"];?></a></li>
              <li class="breadcrumb-item active">Shop Policy</li>
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
				<div class="col-12">
					<h3 class="card-title">Order Processeing Time</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="callout callout-info">
					<p><small>How long does it take to processes an order before making a delivery.</small></p>					
                </div>
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"> Days:</label>
				<div class="col-sm-10">
					<select class="form-control" style="max-width:70px;" required>
						<option>14</option>
					</select>
				</div>
			</div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-outline card-warning">
            <div class="card-header">
              <h3 class="card-title">Delivery Policy</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
			<span class="text-info text-sm">* Locations not allocated a delivery fee are taken as "places you do not deliver to". For free delivery, select a place and set it as free delivery location.</span>
              
			  <div class="row mt-2">
                    <div class="col-sm-6">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" id="idonot">
							  <label class="form-check-label text-sm" for="idonot">I do not make deliveries</label>
							</div>
						</div>	
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" id="freed">
							  <label class="form-check-label text-sm" for="freed">I offer free delivery to all places</label>
							</div>
						</div>	
					</div>
			  </div>
					<div class="border rounded">
				  <button class="btn btn-sm btn-white"><span class="text-bold text-orange" data-toggle="modal" data-target="#modal-new"><i class="fa fa-plus"></i> Add a new delivery option</span></button>
				  <div class="table-responsive" style="max-height:360px">
				  <table class="table table-striped table-head-fixed text-nowrap" >
					  <thead>
					  <tr>
						<th>Delivery To:</th>
						<th>Cost</th>
						<th></th>
					  </tr>
					  </thead>
					  <tbody>
							<?php for($i=0;$i<13;$i++){?>
						  <tr>
							<td><?php echo "Mombasa";?></td>
							<td><?php echo "Ksh 340";?></td>
							<td>
							<button type="button" class="btn btn-xs btn-info view_data"  id="<?php echo '0'; ?>" data-toggle="modal" data-target="#modal-edit">
							  <i class="fas fa-pencil-alt"></i> Edit
							</button>
							<a href="../processes/custom-category.php?delete=<?php echo $custom_category_id;?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Remove</a>
							</td>
						  </tr>
							<?php }?>
					  </tbody>
					</table>
				  </div>
				  </div>
				  <div class="form-group mt-4">
					<label>Additional information to buyers about deliveries <small class="text-secondary">Optional</small></label>
					<textarea class="form-control" rows="3" placeholder="Example: We use parcel delivery services such as Well's Fargo... "></textarea>
				  </div>
				  <button type="button" class="btn btn-sm bg-orange text-white" >Submit</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-outline card-orange">
            <div class="card-header">
              <h3 class="card-title">Set up pick Up locaction</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
			<span class="text-info text-sm">* You can now have pick up stations where buyers can pick up their orders. </span>
              
			  <div class="row mt-2">
                    <div class="col-sm-12">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" id="idonotp">
							  <label class="form-check-label text-sm" for="idonotp">I do not have pick up services</label>
							</div>
						</div>	
					</div>
			  </div>
					<div class="border rounded">
				  <button class="btn btn-sm btn-white"><span class="text-bold text-orange" data-toggle="modal" data-target="#modal-newpick"><i class="fa fa-plus"></i> Add a new pick up station</span></button>
				  <div class="table-responsive" style="max-height:360px">
				  <table class="table table-striped table-head-fixed text-nowra" >
					  <thead>
					  <tr>
						<th style="width:300px">Pick Up Station:</th>
						<th>Cost</th>
						<th></th>
					  </tr>
					  </thead>
					  <tbody>
							<?php for($i=0;$i<13;$i++){?>
						  <tr>
							<td >
							<?php echo "Rahimtulla Building Trust Couple store 4 basement, Moi Avenue ,Nairobi";?><br/>
							<small class="text-muted">Open Between 9.00 am - 6.00 pm </small>
							</td>
							<td><?php echo "Ksh 340";?></td>
							<td>
							<button type="button" class="btn btn-xs btn-info view_data"  id="<?php echo '0'; ?>" data-toggle="modal" data-target="#modal-edit">
							  <i class="fas fa-pencil-alt"></i> Edit
							</button>
							<a href="../processes/custom-category.php?delete=<?php echo $custom_category_id;?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Remove</a>
							</td>
						  </tr>
							<?php }?>
					  </tbody>
					</table>
				  </div>
				  </div>
				  <div class="form-group mt-4">
					<label>Additional information to buyers about order pick up <small class="text-secondary">Optional</small></label>
					<textarea class="form-control" rows="3" placeholder="Example: Make sure you have your order number when picking up orders..."></textarea>
				  </div>
				  <button type="button" class="btn btn-sm bg-orange text-white" >Submit</button>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		  
		  <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title">Order Returning</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
				<span class="text-sm text-info">*You can now set your shop return policy on orders</span>
              <div class="border-bottom">
			  <p>Do you accept returns?</p>
			  <div class="row">
				<div class="col-sm-2">
					<div class="form-check">
					  <input class="form-check-input" id="yes" type="radio" name="radio1">
					  <label class="form-check-label" for="yes">YES</label>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-check">
					  <input class="form-check-input" id="no" type="radio" name="radio1">
					  <label class="form-check-label" for="no">NO</label>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="form-check">
					  <input class="form-check-input" id="some" type="radio" name="radio1">
					  <label class="form-check-label" for="some">Only on selected items</label>
					</div>
				</div>
              </div>
			  <div>
				<div class="form-group">
					<label for="">Return Period</label> <small class="text-muted">Period from date of delivery that you accept returns</small>
					<select class="form-control" style="max-width:70px;" required>
						<option>5</option>
					</select>
					</div>
					
				<div class="form-group mt-4">
					<label>Describe products you don't accept returns</label>
					<textarea class="form-control" rows="3" placeholder="Example: We do not accept returns on vests, and innerware"></textarea>
				  </div>	
			  </div>
            </div>
				<div class="form-group mt-4">
					<label>Additional information to buyers about returning <small class="text-secondary">Optional</small></label>
					<textarea class="form-control" rows="3" placeholder="Example: Returns are only accepted if the product is in good condition."></textarea>
				  </div>
				  <button type="button" class="btn btn-sm bg-orange text-white" >Submit</button>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
	  </br>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <?php include "includes/footer.php";?>
  <!-- ./Main Footer -->
  
</div>
<!-- ./wrapper -->


<!-- MODALS -->

<div class="modal fade" id="modal-newpick">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Pick Up Station</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="../processes/custom-category.php" method="POST">
				<div class="row">
					<div class="col-lg-12">
						 <div class="form-group">
							<label>Location</label>
							<small>Make it very precise and specific</small>
							<textarea class="form-control" rows=3 placeholder="Eg Rahimtulla Trust Building, 2nd Floor, Store 002, Moi Avenue, Nairobi"></textarea>
						 </div>
					</div>
					<div class="col-lg-4">
						 <div class="form-group">
							<label>Region</label>
							<select class="form-control" style="max-width:200px;" required>
								<option>Tharaka Nithi</option>
							</select>
						 </div>
					</div>
					<div class="col-lg-4">
						 <div class="form-group">
							<label>City/Place</label>
							<select class="form-control" style="max-width:200px;" required>
								<option>Tharaka Nithi</option>
							</select>
						 </div>
					</div>
					
					<div class="col-6 col-lg-4">
						<div class="form-group">
						<label for="">Station Open From</label>
						<select class="form-control" style="max-width:70px;" required>
							<option>5</option>
						</select>
						</div>
					</div>
					<div class="col-6 col-lg-4">
						<div class="form-group">
						<label for="">Station closes at</label>
						<select class="form-control" style="max-width:70px;" required>
							<option>5</option>
						</select>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Cost</label>
							<input type="number" class="form-control" name="cost" id="exampleInputEmail1" placeholder="Cost">
						</div>
					</div>
					<div class="col-lg-4">
						<label for="">Order is ready for pick up in (Days)</label>
						<select class="form-control" style="max-width:70px;" required>
							<option>5</option>
						</select>
					</div>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Add " name="add-category" class="btn btn-warning">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  
	  <div class="modal fade" id="modal-new">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">New Delivery Option</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="../processes/custom-category.php" method="POST">
				<div class="row">
					<div class="col-lg-4">
						 <div class="form-group">
							<label>Location</label>
							<select class="form-control" style="max-width:200px;" required>
								<option>Tharaka Nithi</option>
							</select>
						 </div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Cost</label>
							<input type="number" class="form-control" name="cost" id="exampleInputEmail1" placeholder="Cost">
						</div>
					</div>
					<div class="col-lg-4">
						<label for="">Delivery period (Days)</label>
						<select class="form-control" style="max-width:70px;" required>
							<option>5</option>
						</select>
					</div>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Add " name="add-category" class="btn btn-warning">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  

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