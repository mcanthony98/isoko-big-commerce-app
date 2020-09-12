<?php
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";
	$headtitle = "Shop Policy";
	$shid = $logo_row["shop_id"];
	$ptimeres = $pdo->query("SELECT * FROM processing_time WHERE shop_id='$shid'");
	$ptimerow = $ptimeres->fetch_assoc();
	
	$shopdelres = $pdo->query("SELECT * FROM shop_delivery WHERE shop_id = '$shid'");
	$shoppicres = $pdo->query("SELECT * FROM shop_pickup WHERE shop_id = '$shid'");
	
	$infores = $pdo->query("SELECT * FROM shop_info WHERE shop_id='$shid'");
	$inforow = $infores->fetch_assoc();
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
				<form method="POST" action="../processes/shoppolicyprocesses.php">
			<div class="form-group row">
				<label for="inputEmail3" class="col-sm-2 col-form-label"> Days:</label>
				<div class="col-sm-10">
					<select class="form-control" name="ptime" style="max-width:70px;" OnInput = "this.form.submit();" required>
						<?php if($ptimeres->num_rows > 0){?>
						<option value="<?php echo $ptimerow["days"];?>"><?php echo $ptimerow["days"];?></option>
						<?php } for($i=1;$i<15;$i++){?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
						<?php }?>
					</select>
				</div>
			</div>
			</form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          <div class="card card-outline card-warning" id="del">
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
					<div class="col-sm-12">
						
						<?php if($logo_row["offers_free_delivery"] == 1){?>
						<form method="POST" action="../processes/shoppolicyprocesses.php">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" OnChange = "this.form.submit();" id="freedo" checked>
							  <input type="hidden" value="0" name="free-del" required>
							  <label class="form-check-label text-sm" for="freedo">I offer free delivery to all places</label>
							</div>
						</div>	
						</form>
						<?php } else{?>
						<form method="POST" action="../processes/shoppolicyprocesses.php">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" OnChange = "this.form.submit();" id="freed">
							  <input type="hidden" value="1" name="free-del" required>
							  <label class="form-check-label text-sm" for="freed">I offer free delivery to all places</label>
							</div>
						</div>	
						</form>
						<?php }?>
					</div>
			  </div>
					<?php if($logo_row["offers_free_delivery"] == 1){
						echo '<span class="text-sm text-orange">You cannot set delivery fees since you deliver for free!</span>';
					}else{?>
					<div class="border rounded">
				  <button class="btn btn-sm btn-white"><span class="text-bold text-orange" data-toggle="modal" data-target="#modal-new"><i class="fa fa-plus"></i> Add a new delivery option</span></button>
				  <div class="table-responsive" style="max-height:360px">
				  <table class="table table-striped table-head-fixed text-nowrap" >
					  <thead>
					  <tr>
						<th>Delivery To:</th>
						<th>Cost (Ksh)</th>
						<th></th>
					  </tr>
					  </thead>
					  <tbody>
							<?php 
								if($shopdelres->num_rows == 0){
									echo '<tr><td colspan="3" class="text-center"> No Delivery options set.</td></tr>';
								}else {
								while($shopdelrow = $shopdelres->fetch_assoc()){
									$countyres = $pdo->query('SELECT * FROM county WHERE county_id='.$shopdelrow["county_id"]);
									$countyrow = $countyres->fetch_assoc();
							
							?>
						  <tr>
							<td><?php echo $countyrow["county_name"];?></td>
							<td><?php echo $shopdelrow["cost"];?></td>
							<td>
							<button type="button" class="btn btn-xs btn-info view_data"  id="<?php echo $shopdelrow["id"]; ?>" data-toggle="modal" data-target="#modal-edit">
							  <i class="fas fa-pencil-alt"></i> Edit
							</button>
							<a href="../processes/shoppolicyprocesses.php?deldel=<?php echo $shopdelrow["id"];?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Remove</a>
							</td>
						  </tr>
					<?php } }?>
					  </tbody>
					</table>
				  </div>
				  </div>
					<?php }?>
					<form method="POST" action="../processes/shoppolicyprocesses.php">
				  <div class="form-group mt-4">
					<label>Additional information to buyers about deliveries <small class="text-secondary">Optional</small></label>
					<textarea class="form-control" rows="3" name="del-info" placeholder="Example: We use parcel delivery services such as Well's Fargo... "><?php echo $inforow["delivery_info"];?></textarea>
				  </div>
				  <button type="submit" name="delinfo" class="btn btn-sm bg-orange text-white" >Submit</button>
				  </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-outline card-orange" id="pic">
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
						
						<?php if($logo_row["has_pickup"] == 1){?>
						<form method="POST" action="../processes/shoppolicyprocesses.php">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" OnChange = "this.form.submit();" id="pickup" >
							  <input type="hidden" value="0" name="pickupstat" required>
							  <label class="form-check-label text-sm" for="pickup">I do not have pick up stations</label>
							</div>
						</div>	
						</form>
						<?php } else{?>
						<form method="POST" action="../processes/shoppolicyprocesses.php">
						<div class="form-group">
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" OnChange = "this.form.submit();" id="pickup" checked>
							  <input type="hidden" value="1" name="pickupstat" required>
							  <label class="form-check-label text-sm" for="pickup">I do not have pick up stations</label>
							</div>
						</div>	
						</form>
						<?php }?>
					</div>
			  </div>
						<?php if($logo_row["has_pickup"] != 1){
							echo '<span class="text-sm text-orange">You do not accept pickup services!</span>';
						}else{?>
					<div class="border rounded">
				  <button class="btn btn-sm btn-white"><span class="text-bold text-orange" data-toggle="modal" data-target="#modal-newpick"><i class="fa fa-plus"></i> Add a new pick up station</span></button>
				  <div class="table-responsive" style="max-height:360px">
				  <table class="table table-striped table-head-fixed" >
					  <thead>
					  <tr>
						<th style="width:300px">Pick Up Station:</th>
						<th>Cost</th>
						<th></th>
					  </tr>
					  </thead>
					  <tbody>
							<?php 
								if($shoppicres->num_rows == 0){
									echo '<tr><td colspan="3" class="text-center"> No Pick Up Station Set.</td></tr>';
								}else {
								while($shoppicrow = $shoppicres->fetch_assoc()){
									$countyres = $pdo->query('SELECT * FROM county WHERE county_id='.$shoppicrow["county_id"]);
									$countyrow = $countyres->fetch_assoc();
									$cityres = $pdo->query('SELECT * FROM city WHERE city_id='.$shoppicrow["city_id"]);
									$cityrow = $cityres->fetch_assoc();
							
							?>
						  <tr>
							<td class="text-capitalize text-sm">
							<?php echo $shoppicrow["location"].",".$cityrow["city_name"].",".$countyrow["county_name"];?><br/>
							<small class="text-muted">Open Between <?php echo $shoppicrow["open_time"]." - ".$shoppicrow["close_time"];?> </small>
							</td>
							<td><?php echo $shoppicrow["cost"];?></td>
							<td>
							<button type="button" class="btn btn-xs btn-info view_pdata"  id="<?php echo $shoppicrow["id"]; ?>" data-toggle="modal" data-target="#modal-newpick">
							  <i class="fas fa-pencil-alt"></i> Edit
							</button>
							<a href="../processes/shoppolicyprocesses.php?picdelete=<?php echo $shoppicrow["id"];?>" onClick="return confirm('Are you sure you want to delete?');" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Remove</a>
							</td>
						  </tr>
								<?php }}?>
					  </tbody>
					</table>
				  </div>
				  </div>
						<?php } ?>
					<form method="POST" action="../processes/shoppolicyprocesses.php">
					  <div class="form-group mt-4">
						<label>Additional information to buyers about order pick up <small class="text-secondary">Optional</small></label>
						<textarea class="form-control" rows="3" name="pick-info" placeholder="Example: Make sure you have your order number when picking up orders..."><?php echo $inforow["pickup_info"];?></textarea>
					  </div>
					  <button type="subiit" name="pickinfo" class="btn btn-sm bg-orange text-white" >Submit</button>
				  </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
		  
		  <div class="card card-outline card-primary" id="ret">
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
			  <form method="POST" action="../processes/shoppolicyprocesses.php">
			  <?php 
				$ych ="";
				$nch ="";
				$sch ="";
				
				if($logo_row["accept_returns"] == 1){
					$ych = "checked";
				}elseif($logo_row["accept_returns"] == 0){
					$nch = "checked";
				}elseif($logo_row["accept_returns"] == 2){
					$sch = "checked";
				}
			  ?>
			  <div class="row">
				<div class="col-sm-2">
					<div class="form-check">
					  <input class="form-check-input" id="yes" value="1" type="radio" name="returns" OnChange = "this.form.submit();" <?php echo $ych;?> >
					  <label class="form-check-label" for="yes">YES</label>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-check">
					  <input class="form-check-input" id="no" value="0" type="radio" name="returns" OnChange = "this.form.submit();" <?php echo $nch;?> >
					  <label class="form-check-label" for="no">NO</label>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="form-check">
					  <input class="form-check-input" id="some" value="2" type="radio" name="returns" OnChange = "this.form.submit();" <?php echo $sch;?> >
					  <label class="form-check-label" for="some">Only on selected items</label>
					</div>
				</div>
              </div>
				</form>
            </div>
			<form method="POST" action="../processes/shoppolicyprocesses.php">
				<div class="form-group mt-4">
					<label>Additional information to buyers about returning <small class="text-secondary">Optional</small></label>
					<textarea class="form-control" rows="3" name="return-info" placeholder="Example: Order Returns are only accepted within 7 days from day of delivery."><?php echo $inforow["return_info"];?></textarea>
				  </div>
				  <button type="submit" name="returninfo" class="btn btn-sm bg-orange text-white" >Submit</button>
			</form>	  
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
              <h4 class="modal-title">Pick Up Station</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="../processes/shoppolicyprocesses.php" method="POST">
				<div class="row" id="pick-details">
					<div class="col-lg-12">
						 <div class="form-group">
							<label>Location</label>
							<small>Make it very precise and specific</small>
							<textarea class="form-control" name="location" rows=3 placeholder="Eg Rahimtulla Trust Building, 2nd Floor, Store 002, Moi Avenue, Nairobi" required></textarea>
						 </div>
					</div>
					<div class="col-lg-4">
						 <div class="form-group">
							<label>Region</label>
							<select class="form-control city_view" name="county" style="max-width:200px;" required>
								<?php
									$countymodalres = $pdo->query("SELECT * FROM county ORDER BY county_name");
									while($countymodalrow = $countymodalres->fetch_assoc()){
								?>
								<option value="<?php echo $countymodalrow["county_id"];?>"><?php echo $countymodalrow["county_name"];?></option>
									<?php } ?>
							</select>
						 </div>
					</div>
					<div class="col-lg-4">
						 <div class="form-group" id="city-disp">
							<label>City/Place</label>
							<select class="form-control" name="city" style="max-width:200px;" disabled>
								<option></option>
							</select>
						 </div>
					</div>
					
					<div class="col-6 col-lg-4">
						<div class="form-group">
						<label for="">Station Open From</label>
						<div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" name="open" class="form-control datetimepicker-input" data-target="#timepicker" style="max-width:100px" required />
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
						</div>
					</div>
					<div class="col-6 col-lg-4">
						<div class="form-group">
						<label for="">Station closes at</label>
						<div class="input-group date" id="timepickerc" data-target-input="nearest">
                      <input type="text" name="close" class="form-control datetimepicker-input" data-target="#timepickerc" style="max-width:100px" required />
                      <div class="input-group-append" data-target="#timepickerc" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                      </div>
                    <!-- /.input group -->
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Cost</label>
							<input type="number" class="form-control" name="cost" min=0 id="exampleInputEmail1" placeholder="Cost">
						</div>
					</div>
					<div class="col-lg-4">
						<label for="">Order is ready for pick up in (Days)</label>
						<select class="form-control" name="period" style="max-width:70px;" required>
							<?php for($i=1;$i<6;$i++){?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Add " id="insert" name="add-pickup" class="btn btn-warning">
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
				<form action="../processes/shoppolicyprocesses.php" method="POST">
				<div class="row">
					<div class="col-lg-4">
						 <div class="form-group">
							<label>Location</label>
							<select class="form-control" name="county" style="max-width:200px;" required>
								<?php
									$countymodalres = $pdo->query("SELECT * FROM county ORDER BY county_name");
									while($countymodalrow = $countymodalres->fetch_assoc()){
								?>
								<option value="<?php echo $countymodalrow["county_id"];?>"><?php echo $countymodalrow["county_name"];?></option>
									<?php } ?>
							</select>
						 </div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Cost (Ksh)</label>
							<input type="number" class="form-control" name="cost" id="exampleInputEmail1" min="0" placeholder="Cost" required>
						</div>
					</div>
					<div class="col-lg-4">
						<label for="">Delivery period (Days)</label>
						<select class="form-control" name="period" style="max-width:70px;" required>
							<?php for($i=1;$i<6;$i++){?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php } ?>
						</select>
					</div>
				</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Add " name="add-del" class="btn btn-warning">
			  </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
	  
	  
	  
	  
	   <div class="modal fade" id="modal-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Delivery Option</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
				<form action="../processes/shoppolicyprocesses.php" method="POST">
				<div class="row" id="del-details">
					
				</div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" value="Add " name="add-del" class="btn btn-warning">
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
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
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
<script>  
 $(document).ready(function(){  
      $('.view_data').click(function(){  
           var del = $(this).attr("id");  
           $.ajax({  
                url:"delivery_row.php",  
                method:"POST",  
                data:{del_ed:del},  
                success:function(data){  
                     $('#del-details').html(data);  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){   
	  $('.city_view').on("keyup input", function(){
           var county = $(this).val();
           $.ajax({  
                url:"../processes/city_row.php",  
                method:"POST",  
                data:{conty:county},  
                success:function(data){  
                     $('#city-disp').html(data);  
                }  
           });  
      });  
 });  
 </script>
 <script>  
 $(document).ready(function(){  
      $('.view_pdata').click(function(){  
           var picid = $(this).attr("id");  
           $.ajax({  
                url:"pickup_row.php",  
                method:"POST",  
                data:{picid:picid},  
                success:function(data){  
                     $('#pick-details').html(data);
					 $('#insert').val("Update");
                }  
           });  
      });  
 });  
 </script>
 <script>
  $(function () {
     //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

  })
</script>
 <script>
  $(function () {
     //Timepicker
    $('#timepickerc').datetimepicker({
      format: 'LT'
    })

  })
</script>
</body>
</html>