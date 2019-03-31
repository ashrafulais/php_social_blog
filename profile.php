
<?php 

include('include/session_controller.php');

include('include/functions.php');

include('include/header.php'); 
?>


<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css'>

<style class="cp-pen-styles">
@import url(https://fonts.googleapis.com/css?family=Quicksand:400,500,700&subset=latin-ext);.profile-card textarea,.profile-card__button,body{font-family:Quicksand,sans-serif}.profile-card-message,.profile-card__overlay{left:0;opacity:0;pointer-events:none;width:100%}html{position:relative;overflow-x:hidden!important}*{box-sizing:border-box}body{color:#324e63}a,a:hover{text-decoration:none}.icon{display:inline-block;width:1em;height:1em;stroke-width:0;stroke:currentColor;fill:currentColor}.wrapper{width:100%;height:auto;min-height:100vh;padding:100px 20px 50px;background-image:linear-gradient(-20deg,#09a9a9 0,#6944ff 100%);display:flex}@media screen and (max-width:768px){.wrapper{height:auto;min-height:100vh;padding-top:100px}}.profile-card{width:100%;min-height:460px;margin:auto;box-shadow:0 8px 60px -10px rgba(13,28,39,.6);background:#fff;border-radius:12px;max-width:700px;position:relative}.profile-card.active .profile-card__cnt{filter:blur(6px)}.profile-card.active .profile-card-message,.profile-card.active .profile-card__overlay{opacity:1;pointer-events:auto;transition-delay:.1s}.profile-card.active .profile-card-form{transform:none;transition-delay:.1s}.profile-card__img{width:150px;height:150px;margin-left:auto;margin-right:auto;transform:translateY(-50%);border-radius:50%;overflow:hidden;position:relative;z-index:4;box-shadow:0 5px 50px 0 #6c44fc,0 0 0 7px rgba(107,74,255,.5)}@media screen and (max-width:576px){.profile-card__img{width:120px;height:120px}}.profile-card__img img{display:block;width:100%;height:100%;object-fit:cover;border-radius:50%}.profile-card__cnt{margin-top:-35px;text-align:center;padding:0 20px 40px;transition:all .3s}.profile-card__name{font-weight:700;font-size:24px;color:#6944ff;margin-bottom:15px}.profile-card__txt{font-size:18px;font-weight:500;color:#324e63;margin-bottom:15px}.profile-card__txt strong{font-weight:700}.profile-card-loc{display:flex;justify-content:center;align-items:center;font-size:18px;font-weight:600}.profile-card-loc__icon{display:inline-flex;font-size:27px;margin-right:10px}.profile-card-inf{display:flex;justify-content:center;flex-wrap:wrap;align-items:flex-start;margin-top:35px}.profile-card-inf__item{padding:10px 35px;min-width:150px}.profile-card-inf__title{font-weight:700;font-size:27px;color:#324e63}.profile-card-inf__txt{font-weight:500;margin-top:7px}.profile-card-social{margin-top:25px;display:flex;justify-content:center;align-items:center;flex-wrap:wrap}.profile-card-social__item{display:inline-flex;width:55px;height:55px;margin:15px;border-radius:50%;align-items:center;justify-content:center;color:#fff;background:#405de6;box-shadow:0 7px 30px rgba(43,98,169,.5);position:relative;font-size:21px;flex-shrink:0;transition:all .3s}@media screen and (max-width:768px){.profile-card-inf__item{padding:10px 20px;min-width:120px}.profile-card-social__item{width:50px;height:50px;margin:10px}}.profile-card-social__item.facebook{background:linear-gradient(45deg,#3b5998,#0078d7);box-shadow:0 4px 30px rgba(43,98,169,.5)}.profile-card-social__item.github{background:linear-gradient(45deg,#333,#626b73);box-shadow:0 4px 30px rgba(63,65,67,.6)}.profile-card-social__item.link{background:linear-gradient(45deg,#d5135a,#f05924);box-shadow:0 4px 30px rgba(223,45,70,.6)}.profile-card-social .icon-font{display:inline-flex}.profile-card-ctr{display:flex;justify-content:center;align-items:center;margin-top:40px}.profile-card__button{background:0 0;border:none;font-weight:700;font-size:19px;margin:15px 35px;padding:15px 40px;min-width:201px;border-radius:50px;min-height:55px;color:#fff;cursor:pointer;backface-visibility:hidden;transition:all .3s}@media screen and (max-width:768px){.profile-card__button{min-width:170px;margin:15px 25px}}@media screen and (max-width:576px){.profile-card-ctr{flex-wrap:wrap}.profile-card__button{min-width:inherit;margin:0 0 16px;width:100%;max-width:300px}.profile-card__button:last-child{margin-bottom:0}}.profile-card__button:focus{outline:0!important}@media screen and (min-width:768px){.profile-card-social__item:hover{transform:scale(1.2)}.profile-card__button:hover{transform:translateY(-5px)}}.profile-card__button:first-child{margin-left:0}.profile-card__button:last-child{margin-right:0}.profile-card__button.button--blue{background:linear-gradient(45deg,#1da1f2,#0e71c8);box-shadow:0 4px 30px rgba(19,127,212,.4)}.profile-card__button.button--blue:hover{box-shadow:0 7px 30px rgba(19,127,212,.75)}.profile-card__button.button--orange{background:linear-gradient(45deg,#d5135a,#f05924);box-shadow:0 4px 30px rgba(223,45,70,.35)}.profile-card__button.button--orange:hover{box-shadow:0 7px 30px rgba(223,45,70,.75)}.profile-card__button.button--gray{box-shadow:none;background:#dcdcdc;color:#142029}.profile-card-message{height:100%;position:absolute;top:0;padding-top:130px;padding-bottom:100px;transition:all .3s}.profile-card-form{box-shadow:0 4px 30px rgba(15,22,56,.35);max-width:80%;margin-left:auto;margin-right:auto;height:100%;background:#fff;border-radius:10px;padding:35px;transform:scale(.8);position:relative;z-index:3;transition:all .3s}@media screen and (max-width:768px){.profile-card-form{max-width:90%;height:auto}}.profile-card-form__bottom{justify-content:space-between;display:flex}@media screen and (max-width:576px){.profile-card-form{padding:20px}.profile-card-form__bottom{flex-wrap:wrap}}.profile-card textarea{width:100%;resize:none;height:210px;margin-bottom:20px;border:2px solid #dcdcdc;border-radius:10px;padding:15px 20px;color:#324e63;font-weight:500;outline:0;transition:all .3s}.profile-card textarea:focus{outline:0;border-color:#8a979e}.profile-card__overlay{height:100%;position:absolute;top:0;background:rgba(22,33,72,.35);border-radius:12px;transition:all .3s}
</style>


    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

</head>

<body>

<?php 
include('include/navbar.php'); 

$user_id = $_SESSION['user_id'];
$profile_data = get_user_details($user_id)->fetch_assoc();

//print_r($profile_data);
$total_posts = get_posts(-1, -1, $user_id)->num_rows;
?>


<div class="wrapper">

  
  <div class="profile-card js-profile-card">
    <div class="profile-card__img">
      <img src="https://fboverlays.com/pages/assets/frontend/img/previewImage.png" alt="profile card">
    </div>

    <div class="profile-card__cnt js-profile-cnt">
      <div class="profile-card__name"> <?php echo $profile_data['user_firstname']." ".$profile_data['user_lastname']; ?></div>
      
      <div class="profile-card__txt"><?php echo $profile_data['user_job_title']; ?> from <strong> Internet ;) </strong></div>
      <div class="profile-card-loc">
        <span class="profile-card-loc__icon">
          <svg class="icon"><use xlink:href="#icon-location"></use></svg>
        </span>

        <span class="profile-card-loc__txt">
          City, Country
        </span>
      </div>

      <div class="profile-card-inf">


        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title"><?php echo $total_posts; ?></div>
          <div class="profile-card-inf__txt">Articles</div>
        </div>
        
      </div>

      <div class="profile-card-social">
        <a href="https://www.facebook.com/" class="profile-card-social__item facebook" target="_blank">
          <span class="icon-font">
              <svg class="icon"><use xlink:href="#icon-facebook"></use></svg>
          </span>
        </a>

        <a href="https://github.com/" class="profile-card-social__item github" target="_blank">
          <span class="icon-font">
              <svg class="icon"><use xlink:href="#icon-github"></use></svg>
          </span>
        </a>
        
        <a href="#" class="profile-card-social__item link" target="_blank">
          <span class="icon-font">
              <svg class="icon"><use xlink:href="#icon-link"></use></svg>
          </span>
        </a>

      </div>

      <div class="profile-card-ctr">
        <a class="profile-card__button button--blue text-white" href="edit_bro.php?update_profile=<?php echo $profile_data['user_id']; ?>">Edit Profile</a>
      </div>

      <!-- <div class="profile-card-ctr">
        <button class="profile-card__button button--blue js-message-btn">Message</button>
        <button class="profile-card__button button--orange">Follow</button>
      </div> -->

    </div>

    <div class="profile-card-message js-message">
      <form class="profile-card-form">
        <div class="profile-card-form__container">
          <textarea placeholder="Say something..."></textarea>
        </div>

        <div class="profile-card-form__bottom">
          <button class="profile-card__button button--blue js-message-close">
            Send
          </button>

          <button class="profile-card__button button--gray js-message-close">
            Cancel
          </button>
        </div>
      </form>

      <div class="profile-card__overlay js-message-close"></div>
    </div>

  </div>

