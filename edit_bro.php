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
<!-- . ==============================================
POST EDIT SECTION
. ============================================== -->
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

<!-- . ==============================================
Comment EDIT SECTION
. ============================================== -->

<?php
endif;
elseif(isset($_GET['edit_comment_id'])):

  $userid = $_SESSION['user_id'];

  $data = $GLOBALS['conn']->query("SELECT * FROM post_comments WHERE user_id=$userid");
  $cmnt_id = sanitize_number($_GET['edit_comment_id']);

  //print_r($data);
  if($data->num_rows>0):
?>

<!-- Comments Form -->
<div class="card my-4">
  <h5 class="card-header">Update Comment:</h5>
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

<!-- . ==============================================
Profile Update EDIT SECTION
. ============================================== -->
<?php 
endif;

elseif(isset($_GET['update_profile'])):
  $userid = sanitize_number($_GET['update_profile']);
  if($userid == $_SESSION['user_id']):

    //getting user informations
    $user_data = $GLOBALS['conn']->query("SELECT * FROM user_details WHERE user_id=$userid")->fetch_assoc();

?>

<!-- =========================== -->
<h1>Update your profile</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
  <div class="col-md-8 ">
    <?php  ?>
    <div class="form-row">
    <div class="form-group col-md-6">
      <label for="Firstname">Firstname</label>
      <input type="text" class="form-control" id="Firstname" name="firstname" placeholder="<?php echo $user_data['user_firstname']; ?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <label for="Lastname">Lastname</label>
      <input type="text" class="form-control" id="Lastname" name="lastname" placeholder="<?php echo $user_data['user_lastname']; ?>" disabled>
    </div>
  </div>
    
    <div class="form-group">
      <label for="exampleFormControlSelect2">Job Role</label>
      <select class="form-control" name="job_role" id="exampleFormControlSelect2" required>
        <option value="programmer">Programmer</option>
        <option value="developer">Developer</option>
        <option value="teacher">Teacher</option>
        <option value="student">Student</option>
        <option value="businessman">Businessman</option>
        <option value="confidential">Confidential</option>
        <option value="unemployed">Unemployed</option>
      </select>
    </div>
  <!-- <div class="form-row">
    <div class="form-group col-md-12">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="Email">
    </div>
  </div> -->
  <div class="form-group">
    <label for="file_input">Profile picture *5MB Max</label>
    <input type="file" name="fileToUpload" class="form-control-file border" id="file_input" >

    <input type="hidden" name="prev_profile_pic" value="<?php echo $user_data['user_profile_img_url']; ?>">
  </div>

  <div class="form-group">
    <label for="inputAddress">Birthdate *Give a fake one :D</label>
    <input type="date" class="form-control" id="inputAddress" name="birthdate" placeholder="1234 Main St" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">About Yourself *max 200 characters</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="about_user" rows="3" required></textarea>
  </div>
 

  <button type="submit" name="update_profile_btn" class="btn btn-primary">Update Profile</button>
    
  </div>
</form>

  <?php endif; ?>

<!-- . ==============================================
COMMENT DELETE CONFIRMATION
. ============================================== -->

<?php 
elseif(isset($_GET['delete_comment_id'])):

  $userid = $_SESSION['user_id'];
  $cmnt_id = sanitize_number($_GET['delete_comment_id']);

  $data = $GLOBALS['conn']->query("SELECT * FROM post_comments WHERE user_id=$userid AND comment_id=$cmnt_id");

  //print_r($data);
  if($data->num_rows>0):
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<div class="modal-content col-md-6">
  <div class="modal-header">
    <h5 class="modal-title">Confirmaion</h5>
  </div>
  
  <div class="modal-body">
    <p>Are you sure to delete this comment ?</p>
  </div>
  <div class="modal-footer">
  <input type="hidden" name="comment_id" value="<?php echo $cmnt_id; ?>">

    <input type="submit" value="Yes, sure" name="delete_comment_confirm" class="btn btn-primary">

    <input type="submit" value="No" name="" class="btn btn-info">
  </div>
</div>

</form>
<?php endif; ?>

<!-- . ==============================================
POST DELETE CONFIRMATION
. ============================================== -->

<?php 
elseif(isset($_GET['delete_post_id'])):

  $userid = $_SESSION['user_id'];
  $post_id = sanitize_number($_GET['delete_post_id']);

  $data = $GLOBALS['conn']->query("SELECT * FROM all_posts WHERE user_id=$userid AND post_id=$post_id");

  //print_r($data);
  if($data->num_rows>0):
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

<div class="modal-content col-md-6">
  <div class="modal-header">
    <h5 class="modal-title">Confirmaion</h5>
  </div>
  
  <div class="modal-body">
    <p>Are you sure to delete this comment ?</p>
  </div>
  <div class="modal-footer">
  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

    <input type="submit" value="Yes, sure" name="delete_post_confirm" class="btn btn-primary">

    <input type="submit" value="No" name="" class="btn btn-info">
  </div>
</div>

</form>
<?php endif; endif; ?>


<?php include('include/footer.php'); ?>
