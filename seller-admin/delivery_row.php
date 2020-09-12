<?php
	session_start();
    require "../includes/connect.php";
    require "includes/sessions.php";
	
	$shid = mysqli_real_escape_string($pdo, $_SESSION["sokoshop"]);
	
	if(isset($_POST["del_ed"])){
		$delid = mysqli_real_escape_string($pdo, $_POST["del_ed"]);
		
		$qry = "SELECT * FROM shop_delivery WHERE id='$delid'";
		$res = $pdo->query($qry);
		$row = $res->fetch_assoc();
		
		$countyres = $pdo->query('SELECT * FROM county WHERE county_id='.$row["county_id"]);
		$countyrow = $countyres->fetch_assoc();
		
		$output = '
			<div class="col-lg-4">
						 <div class="form-group">
							<label>Location</label>
							<select class="form-control" name="county" style="max-width:200px;" required>
								<option value="'.$countyrow["county_id"].'">'.$countyrow["county_name"].'</option>
								';
				$countymodalres = $pdo->query("SELECT * FROM county ORDER BY county_name");
				while($countymodalrow = $countymodalres->fetch_assoc()){
				$output .= '
					<option value="'.$countymodalrow["county_id"].'">'.$countymodalrow["county_name"].'</option>
				';
				}
				
		$output .='
			</select>
						 </div>
					</div>
					<div class="col-lg-4">
						<div class="form-group">
							<label for="exampleInputEmail1">Cost (Ksh)</label>
							<input type="number" class="form-control" name="cost" value="'.$row["cost"].'" id="exampleInputEmail1" min="0" placeholder="Cost" required>
						</div>
					</div>
					<div class="col-lg-4">
						<label for="">Delivery period (Days)</label>
						<select class="form-control" name="period" style="max-width:70px;" required>
							<option value="'.$row["period"].'">'.$row["period"].'</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
		';			
		
		echo $output;
			
	}
?>