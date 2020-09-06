<?php

function rating(int $rating, int $reviews) {
	if($reviews == 0){
		echo '
			<i class="far fa-star"></i>
			<i class="far fa-star"></i>
			<i class="far fa-star"></i>
			<i class="far fa-star"></i>
			<i class="far fa-star "></i>
		';
	}else{
		$rate = $rating/$reviews;
		$rate = (round($rate));
		$limit = 5 - $rate;
		
		for($i=1; $i<=$rate; $i++){
			echo '<i class="fa fa-star"></i>';
		}
		for($i=1; $i<=$limit; $i++){
			echo '<i class="far fa-star"></i>';
		}

	}
}

function rating2(int $rating, int $reviews) {
	$output = "";
	if($reviews == 0){
		$output .= '
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star"></i>
				<i class="far fa-star "></i>
			';
	}else{
		$rate = $rating / $reviews;
		$rate = (round($rate));
		$limit = 5 - $rate;
		
		for($i=1; $i<=$rate; $i++){
			$output .= '<i class="fa fa-star"></i>';
		}
		for($i=1; $i<=$limit; $i++){
			$output .= '<i class="far fa-star"></i>';
		}

	}
	
	return $output;
}


?>