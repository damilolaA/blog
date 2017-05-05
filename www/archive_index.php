<?php

  include 'includes/index_header.php';

  include 'includes/functions.php';

  include 'includes/db.php';

  if(isset($_GET['post_id'])) {

    $postID = $_GET['post_id'];
  }


?>


    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

        <?php 

        $bring = getArchivePost($conn, $_GET['post_id']); echo $bring;

        ?>

     </div>
     
      <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>

     	</div>    

     </div>