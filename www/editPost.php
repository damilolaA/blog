<?php
	
	session_start();

	include 'includes/functions.php';

	checkLogin();

	$title = 'Edit Post';

	include 'includes/admin_header.php';

	include 'includes/db.php';

		if(isset($_GET['post_id'])) {
			$postID = $_GET['post_id'];
		}

		#get book object
		$item = getPostbyID($conn, $postID);

		$errors = [];

		if(array_key_exists("edit", $_POST)) {

			if(empty($_POST['title'])) {
				$errors['title'] = 'Please enter a book title';
			}

			if(empty($_POST['comment'])) {
				$errors['comment'] = 'Please enter a book author';
			}

		if(empty($errors)) {

			$clean = array_map('trim', $_POST);
			$clean['id'] = $postID;

			editPost($conn, $clean);

			redirect("view_post.php", "");

			
		
		}

	}
			

?>
	<div class="wrapper">
		<div id="stream">

			<h1 id="register-label">Edit Post</h1>
			<hr>

			<form id="register" method ="POST">

			<div> 
				<?php $bring = displayError($errors, 'title'); echo $bring;?>
				<label>Title:</label>
				<input type="text" name="title" value="<?php echo $item[1]; ?>">
				
			</div>
			<div>
				<?php displayError($errors, 'comment'); ?>			
				<label>Author:</label>
				<input type="text" name="comment" value="<?php echo $item[2]; ?>">
				
			</div>
			
				<input type="submit" name="edit" value="Edit">

				</form>
			
		</div>
				
	</div>
	
<?php

	include 'includes/admin_footer.php';

?>