<?php 
	
	function redirect_to($new_location){
		header("Location: $new_location");
		exit;
	}

	function redirect_to_with_get($new_location, $get_name,$get_value){
		header("Location: {$new_location}?{$get_name}={$get_value}");
		exit;
	}

?>