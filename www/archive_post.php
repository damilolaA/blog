<?php
	
	include 'includes/functions.php';

	include 'includes/admin_header.php';

	include 'includes/db.php';

	if(isset($_GET['post_id'])) {

		$postID = $_GET['post_id'];
	}

	addArchive($conn, $postID);
	redirect('view_post.php', "");


?>