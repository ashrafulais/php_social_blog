<?php 
/*Include session in these pages

index, empty_page, login, signup
profile, single_post, user_posts

*/
include('include/session_controller.php');

include('include/functions.php');

include('include/header.php'); 

?>

  <title>Heroic Features - Start Bootstrap Template</title>

</head>

<body>

<?php include('include/navbar.php'); ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <!-- <header class="jumbotron my-4">
      <h1 class="display-3">A Warm Welcome!</h1>
      <p class="lead">This blog is author's first php application.</p>
      <a href="https://linkbasebd.gq" target="blank" class="btn btn-primary btn-lg">Click For Nothing</a>
    </header> -->

<!-- ================================ 
Posts will be shown here now
==================================== -->
    <div class="row text-center">

    <?php ?>
    <?php 
      $page_id = filter_input(INPUT_GET, 'show_post_page', FILTER_SANITIZE_NUMBER_INT) ?? 1;

      $total_rows = get_posts()->num_rows;
      $posts_per_page = 8;
      $numof_pages = intval( $total_rows / $posts_per_page );
      $numof_pages += ($total_rows%$posts_per_page) !=0 ? 1 : 0;

      if($page_id > $numof_pages) {
        $page_id = 1;
      }

      $post_vals = get_posts($page_id, $posts_per_page);
      while($post = $post_vals->fetch_array()):
        $post_text_str=$post['post_text'];
    ?>
      
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-80">
        <img class="card-img-top" src="<?php echo $post['post_img_url']; ?>" alt="thumb image">
        <div class="card-body">
          <h4 class="card-title">  <?php echo $post['post_title']; ?>  </h4>
          <p class="card-text"> <p class="card-text"> <?php echo substr($post_text_str, 0, 30)."..."; ?>  </p> </p>
        </div>
        <div class="card-footer">
      <?php if( $is_loggedin ): ?>
          <a href="single_post.php?show_post=<?php echo $post['post_id']; ?>" target="_blank class="btn btn-primary">Find Out More!</a>
      <?php endif; ?>
      <?php if( !$is_loggedin ): ?>
          <a href="login.php" class="btn btn-primary">Login for more</a>
      <?php endif; ?>
        </div>
      </div>
    </div>

      <?php endwhile; ?>



    </div>
    <!-- /.row -->
  
  <?php include('include/paginator.php'); ?>


</div>
<!-- /.container -->


<?php include('include/footer.php'); ?>
