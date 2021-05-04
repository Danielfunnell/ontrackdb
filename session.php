<?php 

// start the session
session_start();

// check if the user is already logged in

if(isset($_SESSION['user_id']) && $_SESSION['user_id'] === true) {
    header('Location: profile.php');
    exit;
}


?>