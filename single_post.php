
<?php 
include('include/session_controller.php'); 
include('include/functions.php'); 
include('include/header.php'); 
?>

  <title>Blog Post - Start Bootstrap Template</title>
</head>

<body>


<?php include('include/navbar.php'); ?>

<?php
  $post_id = (int) filter_var($_GET['show_post'], FILTER_SANITIZE_NUMBER_INT);

  $post_vals = get_posts(-1, -1, -1, $post_id);
  $post = $post_vals->fetch_assoc();

  $user_details = get_user_details($_SESSION['user_id'])->fetch_assoc();

  //print_r($user_details);

?>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8" style="margin: 0 auto;">

        <!-- Title -->
        <h1 class="mt-4"> <?php echo $post['post_title']; ?> </h1>

        <!-- Author -->
        <p class="lead">
          by
          <a href="#"> <?php echo $user_details['user_firstname']; ?> </a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p> <?php echo "Posted on ".date( "l h:ia d:M:Y" ,strtotime($post['post_time'])); ?> </p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo $post['post_img_url']; ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead">
        <?php echo $post['post_text']; ?>
        </p>

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form <?php echo $_SERVER['PHP_SELF']; ?> method="post" >
              <div class="form-group">
                <textarea class="form-control" rows="3" name="comment_text" required></textarea>
              </div>
              <button type="submit" name="push_comment_button" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>

        <script>
        document.quert
        </script>
<?php
//get all comments
$post_id = $_GET['show_post'];
$comment_query = "SELECT * FROM ".ALL_COMMENTS_TABLE." INNER JOIN user_details on post_comments.user_id=user_details.user_id WHERE ".ALL_COMMENTS_TABLE.".".POST_ID."=$post_id ";


$comment_data = $GLOBALS['conn']->query($comment_query);
//print_r($comment_data);
while($data = $comment_data->fetch_array()):
  $profile_img = $data['user_profile_img_url'];
  if($profile_img=="") $profile_img="http://placehold.it/50x50";
?>
        <!-- Single Comment -->
        <div class="media mb-4">
          <img class="d-flex mr-3 rounded-circle" src="<?php echo $profile_img; ?>" alt="">
          <div class="media-body">
            <h5 class="mt-0"><?php echo $data['user_firstname']." ".$data['user_lastname']; ?> 
          
          <!-- Example split danger button -->
          <?php if($data['user_id']==$_SESSION['user_id']): ?>

          <div class="btn-group">
            <button type="button" class="btn dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="edit_bro.php?edit_comment_id=<?php 
              echo $data['comment_id']; ?> ">Edit</a>

              <a class="dropdown-item" href="#">Delete</a>
            </div>
          </div>

         <?php endif; ?>

          </h5>
            <?php echo $data['comment_text']; ?>

          </div>
        </div>

<?php endwhile; ?>

      </div>

      <!-- Sidebar Widgets Column -->
      <!-- <div class="col-md-4"> -->

        <!-- Search Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div> -->

        <!-- Categories Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->

        <!-- Side Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>
-->
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->


<?php include('include/footer.php'); ?>
