<?php
	session_start();	
	require "includes/connect.php";
	require "includes/sessions.php";
	
	$headtitle = "Set Up Your Delivery - I-Soko";
	$headdesc = "";
	$headkeywords = "";
	$uid = mysqli_real_escape_string($pdo, $_SESSION["sokoid"]);
	$subtotal = 0;
	$total = 0;
	$itemstotal = 0;
		
	
	$cartres = $pdo->query("SELECT * FROM cart WHERE user_id='$uid'");
	if($cartres->num_rows == 0){
		echo '<script>location.replace("cart.php");</script>';	
	}
	
	
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <h5>Set Up your Delivery Preferences</h5>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-lg-4 col-xl-3 order-md-2 mb-4 d-none d-lg-block">
			  <h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-muted">Your order</span>
				<span class="badge badge-secondary badge-pill"><?php echo $cartres->num_rows;?></span>
			  </h4>
			  <ul class="list-group mb-3">
				<?php 
					while($cartrow = $cartres->fetch_assoc()){
						$prodres = $pdo->query("SELECT * FROM products WHERE product_id=".$cartrow["product_id"]);
						$prodrow = $prodres->fetch_assoc();
						
						$subtotal = $prodrow["price"] * $cartrow["quantity"];
						$total += $subtotal;
						$itemstotal += $subtotal;
				?>
				
				<li class="list-group-item d-flex justify-content-between lh-condensed">
				  <div>
					<h6 class="my-0 text-capitalize"><?php echo $prodrow["name"];?></h6>
					<small class="text-orange">Qty <?php echo $cartrow["quantity"];?></small>
				  </div>
				  <span style="width:50%" class="text-muted text-right">Ksh <?php echo number_format($subtotal);?></span>
				</li>
				
					<?php } ?>
				<li class="list-group-item d-flex justify-content-between">
				  <span>Delivery Fee</span>
				  <strong class=" text-orange">N/A</strong>
				</li>
				<li class="list-group-item d-flex justify-content-between">
				  <span>Total (Ksh)</span>
				  <strong>Ksh <?php echo number_format($total);?></strong>
				</li>
			  </ul>

			  <div class="card p-2">
				<a class="btn btn-default btn-block" href="cart.php">Edit Cart</a>
			  </div>
			</div>
		
			<div class="col-lg-8 col-12 order-md-1">
			
			<?php 
				$shopqry = "SELECT * FROM cart JOIN products ON cart.product_id=products.product_id WHERE cart.user_id='$uid' GROUP BY products.shop_id";
				$shopres = $pdo->query($shopqry);
				while($shoprow = $shopres->fetch_assoc()){
					$shopdetailsres = $pdo->query("SELECT * FROM shop WHERE shop_id=".$shoprow["shop_id"]);
					$shodetailsrow = $shopdetailsres->fetch_assoc();
					$logo = (!empty($shodetailsrow["logo"])) ? 'logos/'.$shodetailsrow['logo'] : 'img/default1.jpg';
			?>
			  <!-- Order of single shop box -->
			  <div class="card card-solid container">
				  <div class="row">
					  <div class="col-sm-6 pt-2">
						<div class="user-panel d-flex">
							<div class="image">
							  <img src="<?php echo $logo;?>" class="img-circle elevation-2" alt="<?php echo $shodetailsrow['name'];?>">
							</div>
							<div class="info">
							  <a href="shop.php?shop=<?php echo $shodetailsrow['shop_id'];?>" class="d-block text-secondary text-capitalize"><?php echo $shodetailsrow['name'];?></a>
							</div>
						  </div>
					  </div>
					  <div class="col-sm-6 d-none d-sm-block">
					  <div class="justify-content-end d-flex pt-2">
						<a href="shop.php?shop=<?php echo $shodetailsrow['shop_id'];?>" class="btn btn-sm btn-link"><span class="text-muted">Visit Shop >></span></a>
					  </div>
					  </div>
				  </div>
				  <hr/>
				<div class="row">
					<div class="col-sm-6 ">
					<?php 
						$proqry = "SELECT cart.*, products.*, cart.quantity AS cartqty FROM cart JOIN products ON cart.product_id=products.product_id WHERE cart.user_id='$uid' AND products.shop_id=".$shodetailsrow['shop_id'];
						$prores = $pdo->query($proqry);
						while($prorow = $prores->fetch_assoc()){
							$pid = $prorow["product_id"];
							$imgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type = '1'";
							$imgres = $pdo->query($imgqry);
							if($imgres->num_rows == 0){
								$prodimg = "img/default.jpg";
							}else{
								$imgrow = $imgres->fetch_assoc();
								$prodimg = "products/".$imgrow["name"];
							}
					?>
					  <div class="d-flex">
						<div class="image">
							<img src="<?php echo $prodimg;?>" style="max-width:75px;max-height:75px">
						</div>
						<div class="d-block pl-2">
							<a href="product.php" class="text-secondary text-capitalize"><?php echo $prorow["name"];?></a><br/>
							<span class="text-orange">Quantity:  <?php echo $prorow["cartqty"];?><small class="ml-3 text-muted">Ksh <?php echo number_format($prorow["price"]);?> each</small></span><br/>
							<span class="text-dark ">Subtotal: Ksh <?php echo number_format($prorow["price"] * $prorow["cartqty"]);?></span>
							
						</div>
					  </div>
					  <hr>
				<?php }?>
					</div>
					<div class="col-sm-1 d-none d-sm-block border-right">
					</div>
					<div class="col-sm-5">
						<h6 class="text-muted text-orange text-center">Delivery Method</h6>
						<div class="text-left text-muted text-sm">
							<p>
								Delivery To:<br/><!--or Pick Up at-->
								Mark Anthony Maina<br/>
								PoshMart, KEMU, North Imenti, Meru<br/>
								+254 715694859 <br/>
								<span class="text-bold">Delivery Cost: Ksh 300</span> <br/>
							</p>
							<div class="justify-content-around d-flex">
								<button class="btn btn-sm bg-orange" id="<?php echo $shodetailsrow['shop_id'];?>" data-toggle="modal" data-target="#modal-del">Change Address</button>
								<a class="btn btn-sm btn-default">View Shop Delivery Policy</a>
							  </div>
						</div>
						<hr>
					</div>
				</div>
			  </div>
			  <!-- /.card -->
				<?php } ?>
			  
			  
		
		 <!-- Order of single shop box -->
			  <div class="card card-solid container">
				  <div class="row">
					  <div class="col-sm-6 pt-2">
						<div class="user-panel d-flex">
							<div class="image">
							  <img src="img/epica.jpg" class="img-circle elevation-2" alt="User Image">
							</div>
							<div class="info">
							  <a href="shop.php" class="d-block text-muted">Epica Jewery Limited</a>
							</div>
						  </div>
					  </div>
					  <div class="col-sm-6 d-none d-sm-block">
					  <div class="justify-content-around d-flex pt-2">
						<a class="btn btn-sm btn-default">Visit Shop</a>
						<a class="btn btn-sm bg-secondary">View Shop Policy</a>
					  </div>
					  </div>
				  </div>
				  <hr/>
				<div class="row">
					<div class="col-sm-6 ">
					  <div class="d-flex">
						<div class="image">
							<img src="img/product01.jpg" style="max-width:75px;max-height:75px">
						</div>
						<div class="d-block pl-2">
							<a href="product.php" class="text-muted">Tinkonana Hand bag with side pockets full of stupid money</a><br/>
							<span class="text-orange">Quantity: 1</span><br/>
							<span class="text-dark ">Subtotal: Ksh 3,400</span><small class="float-right text-muted">(Ksh 1200 each)</small>
							
						</div>
					  </div>
					  <hr>
					</div>
					<div class="col-sm-1 d-none d-sm-block border-right">
					</div>
					<div class="col-sm-5">
						<h6 class="text-muted text-orange text-center">Delivery Method</h6>
						<div class="text-left text-muted text-sm">
							<p>
								Delivery To:<br/><!--or Pick Up at-->
								Mark Anthony Maina<br/>
								PoshMart, KEMU, North Imenti, Meru<br/>
								+254 715694859 <br/>
								<span class="text-bold">Delivery Cost: Ksh 300</span> <br/>
							</p>
							<div class="justify-content-around d-flex">
								<a class="btn btn-sm bg-orange">Change Address</a>
								<a class="btn btn-sm btn-default">View Shop Delivery Policy</a>
							  </div>
						</div>
						<hr>
					</div>
				</div>
			  </div>
			  <!-- /.card -->
			  
			   <!-- Order of single shop box -->
			  <div class="card card-solid container">
				  <div class="row">
					  <div class="col-sm-6 pt-2">
						<div class="user-panel d-flex">
							<div class="image">
							  <img src="img/logo.png" class="img-circle elevation-2" alt="User Image">
							</div>
							<div class="info">
							  <a href="shop.php" class="d-block text-muted">Llana House Cart Kenya Limited</a>
							</div>
						  </div>
					  </div>
					  <div class="col-sm-6 d-none d-sm-block">
					  <div class="justify-content-around d-flex pt-2">
						<a class="btn btn-sm btn-default">Visit Shop</a>
						<a class="btn btn-sm bg-secondary">View Shop Policy</a>
					  </div>
					  </div>
				  </div>
				  <hr/>
				<div class="row">
					<div class="col-sm-6 ">
					  <div class="d-flex">
						<div class="image">
							<img src="img/cake1.jpg" style="max-width:75px;max-height:75px">
						</div>
						<div class="d-block pl-2">
							<a href="product.php" class="text-muted">Britania Chocolate mixed with fish beef tins</a><br/>
							<span class="text-orange">Quantity: 3</span><br/>
							<span class="text-dark ">Subtotal: Ksh 3,400</span><small class="float-right text-muted">(Ksh 1200 each)</small>
							
						</div>
					  </div>
					  <hr>
					</div>
					<div class="col-sm-1 d-none d-sm-block border-right">
					</div>
					<div class="col-sm-5">
						<h6 class="text-muted text-orange text-center">Delivery Address</h6>
						<div class="text-center">
							<small>You have not entered a delivery address.</small>
							<button class="btn btn-block bg-orange">Select a delivery method
							</button>
						</div>
						<hr>
					</div>
				</div>
			  </div>
			  <!-- /.card -->
			  
			  <!-- Order total box -->
			  <div class="card card-solid container">
				  <div class="card-body container">
					<span class="justify-content-between d-flex "><span>Items total</span><span>Ksh <?php echo number_format($itemstotal);?></span></span>
					<span class="justify-content-between d-flex "><span>Delivery Cost</span><span>N/A</span></span>
					<span class="justify-content-between d-flex "><span>VAT</span><span>N/A</span></span><hr>
					<span class="justify-content-between d-flex text-bold"><span class="text-bold">Total</span><span>Ksh <?php echo number_format($total);?></span></span><hr>
					<small class="text-muted">*You will be able to add coupons in the next page</small>
				  </div>
			  </div>
			  <!-- /.card -->
			  
			  <div class="card card-solid container">
				  <div class="card-body container">
					<a class="btn btn-block bg-orange" href="checkout.php"><span class="text-bold text-white">PROCEED TO PAYMENT</span></a>
					<a class="btn btn-block bg-white d-lg-none" href="cart.php"><span class="text-bold text-orange fa fa-shopping-cart"> Modify Cart</span></a>
				  </div>
			  </div>
			  <!-- /.card -->
		
			</div>
		</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- ./wrapper -->


