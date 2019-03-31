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
<?php ?>

<?php

if(isset($_GET['edit_post_id'])):

$edit_post_id = sanitize_number($_GET['edit_post_id']);
$post_data = get_posts(-1,-1,-1, $edit_post_id)->fetch_assoc();
if(count($post_data) > 0 && $post_data['user_id']==$_SESSION['user_id']):

  
  //print_r($post_data);
?>

  <h2>Edit Your Post</h2> 
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <p> <?php //echo file_exists($post_data['post_img_url']); ?> </p>
      <label for="inputTitle">Post Title *Max 190 chars </label>
      <input type="text" class="form-control" name="post_title" id="inputTitle" placeholder="What do you want to name your post ?" value="<?php echo $post_data['post_title']??""; ?>" required>
    </div>
    <div class="form-group">
      <label for="comment">Post Content *</label>
      <textarea class="form-control" rows="5" id="comment" name="post_text" placeholder="Write your post here." required> <?php echo $post_data['post_text'] ?> </textarea>
    </div>

    <div class="form-group">
      <label for="file_input">Post Image *5MB Max</label>
      <input type="file" name="fileToUpload" class="form-control-file border" id="file_input" >
    </div>
    <!-- Make a hidden input type and use the image url -->
    <input type="hidden" name="prev_img_url" value="<?php echo $post_data['post_img_url']; ?>" >

    <input type="hidden" name="the_post_id" value="<?php echo $post_data['post_id']; ?>" >

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

    <button type="submit" name="user_post_update_btn" class="btn btn-primary">Update</button>
  </form>
</div>
<?php //else: header("Location: error404.php"); ?>

<?php
endif;
elseif(isset($_GET['edit_comment_id'])):
  $cmnt_id = sanitize_number($_GET['edit_comment_id']);
?>

<!-- Comments Form -->
<div class="card my-4">
  <h5 class="card-header">Leave a Comment:</h5>
  <div class="card-body">
    <form <?php echo $_SERVER['PHP_SELF']; ?> method="post" >
      <div class="form-group">
        <textarea class="form-control" rows="3" name="comment_text" required></textarea>
      </div>
      <button type="submit" name="update_comment_button" class="btn btn-primary">Submit</button>

      <input type="hidden" name="hidden_cmnt_id" value="<?php echo $cmnt_id; ?>" >
    </form>
  </div>
</div>

<?php 
elseif(isset($_GET['update_profile'])):

?>

<!-- =========================== -->
<h1>Update your profile</h1>


<!-- ============================= -->
<?php endif; ?>

<?php include('include/footer.php'); ?>