</div>

<svg hidden="hidden">
  <defs>


    <symbol id="icon-github" viewBox="0 0 32 32">
      <title>github</title>
      <path d="M16.192 0.512c-8.832 0-16 7.168-16 16 0 7.072 4.576 13.056 10.944 15.168 0.8 0.16 1.088-0.352 1.088-0.768 0-0.384 0-1.632-0.032-2.976-4.448 0.96-5.376-1.888-5.376-1.888-0.736-1.856-1.792-2.336-1.792-2.336-1.44-0.992 0.096-0.96 0.096-0.96 1.6 0.128 2.464 1.664 2.464 1.664 1.44 2.432 3.744 1.728 4.672 1.344 0.128-1.024 0.544-1.728 1.024-2.144-3.552-0.448-7.296-1.824-7.296-7.936 0-1.76 0.64-3.168 1.664-4.288-0.16-0.416-0.704-2.016 0.16-4.224 0 0 1.344-0.416 4.416 1.632 1.28-0.352 2.656-0.544 4-0.544s2.72 0.192 4 0.544c3.040-2.080 4.384-1.632 4.384-1.632 0.864 2.208 0.32 3.84 0.16 4.224 1.024 1.12 1.632 2.56 1.632 4.288 0 6.144-3.744 7.488-7.296 7.904 0.576 0.512 1.088 1.472 1.088 2.976 0 2.144-0.032 3.872-0.032 4.384 0 0.416 0.288 0.928 1.088 0.768 6.368-2.112 10.944-8.128 10.944-15.168 0-8.896-7.168-16.032-16-16.032z"></path>
      <path d="M6.24 23.488c-0.032 0.064-0.16 0.096-0.288 0.064-0.128-0.064-0.192-0.16-0.128-0.256 0.032-0.096 0.16-0.096 0.288-0.064 0.128 0.064 0.192 0.16 0.128 0.256v0z"></path>
      <path d="M6.912 24.192c-0.064 0.064-0.224 0.032-0.32-0.064s-0.128-0.256-0.032-0.32c0.064-0.064 0.224-0.032 0.32 0.064s0.096 0.256 0.032 0.32v0z"></path>
      <path d="M7.52 25.12c-0.096 0.064-0.256 0-0.352-0.128s-0.096-0.32 0-0.384c0.096-0.064 0.256 0 0.352 0.128 0.128 0.128 0.128 0.32 0 0.384v0z"></path>
      <path d="M8.384 26.016c-0.096 0.096-0.288 0.064-0.416-0.064s-0.192-0.32-0.096-0.416c0.096-0.096 0.288-0.064 0.416 0.064 0.16 0.128 0.192 0.32 0.096 0.416v0z"></path>
      <path d="M9.6 26.528c-0.032 0.128-0.224 0.192-0.384 0.128-0.192-0.064-0.288-0.192-0.256-0.32s0.224-0.192 0.416-0.128c0.128 0.032 0.256 0.192 0.224 0.32v0z"></path>
      <path d="M10.912 26.624c0 0.128-0.16 0.256-0.352 0.256s-0.352-0.096-0.352-0.224c0-0.128 0.16-0.256 0.352-0.256 0.192-0.032 0.352 0.096 0.352 0.224v0z"></path>
      <path d="M12.128 26.4c0.032 0.128-0.096 0.256-0.288 0.288s-0.352-0.032-0.384-0.16c-0.032-0.128 0.096-0.256 0.288-0.288s0.352 0.032 0.384 0.16v0z"></path>
    </symbol>

    <symbol id="icon-facebook" viewBox="0 0 32 32">
      <title>facebook</title>
      <path d="M19 6h5v-6h-5c-3.86 0-7 3.14-7 7v3h-4v6h4v16h6v-16h5l1-6h-6v-3c0-0.542 0.458-1 1-1z"></path>
    </symbol>


    <symbol id="icon-link" viewBox="0 0 32 32">
      <title>link</title>
      <path d="M17.984 11.456c-0.704 0.704-0.704 1.856 0 2.56 2.112 2.112 2.112 5.568 0 7.68l-5.12 5.12c-2.048 2.048-5.632 2.048-7.68 0-1.024-1.024-1.6-2.4-1.6-3.84s0.576-2.816 1.6-3.84c0.704-0.704 0.704-1.856 0-2.56s-1.856-0.704-2.56 0c-1.696 1.696-2.624 3.968-2.624 6.368 0 2.432 0.928 4.672 2.656 6.4 1.696 1.696 3.968 2.656 6.4 2.656s4.672-0.928 6.4-2.656l5.12-5.12c3.52-3.52 3.52-9.248 0-12.8-0.736-0.672-1.888-0.672-2.592 0.032z"></path>
      <path d="M29.344 2.656c-1.696-1.728-3.968-2.656-6.4-2.656s-4.672 0.928-6.4 2.656l-5.12 5.12c-3.52 3.52-3.52 9.248 0 12.8 0.352 0.352 0.8 0.544 1.28 0.544s0.928-0.192 1.28-0.544c0.704-0.704 0.704-1.856 0-2.56-2.112-2.112-2.112-5.568 0-7.68l5.12-5.12c2.048-2.048 5.632-2.048 7.68 0 1.024 1.024 1.6 2.4 1.6 3.84s-0.576 2.816-1.6 3.84c-0.704 0.704-0.704 1.856 0 2.56s1.856 0.704 2.56 0c1.696-1.696 2.656-3.968 2.656-6.4s-0.928-4.704-2.656-6.4z"></path>
    </symbol>

        <symbol id="icon-location" viewBox="0 0 32 32">
      <title>location</title>
      <path d="M16 31.68c-0.352 0-0.672-0.064-1.024-0.16-0.8-0.256-1.44-0.832-1.824-1.6l-6.784-13.632c-1.664-3.36-1.568-7.328 0.32-10.592 1.856-3.2 4.992-5.152 8.608-5.376h1.376c3.648 0.224 6.752 2.176 8.608 5.376 1.888 3.264 2.016 7.232 0.352 10.592l-6.816 13.664c-0.288 0.608-0.8 1.12-1.408 1.408-0.448 0.224-0.928 0.32-1.408 0.32zM15.392 2.368c-2.88 0.192-5.408 1.76-6.912 4.352-1.536 2.688-1.632 5.92-0.288 8.672l6.816 13.632c0.128 0.256 0.352 0.448 0.64 0.544s0.576 0.064 0.832-0.064c0.224-0.096 0.384-0.288 0.48-0.48l6.816-13.664c1.376-2.752 1.248-5.984-0.288-8.672-1.472-2.56-4-4.128-6.88-4.32h-1.216zM16 17.888c-3.264 0-5.92-2.656-5.92-5.92 0-3.232 2.656-5.888 5.92-5.888s5.92 2.656 5.92 5.92c0 3.264-2.656 5.888-5.92 5.888zM16 8.128c-2.144 0-3.872 1.728-3.872 3.872s1.728 3.872 3.872 3.872 3.872-1.728 3.872-3.872c0-2.144-1.76-3.872-3.872-3.872z"></path>
      <path d="M16 32c-0.384 0-0.736-0.064-1.12-0.192-0.864-0.288-1.568-0.928-1.984-1.728l-6.784-13.664c-1.728-3.456-1.6-7.52 0.352-10.912 1.888-3.264 5.088-5.28 8.832-5.504h1.376c3.744 0.224 6.976 2.24 8.864 5.536 1.952 3.36 2.080 7.424 0.352 10.912l-6.784 13.632c-0.32 0.672-0.896 1.216-1.568 1.568-0.48 0.224-0.992 0.352-1.536 0.352zM15.36 0.64h-0.064c-3.488 0.224-6.56 2.112-8.32 5.216-1.824 3.168-1.952 7.040-0.32 10.304l6.816 13.632c0.32 0.672 0.928 1.184 1.632 1.44s1.472 0.192 2.176-0.16c0.544-0.288 1.024-0.736 1.28-1.28l6.816-13.632c1.632-3.264 1.504-7.136-0.32-10.304-1.824-3.104-4.864-5.024-8.384-5.216h-1.312zM16 29.952c-0.16 0-0.32-0.032-0.448-0.064-0.352-0.128-0.64-0.384-0.8-0.704l-6.816-13.664c-1.408-2.848-1.312-6.176 0.288-8.96 1.536-2.656 4.16-4.32 7.168-4.512h1.216c3.040 0.192 5.632 1.824 7.2 4.512 1.6 2.752 1.696 6.112 0.288 8.96l-6.848 13.632c-0.128 0.288-0.352 0.512-0.64 0.64-0.192 0.096-0.384 0.16-0.608 0.16zM15.424 2.688c-2.784 0.192-5.216 1.696-6.656 4.192-1.504 2.592-1.6 5.696-0.256 8.352l6.816 13.632c0.096 0.192 0.256 0.32 0.448 0.384s0.416 0.064 0.608-0.032c0.16-0.064 0.288-0.192 0.352-0.352l6.816-13.664c1.312-2.656 1.216-5.792-0.288-8.352-1.472-2.464-3.904-4-6.688-4.16h-1.152zM16 18.208c-3.424 0-6.24-2.784-6.24-6.24 0-3.424 2.816-6.208 6.24-6.208s6.24 2.784 6.24 6.24c0 3.424-2.816 6.208-6.24 6.208zM16 6.4c-3.072 0-5.6 2.496-5.6 5.6 0 3.072 2.528 5.6 5.6 5.6s5.6-2.496 5.6-5.6c0-3.104-2.528-5.6-5.6-5.6zM16 16.16c-2.304 0-4.16-1.888-4.16-4.16s1.888-4.16 4.16-4.16c2.304 0 4.16 1.888 4.16 4.16s-1.856 4.16-4.16 4.16zM16 8.448c-1.952 0-3.552 1.6-3.552 3.552s1.6 3.552 3.552 3.552c1.952 0 3.552-1.6 3.552-3.552s-1.6-3.552-3.552-3.552z"></path>
    </symbol>
  </defs>
</svg>
<script src='https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js'></script>
<script >var messageBox = document.querySelector('.js-message');
var btn = document.querySelector('.js-message-btn');
var card = document.querySelector('.js-profile-card');
var closeBtn = document.querySelectorAll('.js-message-close');

btn.addEventListener('click', function (e) {
    e.preventDefault();
    card.classList.add('active');
});

closeBtn.forEach(function (element, index) {
    console.log(element);
    element.addEventListener('click', function (e) {
        e.preventDefault();
        card.classList.remove('active');
    });
});
</script>
<?php include('include/footer.php'); ?>