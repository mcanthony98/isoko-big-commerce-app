<?php
	session_start();
	require "includes/connect.php";
	require "processes/sokofunctions.php";
	$headtitle = "Shopping Cart - I-Soko";
	$headdesc = "Online Sellers for Televisions, Electronics, Clothes, Jewelery, Fashion, Mobile Phones";
	$headkeywords = "Shopping Cart, Online Sellers ,Televisions, Electronics, Clothes, Jewelery, Fashion, Mobile Phones";
	
?>
<?php include "includes/header.php";?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <?php include "includes/navbar.php";?>
  <?php include "includes/messages.php";?>
  <!-- /.navbar -->

 <?php if(isset($_SESSION["sokoid"])){ ?> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <h4>Shopping Cart (<?php echo $navcartres->num_rows;?> items)</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	
	<?php if($navcartres->num_rows == 0){?>
	<!--Empty cart Default box -->
      <div class="card card-solid p-btm">
        <div class="card-body">
			<p class="text-center text-muted text-xl"><i class="fa fa-shopping-cart"></i></p>
			<p class="text-center">Your Cart Is Empty!<br/><a href="index.php" class="btn btn-info btn-lg"><i class="fa fa-shopping-bag"></i> Shop Now</a></p>
		</div>
		</div>
	<?php }else{ ?>
	
      <!-- Default box -->
      <div class="card card-solid p-btm">
		<div class="card-header text-right">
				<a href="processes/cartprocesses.php?emptycart=<?php echo $usernavid;?>" class="btn btn-outline-danger btn-sm" onClick="return confirm('Are you sure you want to Empty your Cart?');"><i class="fa fa-trash"></i> Empty Cart</a>
		</div>
        <div class="card-body">
			<div class="d-none d-md-block">
			<div class="row p-btm text-bold ">
				<div class="col-md-6 text-center">
					Item
				</div>
				<div class="col-md-2">
					Quantity
				</div>
				<div class="col-md-2">
					Subtotal
				</div>
				<div class="col-md-2">
					Delete
				</div>
			</div>
			</div>
		<?php 
			
			$subtotal = 0;
			$total = 0;
			$where = "";
			while($row = $navcartres->fetch_assoc()){
				$pid = mysqli_real_escape_string($pdo, $row["product_id"]);
				$pqry = "SELECT * FROM products WHERE product_id = '$pid' AND status='0'";
				$pres=$pdo->query($pqry);
				$prow = $pres->fetch_assoc();
				$featimgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type='1'";
				$featimgres = $pdo->query($featimgqry);
				$featimgrow = $featimgres->fetch_assoc();
				$featprodimg = "products/".$featimgrow["name"];
				$shid = mysqli_real_escape_string($pdo, $prow["shop_id"]);
				$shqry = "SELECT * FROM shop WHERE shop_id = '$shid'";
				$shres=$pdo->query($shqry);
				$shrow = $shres->fetch_assoc();
				$subtotal = $prow["price"] * $row["quantity"];
				$total = $total + $subtotal;
				
				$where .= "subsubcategory_id = '".$prow["subsubcategory_id"]."' OR ";
					?>
          <div class="row border-top product-cover p-btm">
		  <span class="d-md-none" id="<?php echo "item".$row["cart_id"];?>"></span>
			<div class="col-md-6">
				<div class="row">
					<div class="col-4">
						<img src="<?php echo $featprodimg;?>" style="max-width:80px;max-height:80px" alt="">
					</div>
					<div class="col-8 text-capitalize text-left">
						<?php echo $prow["name"];?>
						<div class="text-orange">
							Ksh <?php echo number_format($prow["price"]); ?>
						</div>
						<div class="text-muted text-sm">
							Seller: <?php echo $shrow["name"];?>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-2 col-sm-4 col-6">
				<div class="row">
					<div class="col-12">
						<form method="POST" action="processes/cartprocesses.php">
						<div class="form-group">
							<span class="d-md-none" >Quantity: </span>
							<select class="form-control" name="qty" style="max-width:70px;" OnInput = "this.form.submit();" required>
								<option value=""><?php echo $row["quantity"];?></option>
								<?php for($i=1; $i <= $prow["quantity"]; $i++){?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php if($i==30){break;}?>
								<?php } ?>
							</select>
						</div>
						<input type="hidden" name="personcurrently" value="<?php echo $usernavid;?>" required>
						<input type="hidden" name="pid" value="<?php echo $row["cart_id"];?>" required>
						</form>
					</div>
				</div>	
			</div>
			<div class="col-md-2 col-sm-4 col-6">
				<div class="row text-center">
					<div class="col-12 mt-3 d-md-none">
						Subtotal:
					</div>
					<div class="col-12 text-bold p-btm">
						<span class="text-orange">Ksh <?php echo number_format($subtotal);?></span>
					</div>
				</div>	
			</div>
			<div class="col-md-2 col-sm-4">
				<div class="row">
					<div class="col-12 product-cover">
						<a href="processes/cartprocesses.php?delete=<?php echo $usernavid;?>&cid=<?php echo $row["cart_id"];?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Remove</a>
					</div>
				</div>
			</div>
          </div>
		<?php } ?>
		<div class="row border-top bg-light" style="padding:10px;font-size:17px">
			<div class="col-md-6">
			</div>
			<div class="col-6 col-md-2 text-bold ">
				Total<br/> <span class="text-sm">(<?php echo $navcartres->num_rows;?> Items)</span>
			</div>
			<div class="col-6 col-md-2 col-xl-1 text-bold text-orange product-cover text-right">
				<span class="text-right">Ksh <?php echo number_format($total);?></span>
			</div>
			<div class="col-xl-3 text-right">
				<span class="text-sm text-muted">* Delivery charges not included</span><br/>
				<span class="text-sm text-muted">* You may add coupons in the next step</span>
			</div>
		</div>
        </div>
        <!-- /.card-body -->
		<div class="card-footer text-center">
					<a class="btn btn-block bg-white d-none d-lg-block" href="index.php"><span class="text-bold text-orange"> Back to Shopping</span></a>
			<a class="btn bg-orange" href="delivery.php"><span class="text-bold text-white">PROCEED TO CHECKOUT</span></a>
					<a class="btn btn-block bg-white d-lg-none" href="index.php"><span class="text-bold text-orange"> Back to Shopping</span></a>
		</div>
      </div>
      <!-- /.card -->
			  
		<!-- You may also like Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-orange card-outline">
              <div class="card-header">
                <h4 class="card-title">You may also like</h4>
              </div>
              <div class="card-body">
                 <div class="row">
				<?php 
					$where = substr($where, 0, -3);
					$alsoqry = "SELECT * FROM products WHERE $where AND status='0' ORDER BY view_counter DESC LIMIT 12";
					$alsores = $pdo->query($alsoqry);
					while($alsorow = $alsores->fetch_assoc()){
						$alsopid = $alsorow["product_id"];
						$imgqry = "SELECT * FROM product_photos WHERE product_id='$alsopid' AND type='1'";
						$imgres = $pdo->query($imgqry);
						$imgrow = $imgres->fetch_assoc();
						$prodimg = "products/".$imgrow["name"];
				?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                   <a href="product.php?product=<?php echo $alsorow["product_id"];?>" data-toggle="tooltip" title="<?php echo $alsorow["name"]; ?>">
					  <img src="<?php echo $prodimg;?>" class="img-fluid mb-2" alt="<?php echo $alsorow["name"];?>"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 displayname text-secondary"><?php echo $alsorow["name"];?></div>
						<div class="col-6"><h6">Ksh <?php echo $alsorow["price"];?></h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<?php rating($alsorow["rating"], $alsorow["no_of_reviews"]);?>
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
  
  
  
  
  
 <?php } }elseif(isset($_SESSION["sokoshoppingcart"])){?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-light" style="min-height: 568px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-12">
            <h4>Shopping Cart (<?php echo count($_SESSION["sokoshoppingcart"]);?> items)</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
	
	<?php if(count($_SESSION["sokoshoppingcart"]) == 0){?>
	<!--Empty cart Default box -->
      <div class="card card-solid p-btm">
        <div class="card-body">
			<p class="text-center text-muted text-xl"><i class="fa fa-shopping-cart"></i></p>
			<p class="text-center">Your Cart Is Empty!<br/><a href="index.php" class="btn btn-info btn-lg"><i class="fa fa-shopping-bag"></i> Shop Now</a></p>
		</div>
		</div>
	<?php }else{ ?>
	
      <!-- Default box -->
      <div class="card card-solid p-btm">
		<div class="card-header text-right">
				<a href="processes/cartprocesses.php?emptycart" class="btn btn-outline-danger btn-sm" onClick="return confirm('Are you sure you want to Empty your Cart?');"><i class="fa fa-trash"></i> Empty Cart</a>
		</div>
        <div class="card-body">
			<div class="d-none d-md-block">
			<div class="row p-btm text-bold ">
				<div class="col-md-6 text-center">
					Item
				</div>
				<div class="col-md-2">
					Quantity
				</div>
				<div class="col-md-2">
					Subtotal
				</div>
				<div class="col-md-2">
					Delete
				</div>
			</div>
			</div>
		<?php 
			
			$subtotal = 0;
			$total = 0;
			$where = "";
			foreach($_SESSION["sokoshoppingcart"] as $pid => $qty) {
				$pid = mysqli_real_escape_string($pdo, $pid);
				$qty = mysqli_real_escape_string($pdo, $qty);
				$pqry = "SELECT * FROM products WHERE product_id = '$pid' AND status='0'";
				$pres=$pdo->query($pqry);
				$prow = $pres->fetch_assoc();
				$featimgqry = "SELECT * FROM product_photos WHERE product_id='$pid' AND type='1'";
				$featimgres = $pdo->query($featimgqry);
				$featimgrow = $featimgres->fetch_assoc();
				$featprodimg = "products/".$featimgrow["name"];
				$shid = mysqli_real_escape_string($pdo, $prow["shop_id"]);
				$shqry = "SELECT * FROM shop WHERE shop_id = '$shid'";
				$shres=$pdo->query($shqry);
				$shrow = $shres->fetch_assoc();
				$subtotal = $prow["price"] * $qty;
				$total = $total + $subtotal;
				
				$where .= "subsubcategory_id = '".$prow["subsubcategory_id"]."' OR ";
					?>
          <div class="row border-top product-cover p-btm">
		  <span class="d-md-none" id="<?php echo "item".$pid;?>"></span>
			<div class="col-md-6">
				<div class="row">
					<div class="col-4">
						<img src="<?php echo $featprodimg;?>" style="max-width:80px;max-height:80px" alt="">
					</div>
					<div class="col-8 text-capitalize text-left">
						<?php echo $prow["name"];?>
						<div class="text-orange">
							Ksh <?php echo number_format($prow["price"]); ?>
						</div>
						<div class="text-muted text-sm">
							Seller: <?php echo $shrow["name"];?>
						</div>
						
					</div>
				</div>
			</div>
			<div class="col-md-2 col-sm-4 col-6">
				<div class="row">
					<div class="col-12">
						<form method="POST" action="processes/cartprocesses.php">
						<div class="form-group">
							<span class="d-md-none" >Quantity: </span>
							<select class="form-control" name="qty" style="max-width:70px;" OnInput = "this.form.submit();" required>
								<option value=""><?php echo $qty;?></option>
								<?php for($i=1; $i <= $prow["quantity"]; $i++){?>
								<option value="<?php echo $i;?>"><?php echo $i;?></option>
								<?php if($i==30){break;}?>
								<?php } ?>
							</select>
						</div>
						<input type="hidden" name="pid" value="<?php echo $pid;?>" required>
						</form>
					</div>
				</div>	
			</div>
			<div class="col-md-2 col-sm-4 col-6">
				<div class="row text-center">
					<div class="col-12 mt-3 d-md-none">
						Subtotal:
					</div>
					<div class="col-12 text-bold p-btm">
						<span class="text-orange">Ksh <?php echo number_format($subtotal);?></span>
					</div>
				</div>	
			</div>
			<div class="col-md-2 col-sm-4">
				<div class="row">
					<div class="col-12 product-cover">
						<a href="processes/cartprocesses.php?delete=<?php echo $pid;?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Remove</a>
					</div>
				</div>
			</div>
          </div>
		<?php } ?>
		<div class="row border-top bg-light" style="padding:10px;font-size:17px">
			<div class="col-md-6">
			</div>
			<div class="col-6 col-md-2 text-bold ">
				Total<br/> <span class="text-sm">(<?php echo count($_SESSION["sokoshoppingcart"]);?> Items)</span>
			</div>
			<div class="col-6 col-md-2 col-xl-1 text-bold text-orange product-cover text-right">
				<span class="text-right">Ksh <?php echo number_format($total);?></span>
			</div>
			<div class="col-xl-3 text-right">
				<span class="text-sm text-muted">* Delivery charges not included</span><br/>
				<span class="text-sm text-muted">* You may add coupons in the next step</span>
			</div>
		</div>
        </div>
        <!-- /.card-body -->
		<div class="card-footer text-center">
					<a class="btn btn-block bg-white d-none d-lg-block" href="index.php"><span class="text-bold text-orange"> Back to Shopping</span></a>
			<a class="btn bg-orange" href="login.php?return=cart.php"><span class="text-bold text-white">PROCEED TO CHECKOUT</span></a>
					<a class="btn btn-block bg-white d-lg-none" href="index.php"><span class="text-bold text-orange"> Back to Shopping</span></a>
		</div>
      </div>
      <!-- /.card -->
			  
		<!-- You may also like Items -->
		<div class="row product-cover">
          
          <div class="col-12">
            <div class="card card-orange card-outline">
              <div class="card-header">
                <h4 class="card-title">You may also like</h4>
              </div>
              <div class="card-body">
                <div class="row">
				<?php 
					$where = substr($where, 0, -3);
					$alsoqry = "SELECT * FROM products WHERE $where AND status='0' ORDER BY view_counter DESC LIMIT 12";
					$alsores = $pdo->query($alsoqry);
					while($alsorow = $alsores->fetch_assoc()){
						$alsopid = $alsorow["product_id"];
						$imgqry = "SELECT * FROM product_photos WHERE product_id='$alsopid' AND type='1'";
						$imgres = $pdo->query($imgqry);
						$imgrow = $imgres->fetch_assoc();
						$prodimg = "products/".$imgrow["name"];
				?>
				  <div class="col-xl-2 col-md-3 col-sm-4  col-6 bordr-top shadow-sm zoom product-cover">
                   <a href="product.php?product=<?php echo $alsorow["product_id"];?>" data-toggle="tooltip" title="<?php echo $alsorow["name"]; ?>">
					  <img src="<?php echo $prodimg;?>" class="img-fluid mb-2" alt="<?php echo $alsorow["name"];?>"/>
					  <div class="row text-dark borde">
						<div style="font-size:14px" class="col-12 displayname text-secondary"><?php echo $alsorow["name"];?></div>
						<div class="col-6"><h6">Ksh <?php echo $alsorow["price"];?></h6></div>
						<div style="font-size:8px;text-align:right" class="col-6 float-right text-warning ">
						<?php rating($alsorow["rating"], $alsorow["no_of_reviews"]);?>
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
 <?php } }else{ ?>
	<!--Empty cart Default box -->
      <div class="card card-solid p-btm">
        <div class="card-body">
			<p class="text-center text-muted text-xl"><i class="fa fa-shopping-cart"></i></p>
			<p class="text-center">Your Cart Is Empty!<br/><a href="index.php" class="btn btn-info btn-lg"><i class="fa fa-shopping-bag"></i> Shop Now</a></p>
		</div>
		</div>
 
 <?php }?>
  
  
  
  
  
  

  <!-- Main Footer -->
<?php include "includes/footer.php";?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php include "includes/scripts.php";?>
</body>
</html>