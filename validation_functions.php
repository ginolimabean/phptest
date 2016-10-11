<?php

	function has_presence($value) {
		return isset($value) && $value !== "";
	}

	function form_errors($errors = array()) {
		$output = "";
		if(!empty($errors)){
			$output .= "<div class=\"errors\">";
			$output .= "Please fix the following: ";
			$output .= "<ul>";
			foreach($errors as $error)
			{
				$output .= "<li>" . $error . "</li>";
			}
			$output .= "</ul>";
			$output .= "</div>";
		}
		return $output;
	}

?>