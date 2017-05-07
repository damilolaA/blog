<?php
	
	session_start();

	include 'includes/functions.php';

	checkLogin();

	$title = 'View Blog';

	include 'includes/admin_header.php';

	include 'includes/db.php';



?>
	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>Admin Name</th>
						<th>Title</th>
						<th>Post</th>
						<th>Date</th>
						<th>edit</th>
						<th>delete</th>
						<th>Archive</th>
					</tr>
				</thead>
				<tbody>
					<?php

					$bring = viewPost($conn); echo $bring;
				
					?>
          		</tbody>
			</table>
		</div>

		<div class="paginated">
			<a href="#">1</a>
			<a href="#">2</a>
			<span>3</span>
			<a href="#">2</a>
		</div>
	</div>
<?php

	include 'includes/admin_footer.php';

?>