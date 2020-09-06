<?php
	session_start();	
	require "../includes/connect.php";
	require "includes/sessions.php";



	if(isset($_POST['viewdesc_id'])){
		$id = $_POST['viewdesc_id'];
		

		$stmt = "SELECT * FROM products WHERE product_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		
		echo $row["description"] ;
		
		
	}elseif(isset($_POST['editprod_id'])){
		$shop = $_SESSION["shop"];
		$id = $_POST['editprod_id'];
				

		$stmt = "SELECT * FROM products WHERE product_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		$catid = $row["category_id"];
		$custid = $row["custom_category_id"];
		
			//single category
		$catstmt = "SELECT * FROM category WHERE category_id = '$catid'";
		$catres = $pdo->query($catstmt);
		$catrow = $catres->fetch_assoc();
		
		//all categories
		$catsstmt = "SELECT * FROM category";
		$catsres = $pdo->query($catsstmt);
		
			//single custom category
		$cstmt = "SELECT * FROM custom_category WHERE category_id = '$custid'";
		$cres = $pdo->query($cstmt);
		$crow = $cres->fetch_assoc();
			if($custid == 0){
				$ptn = '<option value="0"></option>';
			}else{
				$ptn = '<option value="'.$crow["category_id"].'">'.$crow["category_name"].'</option>';
			}
		
		//all custom categories
		$custstmt = "SELECT * FROM custom_category WHERE shop_id='$shop'";
		$custres = $pdo->query($custstmt);
		
		
		$output = '
		<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card card-outline card-warning">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card-body" >
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name (Max 50 Characters)</label>
                    <input type="text" class="form-control" name="pname" id="exampleInputEmail1" value="'.$row["name"].'">
                  </div>
					<div class="row">
					 <div class="col-md-4">
					  <div class="form-group">
						<label for="exampleInputPassword1">Main Category</label>
						<select id="exampleInputPassword1" name="category" class="form-control">
							<option value="'.$catrow["category_id"].'">'.$catrow["category"].'</option>
							';
							
						while($catsrow = $catsres->fetch_assoc()){
							$output = 	$output.'<option value="'.$catsrow["category_id"].'">'.$catsrow["category"].'</option>';
						}	
							
		$output = 	$output.'	
						</select>
					   </div>
					  </div>
					  <div class="col-md-4">
					  <div class="form-group">
						<label for="exampleInputPassword2">Sub-Category</label>
						<select id="exampleInputPassword2" name="subcategory" class="form-control">
							<option>Not yet.</option>
							<option>1</option>
							<option>1</option>
						</select>
					   </div>
					  </div>
					  <div class="col-md-4">
					  <div class="form-group">
						<label for="exampleInputPassword3">Custom-Category</label>
						<select id="exampleInputPassword3" name="custcategory" class="form-control">
							'.$ptn
						;
						
						while($custrow = $custres->fetch_assoc()){
							$output = 	$output.'<option value="'.$custrow["category_id"].'">'.$custrow["category_name"].'</option>';
						}	
						
		$output = $output.'				
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
                  <input type="number" class="form-control" name="price" id="exampleInputEmail2" value="'.$row["price"].'" >
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
                    <input type="number" class="form-control" name="quantity" id="exampleInputEmail3" value="'.$row["quantity"].'">
                  </div>
                </div>
				<input type="hidden" name="proid" value="'.$id.'">
                </div>
                </div>
                <!-- /.card-body -->

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
		
		';
		
		echo $output;
	
	
	}elseif(isset($_POST['proddet_id'])){
		
		$id = $_POST['proddet_id'];
		

		$stmt = "SELECT * FROM products WHERE product_id = '$id'";
		$res = $pdo->query($stmt);
		$row = $res->fetch_assoc();
		$catid = $row["category_id"];
		$custid = $row["custom_category_id"];
		
		if($row["no_of_reviews"] == 0){
			$rating = '0 Reviews';
		}else{
			$rate = $row["rating"] / $row["no_of_reviews"];
			$roundrate = (round($rate));
			$rating = $roundrate.'/5 from '.$row["no_of_reviews"].' Review(s)';
		}
		
		// Fetch feature photo
		$picstmt = "SELECT * FROM product_photos WHERE product_id = '$id' AND type = 1  ORDER BY photo_id DESC LIMIT 1";
	   $picres = $pdo->query($picstmt);
	   if($picres->num_rows < 1){ 
			$pic = '../products/camera1.png';
	   }else{
		   $picrow = $picres->fetch_assoc();
		   $pic = '../products/'.$picrow["name"];
	   }
	   
	   // Fetch main category
	   	$catstmt = "SELECT * FROM category WHERE category_id = '$catid'";
		$catres = $pdo->query($catstmt);
		$catrow = $catres->fetch_assoc();
		
		//single custom category
		$cstmt = "SELECT * FROM custom_category WHERE category_id = '$custid'";
		$cres = $pdo->query($cstmt);
		$crow = $cres->fetch_assoc();
			if($custid == 0){
				$ptn = 'value=""';
			}else{
				$ptn = 'value="'.$crow["category_name"].'"';
			}
		
		$output = '
			<div class="container">
					<div class="card card-widget widget-user-2 shadow-sm">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-warning">
                <div class="widget-user-image">
                  <img class="img-circle elevation-2" src="'.$pic.'" style="height:70px;width:70px" alt="Product">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">'.$row["name"].'</h3>
				<div class="float-right custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="customSwitch3">
                      <label class="custom-control-label" for="customSwitch3"> Active</label>
                 </div>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Customer Rating <span class="float-right badge bg-secondary">'.$rating.'</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Product Views <span class="float-right badge bg-info">'.$row["view_counter"].'</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Price <span class="float-right badge bg-success">Ksh '.$row["price"].'.00</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Quantity Available <span class="float-right badge bg-danger">'.$row["quantity"].'</span>
                    </a>
                  </li>
				  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Product link  <small>*You can share your product link for marketting purposes.</small>
					  <div class="input-group input-group-sm">
					  <input type="text" class="form-control" value="localhost/shopika/product.php?shop='.$_SESSION['shop'].'&product='.$id.'" id="myInput" readonly >
					  <span class="input-group-append">
						<button type="button" class="btn btn-info btn-flat" onclick="myFunction()">Copy</button>
					  </span>
					</div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group">
                        <label>Main Category</label>
                        <input type="text" class="form-control" value="'.$catrow["category"].'" disabled>
                     </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
                        <label>Sub-Category</label>
                        <input type="text" class="form-control" value="N/A" disabled>
                     </div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
                        <label>Custom Category</label>
                        <input type="text" class="form-control" '.$ptn.' disabled>
                     </div>
				</div>
				<div class="row">
				<div class="col-12">
				<div style="text-align:right"class="text-secondary">
					<p>Uploaded: '.date('M d, Y', strtotime($row['upload_date'])).'<br/>
					Last Modified: '.date('M d, Y', strtotime($row['date_modified'])).'</p>
				</div>
				</div>
				</div>
			</div>
				</div>
		
			<div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
			  <button type="button" class="btn btn-sm btn-info view_desc" id="'.$id.'" data-dismiss="modal" data-toggle="modal" data-target="#modal-desc"><i class="fa fa-search"></i>Description</button>
              <a class="btn btn-sm btn-success" href="add_photo.php?product='.$id.'"><i class="fas fa-image"></i> Images</a>
			  <button type="button" class="btn btn-sm btn-primary edit_prod" id="'.$id.'" data-dismiss="modal" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-pencil-alt"></i> Edit</button>
			  <a href="../processes/productprocesses.php?delete='.$id.'" onClick="return confirm(\'Are you sure you want to delete?\');" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</a>
            </div>
		';
		
		
		echo $output;
		
		
	}
?>