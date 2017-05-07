<?php

  include 'includes/index_header.php';

  include 'includes/functions.php';

  include 'includes/db.php';


?>


    <div class="container">

      <div class="row">

        <div class="col-sm-8 blog-main">

          <?php  

             $check = getPost($conn); echo $check;

          ?>

            
          </div><!-- /.blog-post -->

             <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
          </nav>


        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->


    </div><!-- /.container -->

    <?php
           $check = include 'includes/index_sidebar.php'; echo $check; 
               

     ?>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="JS/jquery-3.2.1.min.js" ></script>
   
    
    <script src="JS/bootstrap.min.js"></script>
    
  </body>
</html>

     <?php $show = include 'includes/index_footer.php'; echo $show; ?>