<?php

	function displayError($err, $name) {

		if(isset($err[$name])) {
			echo '<span class= err>'.$err[$name].'</span>';
		}
	}

	function redirect($loc, $msg) {

		header('Location: '.$loc.$msg);
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


	function adminLogin($dbconn, $input) {

		$result = [];

		$stmt = $dbconn->prepare("SELECT admin_id, hash FROM admin WHERE email = :e");

		$stmt->bindParam(':e', $input['email']);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		if(($stmt->rowCount() != 1) || !password_verify($input['password'], $row['hash'])) {
			
			redirect("admin_login.php?msg=", "invalid email and/or password");
			exit();

		}else {
			$result[] = true;
			$result[] = $row['admin_id'];
		}
		return $result;
	}




?>