<!-- MODALS -->

<div class="modal fade" id="modal-del">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Select Delivery Option</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
					<h6 class="text-muted text-orange text-center">Billing Address</h6>
					<div class="text-left text-muted text-sm">
						<p>
							Mark Anthony Maina<br/>
							+254 715694859 <br/>
						</p>
						<div class="justify-content-start d-flex">
							<a class="btn btn-sm bg-orange">Change</a>
						</div>
					</div>
					<hr/>
					
					<h6 class="text-muted text-orange text-center">Select your delivery</h6>
					<ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active text-orange" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Delivery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-orange" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Pick Up</a>
              </li>
            </ul>
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                  <div class="form-group">
					<label>Delivery location</label>
					<textarea class="form-control" rows=4 ></textarea>
                  </div>
				  <div class="form-group">
					<label>County</label>
					<select class="form-control" >
						<option>Tharaka Nithi</option>
					</select>
                  </div>
				  <div class="form-group">
					<label>City</label>
					<select class="form-control" >
						<option>Kaaga</option>
					</select>
                  </div>
				  <div class="form-group">
					<button class="btn btn-block bg-orange"><span class="text-white">Set Delivery</span></button>
				  </div>
              </div>
              <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                 <div class="form-group">
					<label>Pick Up Stations</label>
					<select class="form-control" >
						<option>Rahimtulla Trust Building 2nd Floor Store 004, Moi Avenue, CBD, Nairobi</option>
					</select>
                  </div>
				  <div class="form-group">
					<button class="btn btn-block bg-orange"><span class="text-white">Set Pick Up</span></button>
				  </div>
              </div>
            </div>
					
					
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
</body>
</html>