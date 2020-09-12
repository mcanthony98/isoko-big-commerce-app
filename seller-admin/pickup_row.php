<?php
	session_start();
    require "../includes/connect.php";
    require "includes/sessions.php";
	
	$shid = mysqli_real_escape_string($pdo, $_SESSION["sokoshop"]);
	
	if(isset($_POST["picid"])){
		$id = mysqli_real_escape_string($pdo, $_POST["picid"]);
		
		$res = $pdo->query("SELECT * FROM shop_pickup WHERE id='$id'");
		$row = $res->fetch_assoc();
		
		$coures = $pdo->query("SELECT * FROM county WHERE county_id=".$row["county_id"]);
		$courow = $coures->fetch_assoc();
		
		$cires = $pdo->query("SELECT * FROM city WHERE city_id=".$row["city_id"]);
		$cirow = $cires->fetch_assoc();
		
		$output = "";
		
		$output .= '<div class="col-lg-12">
						 <div class="form-group">
							<label>Location</label>
							<small>Make it very precise and specific</small>
							<textarea class="form-control" name="location" rows=3 placeholder="Eg Rahimtulla Trust Building, 2nd Floor, Store 002, Moi Avenue, Nairobi" required>'.$row["location"].'</textarea>
						 </div>
					</div>
					<div class="col-lg-4">
						 <div class="form-group">
							<label>Region</label>
							<select class="form-control city_view" name="county" style="max-width:200px;" required>
							<option value="'.$courow["county_id"].'">'.$courow["county_name"].'</option>
							';
		
									$countymodalres = $pdo->query("SELECT * FROM county ORDER BY county_name");
									while($countymodalrow = $countymodalres->fetch_assoc()){
	
								$output .='<option value="'.$countymodalrow["county_id"].'">'.$countymodalrow["county_name"].'</option>';
									}
				$output .= '</select>
						 </div>
					</div>
					<div class="col-lg-4">
						 <div class="form-group" id="city-disp">
							<label>City/Place</label>
							<select class="form-control" name="city" style="max-width:200px;">
								<option value="'.$cirow["city_id"].'">'.$cirow["city_name"].'</option>';
								
								$citymodalres = $pdo->query("SELECT * FROM city WHERE county_id=".$row["county_id"]);
								while($citymodalrow = $citymodalres->fetch_assoc()){
										$output .= '
											<option value="'.$citymodalrow["city_id"].'">'.$citymodalrow["city_name"].'</option>
										';			
								}
								
								
				$output .='</select>
						 </div>
					</div>
					
					<div class="col-6 col-lg-4">
						<div class="form-group">
						<label for="">Station Open From</label>
						<div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" name="open" value="'.$row["open_time"].'" class="form-control datetimepicker-input" data-target="#timepicker" style="max-width:100px" required />
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
                      <input type="text" name="close" value="'.$row["close_time"].'" class="form-control datetimepicker-input" data-target="#timepickerc" style="max-width:100px" required />
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
							<input type="number" class="form-control" value="'.$row["cost"].'" name="cost" min=0 id="exampleInputEmail1" placeholder="Cost">
						</div>
					</div>
					<div class="col-lg-4">
						<label for="">Order is ready for pick up in (Days)</label>
						<select class="form-control" name="period" style="max-width:70px;" required>
								<option value="'.$row["period"].'">'.$row["period"].'</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
						</select>
					</div>
					<input type="hidden" name="pickid" value='.$id.'>
					';
			$output .= "
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
<script>  
 $(document).ready(function(){   
	  $('.city_view').on(\"keyup input\", function(){
           var county = $(this).val();
           $.ajax({  
                url:\"../processes/city_row.php\",  
                method:\"POST\",  
                data:{conty:county},  
                success:function(data){  
                     $('#city-disp').html(data);  
                }  
           });  
      });  
 });  
 </script>
			";		
		
			echo $output;
	}
?>