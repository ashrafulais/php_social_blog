<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">BLOG </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">

      <?php if(!isset($_SESSION['loggedin']) && !isset($_SESSION['user_id'])): ?>

        <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="signup.php">Signup</a>
        </li>
      <?php endif; ?>

      <?php if(isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])): ?>
      
        <li class="nav-item active">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="user_posts.php">Posts</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="logout.php">Log out</a>
        </li>
        
      <?php endif; ?>

      </ul>
    </div>

  </div>
</nav>