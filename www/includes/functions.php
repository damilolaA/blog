<?php

	function displayError($err, $name) {

		if(isset($err[$name])) {
			echo '<span class= err>'.$err[$name].'</span>';
		}
	}




?>