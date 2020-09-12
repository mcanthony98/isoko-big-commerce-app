<?php
	session_start();
    require "../includes/connect.php";
	
	$shid = mysqli_real_escape_string($pdo, $_SESSION["sokoshop"]);
	
	if(isset($_POST["conty"])){
		$id = mysqli_real_escape_string($pdo, $_POST["conty"]);
		$output = "";
		
		$output .= '<label>City/Place</label>
					<select class="form-control" name="city" style="max-width:200px;" required>
					';
								
		$citymodalres = $pdo->query("SELECT * FROM city WHERE county_id='$id'");
		while($citymodalrow = $citymodalres->fetch_assoc()){
				$output .= '
					<option value="'.$citymodalrow["city_id"].'">'.$citymodalrow["city_name"].'</option>
				';			
		}
		$output .= '</select>';
		
		echo $output;
		
	}
?>	