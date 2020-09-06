<?php
	session_start();	
	require "includes/connect.php";
	$headtitle = "Shop at your Favorite Seller on I-Soko";
	$headdesc = "Online Sellers for Televisions, Electronics, Clothes, Jewelery, Fashion, Mobile Phones";
	$headkeywords = "Online Sellers ,Televisions, Electronics, Clothes, Jewelery, Fashion, Mobile Phones";
	
	if(isset($_GET["search"])){
		$search = mysqli_real_escape_string($pdo, $_GET["search"]);
		$qry = "SELECT * FROM shop WHERE name LIKE '%$search%' AND status='0'";
		$res=$pdo->query($qry);
	}elseif(isset($_GET["shopcat"])){
		$search = mysqli_real_escape_string($pdo, $_GET["shopcat"]);
		$catres = $pdo->query("SELECT * FROM category WHERE category_id = '$search'");
		$catrow = $catres->fetch_assoc();
		$catname = $catrow["category"];
		$headtitle = $catname;
		$qry = "SELECT * FROM shop WHERE category_id = '$search'  AND status='0'";
		$res=$pdo->query($qry);
	}else{
		$qry = "SELECT * FROM shop WHERE status='0'";
		$res=$pdo->query($qry);
		
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
        <div class="row">
          <div class="col-sm-8">
			<?php 
				if(isset($_GET["search"])){
					echo '<h5>Shops Containing "'.$_GET["search"].'"</h5>';
				}elseif(isset($_GET["shopcat"])){
					echo '<h5>'.$catname.' Stores</h5>';
				}
			?>
          </div>
		  <div class="col-sm-4">
			<span class="float-sm-right text-sm"><?php echo $res->num_rows;?> shops found</span>
		  </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-solid">
	  <?php if($res->num_rows == 0){?>
				<div class="card-body">
					 <div align="center" style="padding-top:30px" class="mr-auto">
					 <p class="text-bold">Sorry <?php if(isset($_SESSION["sokoid"])){echo $_SESSION["sokofirstname"];}?>!</p>
					 <span style='font-size:100px;'>&#128542;</span>
					 <p>No Results Found.</p>
					 <p class="text-muted"> Try searching for more general terms and avoid using words like "the, for,and" ...etc</p>
					 <p><a href="index.php" class="btn bg-orange"><span class="text-bold text-white">Go To Homepage</span></a></p>
					 </div>
				</div>
			<?php }else{ ?>
        <div class="card-body">
		<div class="row">
			<div class="col-3 d-none d-lg-block shadow-sm">
				tutajua tutaweka nini hapa.
			</div>
			<div class="col-lg-9">
				<div class="row">
			<?php 
				while($row=$res->fetch_assoc()){
					$logo = (!empty($row["logo"])) ? 'logos/'.$row['logo'] : 'img/default1.jpg';
					$avgqr = "SELECT AVG(rating), AVG(no_of_reviews) FROM products WHERE shop_id=".$row["shop_id"];
					$avgres=$pdo->query($avgqr);
					$avgrow=$avgres->fetch_assoc();
					if($avgrow["AVG(no_of_reviews)"] == 0){
						$rating = "N/A";
					}else{
					$rating = round($avgrow["AVG(rating)"]/$avgrow["AVG(no_of_reviews)"])."/5";
					}
					$shid = $row["shop_id"];
					$prores = $pdo->query("SELECT * FROM products WHERE shop_id=$shid AND status='0'");
					$ores = $pdo->query("SELECT * FROM orders WHERE seller_id=$shid");
					
					$catid = $row["category_id"];
					$catres = $pdo->query("SELECT * FROM category WHERE category_id = '$catid'");
					$catrow = $catres->fetch_assoc();
					$catname = $catrow["category"];
					
					
			?><a href="shop.php?shop=<?php echo $shid;?>">
			<div class="col-md-4 shadow-sm p-2 my-2 zoom">
				<div class="d-block text-right">
					<!--<small class="badge badge-danger"> <i class=" text-sm fa fa-star"></i> Recommended</small>-->
				</div>
				<div class="d-flex">
						<div class="image">
							<img src="<?php echo $logo;?>" style="max-width:75px;max-height:75px" alt="<?php echo $row["name"];?>">
						</div>
						<div class="d-block pl-2">
							<div style="line-height:100%;">
								<span class="text-secondary"><?php echo $row["name"];?></span><br/>
								<?php if(!isset($_GET["shopcat"])){?><small  class="text-orange"><?php echo $catname;?> Store</small><br/><?php } ?>
							</div>
							<div class="d-flex flex-row justify-content-around text-dark"  style="line-height:100%;">
							  <div class="p-2 text-sm">SALES<br/><small><?php echo $ores->num_rows;?> </small></div>
							  <div class="p-2 d-none d-sm-block border-left text-sm">PRODUCTS<br/><span class="text-sm"><?php echo $prores->num_rows;?> </span></div>
							  <div class="p-2 text-sm border-left">RATING<br/><span class="text-sm"><?php echo $rating;?></span></div>
							</div>
							
							</a>
						</div>
					  </div>
			</div>
			<?php } ?>
		  </div>
			</div>
		</div>
        </div>
        <!-- /.card-body -->
			<?php } ?>
      </div>
      <!-- /.card -->
			  
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