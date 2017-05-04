<?php
	
	include 'includes/admin_header.php';

	include 'includes/db.php';

	include 'includes/functions.php';

	$errors = [];

	if(array_key_exists('register', $_POST)) {

		if(empty($_POST['fname'])) {
			$errors['fname'] = "Please enter first name";
		}

		if(empty($_POST['lname'])) {
			$errors['lname'] = "Please enter last name";
		}

		if(empty($_POST['email'])) {
			$errors['email'] = 'Please enter email address';
		}

		if(empty($_POST['password'])) {
			$errors['password'] = "Please enter password";
		}

		if(empty($_POST['pword'])) {
			$errors['pword'] = "Please confirm password";
		}

		if($_POST['pword'] != $_POST['password']) {
			$errors['pword'] = "password does not match";
		}

		$check = doesEmailExists($conn, $_POST['email']);

		if($check) {$errors['email'] = "Email already exists"; }


		if(empty($errors)) {

			$clean = array_map('trim', $_POST);

			$hash = password_hash($clean['password'], PASSWORD_BCRYPT);

			$clean['password'] = $hash;

			adminRegister($conn, $clean);

		}
	}

?>

	<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php displayError($errors, 'fname'); ?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>

			<div>
				<?php displayError($errors, 'lname'); ?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php displayError($errors, 'email'); ?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>

			<div>
				<?php displayError($errors, 'password'); ?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php displayError($errors, 'pword'); ?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>

		<h4 class="jumpto">Have an account? <a href="admin_login.php">login</a></h4>
	</div>

<?php

	include 'includes/admin_footer.php';

?>