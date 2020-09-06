<aside class="main-sidebar sidebar-light-warning elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
				<?php 
				$logo = (!empty($logo_row["logo"])) ? '../logos/'.$logo_row['logo'] : '../img/default1.jpg';
				?>
          <img src="<?php echo $logo;?>" class="img-circle elevation-2" alt="Logo">
        </div>
        <div class="info">
          <a href="#" class="d-block text-sm"><?php echo $logo_row["name"];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="index.php" class="nav-link <?php if ($sdpg==1){ echo "active";}?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="orders.php" class="nav-link <?php if ($sdpg==2){ echo "active";}?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Orders
				<span class="badge badge-info right">6</span>
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="customers.php" class="nav-link <?php if ($sdpg==3){ echo "active";}?>">
              <i class="nav-icon fas fa-users"></i>
              <p>
                My Customers
              </p>
            </a>
          </li>
          <li class="nav-header">MANAGE</li>
          <li class="nav-item">
            <a href="products.php" class="nav-link <?php if ($sdpg==4){ echo "active";}?>">
              <i class="nav-icon fa fa-suitcase"></i>
              <p>
                Products
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="categories.php" class="nav-link <?php if ($sdpg==5){ echo "active";}?>">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview <?php if ($sdpg==61 || $sdpg==62 || $sdpg==63){ echo "menu-open";}?>">
            <a href="#" class="nav-link <?php if ($sdpg==61 || $sdpg==62 || $sdpg==63){ echo "active";}?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                My Shop
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview ml-2">
              <li class="nav-item">
                <a href="shopoutlook.php" class="nav-link <?php if ($sdpg==61){ echo "active";}?>">
                  <i class="fas fa-desktop nav-icon"></i>
                  <p>Shop Outlook</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="shopinfo.php" class="nav-link <?php if ($sdpg==62){ echo "active";}?>">
                  <i class="fas fa-wrench nav-icon"></i>
                  <p>Shop Info</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="shoppolicy.php" class="nav-link <?php if ($sdpg==63){ echo "active";}?>">
                  <i class="fas fa-paste nav-icon"></i>
                  <p>Shop Policy</p>
                </a>
              </li>
            </ul>
          </li>
		  <li class="nav-item">
            <a href="notifications.php" class="nav-link <?php if ($sdpg==7){ echo "active";}?>">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Notifications
				<span class="badge badge-info right">6</span>
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="subscriptions.php" class="nav-link <?php if ($sdpg==8){ echo "active";}?>">
              <i class="nav-icon fas fa-paper-plane"></i>
              <p>
                My Subscriptions
              </p>
            </a>
          </li>
         </ul> 
		 
		 <!--<div class="info-box bg-info">
              <div class="info-box-content">
                <p>Shop Active: 18 days remaining</p>
              </div>
             </div>-->
			 
			 <?php
			date_default_timezone_set("Africa/Nairobi");
			$now = date("Y-m-d H:i:s");
			$date1=date_create($logo_row["expiry_date"]);
			$date2=date_create("$now");
			$diff=date_diff($date2,$date1);

?>
			<?php
			if($logo_row["status"] == 0 OR $logo_row["status"] == 1){
			if($date2 > $date1){
				$_SESSION["side-error"] = 'Your Shop is Inactive. Please pay your subscription fee to continue to enjoy Shopika services.'; 
			}else{
				$_SESSION["side-info"] = "Shop Active. ". $diff->format("%a") ." days remaining";
			}
			}elseif($logo_row["status"] == 2){
				$_SESSION["side-error"] = 'Shop is Blacklisted. Contact Customer Care.';
			}elseif($logo_row["status"] == 4){
				$_SESSION["side-warning"] = 'Shop is Closed. Shop is currently not visible to customers.';
			}
			?>
			
			<?php if (isset($_SESSION["side-error"])){ ?>		
			<div class="info-box bg-error">
			<div class="info-box-content">
			<?php echo $_SESSION["side-error"]; ?>
			</div>
			</div>
			<?php unset($_SESSION["side-error"]);} if (isset($_SESSION["side-info"])){ ?>		
			<div class="info-box bg-info">
			<div class="info-box-content">
			<?php echo $_SESSION["side-info"]; ?>
			</div>
			</div>
			<?php unset($_SESSION["side-info"]);} if (isset($_SESSION["side-warning"])){ ?>	
			<div class="info-box bg-warning">
			<div class="info-box-content"> 
			<?php echo $_SESSION["side-warning"]; ?>
			</div>
			</div>
			<?php unset($_SESSION["side-warning"]);} ?>	
          
		  
      </nav>
      <!-- /.sidebar-menu -->
    </div>
 </aside>