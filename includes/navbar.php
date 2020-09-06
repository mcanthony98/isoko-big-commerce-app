   <?php
		if(isset($_SESSION["sokoid"])){
		 if(isset($_SESSION["sokoshoppingcart"])){
			foreach($_SESSION["sokoshoppingcart"] as $pid => $qty) {
					$sokobid = mysqli_real_escape_string($pdo, $_SESSION["sokoid"]);
					$qty = mysqli_real_escape_string($pdo, $qty);
					$pid = mysqli_real_escape_string($pdo, $pid);
					
					$cartloginres = $pdo->query("SELECT * FROM cart WHERE user_id='$sokobid' AND product_id='$pid'");
					if($cartloginres->num_rows == 0){
						$cart_insert = "INSERT INTO cart(user_id, product_id, quantity) VALUES ('$sokobid', '$pid', '$qty')";
						$pdo->query($cart_insert);
					}else{
						$cart_insert = "UPDATE cart SET quantity=quantity+$qty WHERE product_id='$pid' AND user_id='$sokobid'";
						$pdo->query($cart_insert);
					}
		   }
		   unset($_SESSION['sokoshoppingcart']);
		 }
		}
  
  ?>
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg navbar-light navbar-white">
    <div class="container-fluid">
      
	  <a href="index.php" class="navbar-brand">
        <img src="img/isoko4.JPG" alt="isoko Logo" class="brand-image" >
      </a>
	  
     <!-- SEARCH FORM -->
        <form class="order-3 order-lg-1 col-11 col-lg-6 ml-0 ml-md-3" id="searchnav" align="center" novalidate action="search.php">
		<div class="header-search">
          <div class="input-group input-group border border-dark rounded-pill">
            <input class="form-control border border-white rounded-pill search-input" name="search" type="search" placeholder="Search product or shop" aria-label="Search" required autocomplete="off" >
            <div class="input-group-append rounded-pill">
              <button class="btn bg-white btn-navbar rounded-pill" type="submit">
                <i class="fas fa-search text-dark"> <span class=""></span></i>
              </button>
            </div>
          </div>
		  <div class="sresult shadow mt-1 ml-3 rounded text-left displayname" id="navsearch">
		  </div>
          </div>
        </form>
				
      <!-- Right navbar links -->
      <ul class="order-1 order-lg-3 navbar-nav navbar-no-expand ml-auto mb-3">
	   <?php 
		if(isset($_SESSION["sokoseller"])){
		?>
        <li class="nav-item text-center border-right">
          <a class="nav-link"  href="seller-login.php" role="button"  data-toggle="tooltip" title="Shop Manager">
            <i class="fas fa-tags text-success"></i> <br/><span class="d-none d-xl-block text-sm">Shop Manager</span>
          </a>
        </li>
		<?php }else{?>
		<li class="nav-item text-center border-right">
          <a class="nav-link"  href="sell-on-isoko.php" role="button"  data-toggle="tooltip" title="Sell on I-Soko">
            <i class="fas fa-tags text-success"></i> <br/><span class="d-none d-xl-block text-sm">Sell on I-Soko</span>
          </a>
        </li>
		<?php 
		}
		if(isset($_SESSION["sokoid"])){
		?>
        <li class="nav-item text-center dropdown border-right">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link">
				<i class="fas fa-user text-orange text-lg"></i><br/>
				<span class="d-none d-xl-block text-capitalize text-sm"> <?php echo $_SESSION["sokofirstname"];?></span>
			</a>
			<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li class=" d-block d-sm-none"><a href="#" class="dropdown-item">Notifications <i class="text-orange float-right fa fa-bell"></i> </a></li>
              <li><a href="#" class="dropdown-item">My Account </a></li>
              <li><a href="#" class="dropdown-item">My Orders</a></li>
              <li class="dropdown-divider text-orange"></li>
              <li class="bg-light"><a href="processes/logout.php" class="dropdown-item text-center text-bold">Logout</a></li>
            </ul>
        </li> 
		<li class="nav-item dropdown text-center border-right d-none d-sm-block">
          <a class="nav-link" data-toggle="dropdown" href="#"  data-toggle="tooltip" title="Notifications">
			<i class="fas fa-bell text-lg"></i> <br/><span class="d-none d-xl-block text-sm"><span class="badge badge-sm badge-danger"> 3 </span> Notifications</span>
			<span class="badge badge-danger navbar-badge text-sm d-xl-none">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../img/laikos.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Laikos Afrique
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../img/epica.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Epic Jewelery Limited
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../img/logo.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    E-Shop
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
		<?php 
		$usernavid = $_SESSION["sokoid"];
		$navcartres = $pdo->query("SELECT * FROM cart WHERE user_id='$usernavid'");
		?>
		<li class="nav-item text-center" style="padding-right:10px">
            <a href="cart.php" class="nav-link"  data-toggle="tooltip" title="My Cart">
				<i class="fas fa-shopping-cart text-lg"></i>
                <span class="badge btn btn-warning  navbar-badge text-dark text-sm" id="cartnumz"><?php echo $navcartres->num_rows;?></span><br/><span class="d-none d-xl-block text-sm">Cart</span>
			</a>
        </li>
		<?php }else{ ?>
			<li class="nav-item text-center border-right">
            <a href="cart.php" class="nav-link"  data-toggle="tooltip" title="My Cart">
				<i class="fas fa-shopping-cart text-lg"></i>
				<?php if(isset($_SESSION["sokoshoppingcart"])){?>
                <span class="badge btn btn-warning  navbar-badge text-dark text-sm" id="cartnumz"><?php echo count($_SESSION["sokoshoppingcart"]);?></span><br/>
				<?php }else{ ?>
				 <span class="badge btn btn-warning  navbar-badge text-dark text-sm" id="cartnumz"></span><br/>
				<?php }?>
				<span class="d-none d-xl-block text-sm">Cart</span>
			</a>
			</li>
			<li class="nav-item text-center ml-1 mb-1 " >
            <a href="login.php" class="nav-link btn btn-sm rounded bg-orange "  data-toggle="tooltip" title="Login">
			<span class="text-white "><u>Login</u></span>
			</a>
        </li>
		<?php }?>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->