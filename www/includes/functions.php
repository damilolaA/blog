<?php

	function displayError($err, $name) {

		if(isset($err[$name])) {
			echo '<span class= err>'.$err[$name].'</span>';
		}
	}


	function adminRegister($dbconn, $input) {

		$stmt = $dbconn->prepare("INSERT INTO admin(fname, lname, email, hash) VALUES(:f, :l, :e, :h)");

		$data = [
				 ':f' => $input['fname'],
				 ':l' => $input['lname'],
				 ':e' => $input['email'],
				 ':h' => $input['password']
				];

		$stmt->execute($data);
	}


	function doesEmailExists($dbconn, $email) {

		$result = false;

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :e");

		$stmt->bindParam(':e', $email);
		$stmt->execute();

		$count = $stmt->rowCount();

		if($count > 0) {
			$result = true;
		}
		return $result;
	}




?>