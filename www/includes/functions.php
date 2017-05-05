<?php

	function displayError($err, $name) {

		if(isset($err[$name])) {
			echo '<span class= err>'.$err[$name].'</span>';
		}
	}

	function redirect($loc, $msg) {

		header('Location: '.$loc.$msg);
	}


	function curNav($page) {
		$curPage = basename($_SERVER['SCRIPT_FILENAME']);

		if($curPage == $page) {
			echo 'class = "selected"';
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
			$result .= '<td>'.$row[4].'</td>';
			$result .= '<td><a href="editPost.php?post_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="deletePost.php?post_id='.$row[0].'">delete</a></td>';
			$result .= '<td><a href="archive_post.php?post_id='.$row[0].'">archive</a></td></tr>';
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


	function editPost($dbconn, $input) {

		$stmt = $dbconn->prepare("UPDATE blogpost SET title = :t, post = :p, post_date = NOW() WHERE post_id = :pid");

		$data = [
				 ':t' => $input['title'],
				 ':p' => $input['comment'],
				 ':pid' => $input['id']
				];

		$stmt->execute($data);
	}


	function deletePost($dbconn, $pid) {

		$stmt = $dbconn->prepare("DELETE FROM blogpost WHERE post_id = :pi");

		$stmt->bindParam(':pi', $pid);
		$stmt->execute();
	}


	function addArchive($dbconn, $pid) {

		$stmt = $dbconn->prepare("INSERT INTO archive(post_id, post_date) SELECT post_id, post_date FROM blogpost
											WHERE post_id = :pid");

		$stmt->bindParam(':pid', $pid);
		$stmt->execute();

	}


	function getAdmin($dbconn) {

		$stmt = $dbconn->prepare("SELECT * FROM admin");

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;
	}


	function getPost($dbconn) {

		$result = '';

		$stmt = $dbconn->prepare("SELECT * FROM blogpost");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {

			$result .= '<div class="blog-post">
           			   <h2 class="blog-post-title">'.$row[1].'</h2>
           			   <p class="blog-post-meta">'.$row[4].' by <a href="#">'.$row[3].'</a></p>
           			   <p>  '.$row[2].'  </p>';

		}
		return $result;
	}


	function getArchives($dbconn) {

		$result = '';

		$stmt = $dbconn->prepare("SELECT post_id, Date_format(post_date, '%M %Y') AS d FROM archive");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {

			$result .=  '<li><a href="archive_index.php?post_id='.$row[0].'">'.$row['d'].'</a></li>';
		}

		return $result;
	}


	function getArchivePost($dbconn, $pid) {

		$result = '';

		$stmt = $dbconn->prepare("SELECT * FROM blogpost WHERE post_id = :pid");

		$stmt->bindParam(':pid', $pid);
		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)) {

			$result .= '<div class="blog-post">
           			   <h2 class="blog-post-title">'.$row[1].'</h2>
           			   <p class="blog-post-meta">'.$row[4].' by <a href="#">Mark</a></p>
           			   <p>  '.$row[2].'  </p>';
		}
		return $result;
	}
	
?>