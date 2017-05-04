<?php
	
	session_start();


	include 'includes/functions.php';

	//checkLogin();

	# determine if user is loggcheckLogin();

	$title = 'Add Products';

	include 'includes/admin_header.php';

	include 'includes/db.php';

	$errors = [];

	if(array_key_exists('add', $_POST)) {

		if(empty($_POST['title'])) {
			$errors['title'] = 'Please enter book title';
		}

		if(empty($_POST['post'])) {
			$errors['post'] = 'Please enter a blog post';
		}


		if(empty($errors)) {

		/*	$clean = array_map('trim', $_POST);
			$clean['img'] = $destination;

			addProducts($conn, $clean);

			redirect('add_products.php', "");

			*/

		}
	}
?>
	<div class="wrapper">
		<div id="stream">
			<form id="register"  action ="admin_home.php" method ="POST" enctype="multipart/form-data">

			<div>
				<?php displayError($errors, 'title'); ?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="title">
				
			</div>

			<div>
				<?php displayError($errors, 'post'); ?>
				<label>Post:</label>
			<!--	<input type="text" name="author" placeholder="author">  -->
				<textarea class="text-field" name="post" placeholder="write something" ></textarea>
			</div>

				<input type="submit" name="add" value="Add">
				</form>
		</div>
	</div>

<?php

	include 'includes/admin_footer.php';

?>