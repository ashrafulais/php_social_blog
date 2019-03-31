<?php
include('include/session_controller.php');
include('include/functions.php');
include('include/header.php');
?>

    <title>Hello, Blog</title>

  </head>
  <body>


<?php include('include/navbar.php'); ?>

<div class="container">
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create_post">Create New Post</button>
<div id="create_post" class="collapse" style="width: 500px;background-color: #99999955; margin: 5px auto; padding: 5px;">
  <h2>New Post</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="inputTitle">Post Title *Max 190 chars</label>
      <input type="text" class="form-control" name="post_title" id="inputTitle" placeholder="What do you want to name your post ?" >
    </div>
    <div class="form-group">
      <label for="comment">Post Content *</label>
      <textarea class="form-control" rows="5" id="comment" name="post_text" placeholder="Write your post here." ></textarea>
    </div>

    <div class="form-group">
      <label for="file_input">Post Image *5MB Max</label>
      <input type="file" name="fileToUpload" class="form-control-file border" id="file_input" >
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Select Category</label>
      <select class="form-control" name="post_category" id="exampleFormControlSelect1">
        <option value="programming">Programming</option>
        <option value="travelling">Travelling</option>
        <option value="story">Story</option>
        <option value="science">Science</option>
        <option value="undefined">Undefined</option>
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Post Status</label>
      <select class="form-control" name="post_status" id="exampleFormControlSelect2">
        <option value="published">Publish Now</option>
        <option value="draft">Save as Draft</option>
      </select>
    </div>

    <button type="submit" name="user_new_post_submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>

<!-- ================================
  Posts will be shown here now
 ==================================== -->


<div class="container">
<div class="display-4 text-center">Your All Posts</div>
<hr>
<div class="row text-center">

  <?php /*
    $pageid=-1;
    $post_vals = get_posts($pageid, $_SESSION['user_id'], -1);
    while($post = $post_vals->fetch_array()):
        $post_text_str=$post['post_text'];
        */
    ?>
  <?php
    $page_id = filter_input(INPUT_GET, 'show_post_page', FILTER_SANITIZE_NUMBER_INT) ?? 1;
    $uid = $_SESSION['user_id'];

    $total_rows = get_posts(-1, -1, $uid)->num_rows;
    $posts_per_page = 2;
    $numof_pages = intval( $total_rows / $posts_per_page );
    $numof_pages += ($total_rows%$posts_per_page) !=0 ? 1 : 0;

    if($page_id > $numof_pages) {
      $page_id = 1;
    }

    $post_vals = get_posts($page_id, $posts_per_page, $uid);
    while($post = $post_vals->fetch_array()):
      $post_text_str=$post['post_text'];

  ?>

    <div class="col-lg-3 col-md-6 mb-4">
      <div class="card h-50">
        <img class="card-img-top" src="<?php echo $post['post_img_url']; ?>" alt="thumb image">
        <div class="card-body">
          <h4 class="card-title">  <?php echo $post['post_title']; ?>  </h4>
          <!-- <p class="card-text"> Cat: <?php echo $post['post_category']; ?>  </p>
          <p class="card-text"> At: <?php echo $post['post_time']; ?>  </p> -->
          <p class="card-text"> <?php echo substr($post_text_str, 0, 30)."..."; ?>  </p>
        </div>
        <div class="card-footer">
          <a href="single_post.php?show_post=<?php echo $post['post_id']; ?>" target="_blank" class="btn btn-primary">Find Out More!</a>

          <a href="edit_bro.php?edit_post_id=<?php echo $post['post_id']; ?>" class="btn btn-info "> <i class="far fa-edit"></i> </a>
          <a href="#" class="btn btn-danger"> <i class="far fa-trash-alt"></i> </a>
        </div>
      </div>
    </div>

<?php endwhile; ?>

    </div>
    <!-- /.row -->
    <?php include('include/paginator.php'); ?>

</div>
<!-- /.container -->


<?php include('include/footer.php');

/*
if( isset($_SESSION['loggedin']) && isset($_SESSION['user_id']) ){
  $pageid=1;
  $post_vals = get_posts($pageid, $_SESSION['user_id']);
}
while($post = $post_vals->fetch_array()):
  <?php echo $post['post_img_url']; ?>

*/
?>
