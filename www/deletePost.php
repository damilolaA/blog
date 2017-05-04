<?php

	session_start();

	include 'includes/functions.php';

	checkLogin();

	include 'includes/db.php';

	if(isset($_GET['post_id'])) {
		$postID = $_GET['post_id'];
	}

	deletePost($conn, $postID);

	redirect('view_post.php', "");




?>