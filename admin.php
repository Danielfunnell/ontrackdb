<?php 

require_once "connection.php";
require_once "session.php";


$pupil_name = '';


if(!isset($_SESSION["logged_in"])){
    header('Location: login.php');
    exit;
}

// Set items into Database
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_all"])){
    $notes = $_POST["notes"];
    $date = $_POST["date_next_lesson"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $cockpit = $_POST["cockpit"];
    $moving_off = $_POST["moving_off"];
    $stopping = $_POST["stopping"];
    $steering = $_POST["steering"];
    $mspsl = $_POST["mspsl"];
    $approaching = $_POST["approaching"];
    $crossroads = $_POST["crossroads"];
    $roundabouts = $_POST["roundabouts"];
    $trafficLights = $_POST["trafficLights"];
    $leftTurn = $_POST["leftTurn"];
    $rightTurn = $_POST["rightTurn"];
    $bayForward = $_POST["bayForward"];
    $bayReverse = $_POST["bayReverse"];
    $pullUpRight = $_POST["pullUpRight"];
    $parallel = $_POST["parallel"];
    $anticipation = $_POST["anticipation"];
    $clearance = $_POST["clearance"];
    $meeting = $_POST["meeting"];
    $overtaking = $_POST["overtaking"];
    $crossings = $_POST["crossings"];
    $rural = $_POST["rural"];
    $lanePosition = $_POST["lanePosition"];
    $useSpeed = $_POST["useSpeed"];
    $dualCarriage = $_POST["dualCarriage"];
    $independent = $_POST["independent"];
    $satNav = $_POST["satNav"];
    $emergencyStop = $_POST["emergencyStop"];
    $showMe = $_POST["showMe"];
    $tellMe = $_POST["tellMe"];
    


    $user_id = $_POST["user-name"];
    
  
    $sql_insert = "INSERT INTO records (cockpit, moving_off, stopping, steering, mspsl,
    approaching, crossroads, roundabouts, trafficLights, leftTurn, rightTurn,
    bayForward, bayReverse, PullUpRIght, parallel,
    anticipation, clearance, meeting, overtaking, crossings, rural, lanePosition, useSpeed,
    dualCarriage, independent, satNav, emergencyStop, showMe, tellMe, userID) 
    VALUEs ($cockpit, $moving_off, $stopping, $steering, $mspsl, 
    $approaching, $crossroads, $roundabouts, $trafficLights, $leftTurn, $rightTurn,
    $bayForward, $bayReverse, $pullUpRight, $parallel,
    $anticipation, $clearance, $meeting, $overtaking, $crossings, $rural, $lanePosition, $useSpeed,
    $dualCarriage, $independent, $satNav, $emergencyStop, $showMe, $tellMe, $user_id) 
    ON DUPLICATE KEY UPDATE cockpit = $cockpit, moving_off = $moving_off, stopping = $stopping, steering = $steering, mspsl = $mspsl,
    approaching = $approaching, crossroads = $crossroads, roundabouts = $roundabouts, trafficLights = $trafficLights, leftTurn = $leftTurn, rightTurn = $rightTurn,
    bayForward = $bayForward, bayReverse = $bayReverse, PullUpRIght = $pullUpRight, parallel =  $parallel,
    anticipation = $anticipation, clearance = $clearance, meeting = $meeting, overtaking = $overtaking, crossings = $crossings, rural = $rural, useSpeed = $useSpeed,
    dualCarriage = $dualCarriage, independent = $independent, satNav = $satNav, emergencyStop = $emergencyStop, showMe = $showMe, tellMe = $tellMe";
    
    if(mysqli_query($db, $sql_insert)) {
        echo "new record delivered";
    } else {
        echo "Error" . mysqli_error($db);
    }
  
    $sql_update = "UPDATE users 
    SET notes = '$notes', 
    next_lesson_date = '$date', 	
    next_lesson_start = '$start_time', 
    next_lesson_end = '$end_time'
    WHERE id = $user_id";

    if(mysqli_query($db, $sql_update)) {
      echo "new update delivered";
    } else {
      echo "Error" . mysqli_error($db);
    }

}

//mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php');?>


<div class="message-box" id="message-box">
  
</div>
       


<div class="container mt-5">
    <div class="row">
    <div class="col-md-12">
    <form method="POST" action="">
       
        <div class="form-group">
        <label for="exampleFormControlSelect1"><h5>User name</h5></label>
    <select class="form-control" id="select-user" name="users" >
        <option value="select-users">Select user</option>
    <!-- loop through user names and ids -->
    <?php $sql = "SELECT name, id from users ORDER BY name ASC";
    $result = $db->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo 
            '<option value=' . $row['id'] . '>' . $row['name'] . '</option>'; 
        }
    }
    ?>  
    </select>
      
  <div class="results-container" id="results">


  </div>    
  
    <a href="profile.php"><i class="fas fa-user-circle mt-5"></i> Profile</a>


<script>

    console.log(window.location.pathname)
</script>


<?php include('footer.php')?>

