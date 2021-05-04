<?php 

session_start();

if(!isset($_SESSION["logged_in"])){
    header('Location: login.php');
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php');?>


<h1>This is the index page</h1>

<br> 
<h2>Welcome <?php echo $_SESSION["name"];?></h2>
<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
<a href="logout.php">Logout</a>

<?php include('footer.php')?>
