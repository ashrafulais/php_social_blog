<?php

session_start();

//$_SESSION['loggedin']=false;

session_unset();
session_destroy();

echo "Logged out successfully. Redirecting to homepage after 3 seconds";

//wait for 1 seconds
sleep(1);

header('Location: index.php');

?>