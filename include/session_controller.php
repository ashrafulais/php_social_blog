<?php

session_start();

$never_accessable_files = ["config_db.php","config_tables.php","connection_db.php", "error404.php","footer.php","functions.php","header.php","navbar.php","session_controller.php", "paginator.php"];
$loggedin_accessable_files = ["empty_page.php","profile.php","single_post.php","user_posts.php"];
$not_loggedin_accessable_files = ["login.php","signup.php"];
$public_accessable_files = ["index.php"];

global $is_loggedin;
$is_loggedin = false;

if(in_array(basename($_SERVER['SCRIPT_NAME']), $never_accessable_files)) {
    header("Location: index.php");
}

if( isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){

    if(in_array(basename($_SERVER['SCRIPT_NAME']), $not_loggedin_accessable_files)) {
        header("Location: index.php");
    }
    //echo "logged in";
    $is_loggedin = true;
    
}

if( !isset($_SESSION['loggedin']) && !isset($_SESSION['user_id'])){

    if(in_array(basename($_SERVER['SCRIPT_NAME']), $loggedin_accessable_files)) {
        header("Location: index.php");
    }
    //echo "no session";
    $is_loggedin = false;
    
}

// if( isset($_SESSION['loggedin']) && isset($_SESSION['user_id'])){

//     header('Location: index.php');
    
// }

//echo isset($_SESSION['loggedin'])+2;

//$_SESSION['loggedin'] = false;

/* if(isset($_SESSION['loggedin']))
{
    echo "loggedin is set";
}
else if(!isset($_SESSION['loggedin']))
{
    echo "loggedin is not set";
} */

?>