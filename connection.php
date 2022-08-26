<?php 

define('DBSERVER', 'localhost'); //Database server
define('DBUSERNAME', 'root');// Database user name
define('DBPASSWORD', ''); //Database password
define('DBNAME', 'ontrackd_ontrack');

//connect to Database

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

// check connection

if($db === false){
    die("Error: connection error. " . mysqli_connect_error());
    
}

?>