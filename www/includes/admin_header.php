<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
	<section>
		<div class="mast">
			<h1>SWAP<span> BLOG</span></h1>
			<nav>
				<ul class="clearfix">
					<li><a href="admin_home.php" <?php curNav('admin_home.php'); ?> >add posts</a></li>
					<li><a href="view_post.php" <?php curNav('view_post.php'); ?> >view posts</a></li>
					<li><a href="admin_login.php" <?php curNav('admin_login.php'); ?> >login</a></li>
					<li><a href="register.php" <?php curNav('register.php'); ?>>register</a></li>
					<li><a href="admin_logout.php">logout</a></li>
				</ul>
			</nav>
		</div>
	</section>
	