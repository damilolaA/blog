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


	function addPost($dbconn, $input) {

		$stmt = $dbconn->prepare("INSERT INTO blogpost(title, post, admin_id, post_date) VALUES(:t, :p, :ad, NOW())");

		$data = [
				  ':t' => $input['title'],
				  ':p' => $input['content'],
				  ':ad' => $input['aid'],
				//  ':d' => $input['date']
				];

		/*print_r($data); exit();*/

		$stmt->execute($data);
	}

	function checkLogin() {
		if(!isset($_SESSION['id'])) {
			redirect("admin_login.php", "");
		}
	}


	function viewPost($dbconn) {

		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM blogpost");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){

			$result .= '<tr><td>'.$row[0].'</td>';
			$result .= '<td>'.$row[1].'</td>';
			$result .= '<td>'.$row[2].'</td>';
			$result .= '<td>'.$row[3].'</td>';
			$result .= '<td><a href="editPost.php?post_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="delete_post.php?post_id='.$row[0].'">delete</a></td>';
			$result .= '<td><a href="archive.php?post_id='.$row[0].'">archive</a></td></tr>';
		}
		return $result;
	}


	function getPostbyID($dbconn, $pid) {

		$stmt = $dbconn->prepare("SELECT * FROM blogpost WHERE post_id = :pi");

		$stmt->bindParam(':pi', $pid);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);
	
		return $row;
		}
?>