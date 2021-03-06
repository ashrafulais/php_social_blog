<?php 

include('include/session_controller.php');
include('include/functions.php');
include('include/header.php'); 
?>

 <style id="compiled-css" type="text/css">:root{--input-padding-x:1.5rem;--input-padding-y:.75rem}body{background:#007bff;background:linear-gradient(to right,#0062E6,#33AEFF)}.card-signin{border:0;border-radius:1rem;box-shadow:0 .5rem 1rem 0 rgba(0,0,0,.1);overflow:hidden}.card-signin .card-title{margin-bottom:2rem;font-weight:300;font-size:1.5rem}.card-signin .card-img-left{width:45%;background:url(https://source.unsplash.com/WEQbe2jBg40/414x512) center;background-size:cover}.card-signin .card-body{padding:2rem}.form-signin{width:100%}.form-signin .btn{font-size:80%;border-radius:5rem;letter-spacing:.1rem;font-weight:700;padding:1rem;transition:all .2s}.form-label-group{position:relative;margin-bottom:1rem}.form-label-group input{height:auto;border-radius:2rem}.form-label-group>input,.form-label-group>label{padding:var(--input-padding-y) var(--input-padding-x)}.form-label-group>label{position:absolute;top:0;left:0;display:block;width:100%;margin-bottom:0;line-height:1.5;color:#495057;border:1px solid transparent;border-radius:.25rem;transition:all .1s ease-in-out}.form-label-group input::-webkit-input-placeholder{color:transparent}.form-label-group input:-ms-input-placeholder{color:transparent}.form-label-group input::-ms-input-placeholder{color:transparent}.form-label-group input::-moz-placeholder{color:transparent}.form-label-group input::placeholder{color:transparent}.form-label-group input:not(:placeholder-shown){padding-top:calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));padding-bottom:calc(var(--input-padding-y)/ 3)}.form-label-group input:not(:placeholder-shown)~label{padding-top:calc(var(--input-padding-y)/ 3);padding-bottom:calc(var(--input-padding-y)/ 3);font-size:12px;color:#777}.btn-google{color:#fff;background-color:#ea4335}.btn-facebook{color:#fff;background-color:#3b5998}

</style> 
<title>Blog Login</title>

</head>



<body>
<?php include('include/navbar.php'); ?>

  <div class="alert alert-primary alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php 
    echo $login_page_msg??"Lets Login.! <br>"; 
    //echo "hi ".$_SESSION['loggedin'];
    ?>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Login</h5>

            <form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" >
              <div class="form-label-group">
                <input type="text" id="inputUserame" class="form-control" placeholder="Email" name="email" required autofocus>
                <label for="inputUserame">Emai</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
                <label for="inputPassword">Password</label>
              </div>
              

              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="login_btn"><i class="fas fa-arrow-alt-circle-up"></i>Login</button>
				<hr class="my-4">

              <span class="small text-center">New Here ?</span>
              <button class="btn btn-lg btn-google btn-block text-uppercase" onclick="window.location.href='signup.php'">
              <i class="fas fa-shield-alt"></i>Sign up Now</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php include('include/footer.php'); ?>
