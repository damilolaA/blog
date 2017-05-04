<?php
	
	session_start();

	include 'includes/functions.php';

	include 'includes/admin_header.php';

	$title = 'Admin Login';

	include 'includes/db.php';
	
	$errors = [];

	if(array_key_exists('login', $_POST)) {

		if(empty($_POST['email'])) {
			$errors['email'] = "Please enter email address";
		}

		if(empty($_POST['password'])) {
			$errors['password'] = "Please enter password";
		}

		if(empty($errors)) {

			$clean = array_map('trim', $_POST);

			$check = adminLogin($conn, $clean);

				$_SESSION['id'] = $check[1];

				redirect("admin_home.php", "");
			}

		}


?>
	
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="admin_login.php" method ="POST">

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

			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

<?php

	include 'includes/admin_footer.php';

?>