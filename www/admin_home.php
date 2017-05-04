<?php
	
	session_start();



	include 'includes/db.php';

	include 'includes/functions.php';

	checkLogin();

	$id = $_SESSION['id'];
	
	//checkLogin();

	# determine if user is loggcheckLogin();

	$title = 'Add Post';

	include 'includes/admin_header.php';

	$errors = [];

	if(array_key_exists('add', $_POST)) {

		if(empty($_POST['title'])) {
			$errors['title'] = 'Please enter book title';
		}

		if(empty($_POST['content'])) {
			$errors['content'] = 'Please enter a blog post';
		}

		if(empty($errors)) {

			$clean = array_map('trim', $_POST);

			$clean['aid'] = $id;

			$clean['post'] = htmlspecialchars($clean['post']);

			addPost($conn, $clean);

			redirect('view_post.php', "");

			
		}
	}
?>
	<div class="wrapper">
		<div id="stream">
			<form id="register"  action ="admin_home.php" method ="POST">

			<div>
				<?php displayError($errors, 'title'); ?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="title">
				
			</div>

			<div>
				<?php displayError($errors, 'content'); ?>
				<label>Post:</label>
			<!--	<input type="text" name="author" placeholder="author">  -->
				<textarea class="text-field" name="content" placeholder="write something" ></textarea>
			</div>

		<!--	<div>
				<?php displayError($errors, 'date'); ?>
				<label>Date:</label>
				<input type="text" name="date" placeholder="date">
				
			</div>			-->



				<input type="submit" name="add" value="Add">
				</form>
		</div>
	</div>

<?php

	include 'includes/admin_footer.php';

?>