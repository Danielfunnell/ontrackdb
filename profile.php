<?php 

require_once "connection.php";
require_once "session.php";

include "functions.php";

if(!isset($_SESSION["logged_in"])){
    header('Location: login.php');
    exit;
}


$error = '';
$user_id = $_SESSION["user_id"];


//Send Message

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_message"])) {
      $user_message = test_input($_POST['user_message']);
    
    
      $sql_insert = $db->prepare("INSERT INTO messages (message, usersID) VALUES (?, ?);"); 
      $sql_insert->bind_param("si", $user_message, $user_id);
      $results = $sql_insert->execute();
    
      if($results) {
        $error .= 'Message delivered thankyou';
      }else {
        echo "Error";
      }
    
    }


// fetch user and records
$sql = "SELECT users.id,
users.name,
users.email, 
users.telephone, 
users.next_lesson_date, 
users.next_lesson_start, 
users.next_lesson_end, 
users.notes, 
records.* FROM users LEFT JOIN records ON users.id = records.userID WHERE users.id = '".$_SESSION["user_id"]."'";
$result = mysqli_query($db, $sql);


while($row= mysqli_fetch_array($result)) {

    $id = $row['id'];
    $name =  $row['name'];
    $email =  $row['email'];
    $telephone = $row['telephone'];
    $notes = $row['notes'];
    $next_lesson_date = $row['next_lesson_date'];
    $start_time = $row['next_lesson_start'];
    $start_time = date('H:i', strtotime( $start_time ) );
    $end_time = $row['next_lesson_end'];
    $end_time = date('H:i', strtotime( $end_time ) );
    $notes = $row['notes'];

    // Records Array
    $records = array(
      "Basic Skills" => array(
        "Cockpit Drill & Safety Checks" => $row['cockpit'], 
        "Moving Off Safely" => $row['moving_off'],  
        "Stopping Safely" => $row['stopping'], 
        "Steering" => $row['steering'], 
        "MSPSL" => $row['mspsl']
      ),
      "Junctions" => array (
        "Approaching" => $row['approaching'], 
        "Crossroads" => $row['crossroads'], 
        "Roundabouts" => $row['roundabouts'],
        "Traffic Lights" => $row['trafficLights'], 
        "Turn Left/Emerge Left" => $row['leftTurn'],
        "Turn Right/Emerge Right" => $row['rightTurn']
      ),
      "Manoeuvres" => array (
        "Bay Park Forward" => $row['bayForward'], 
        "Bay Park Reverse" => $row['bayReverse'], 
        "Pull Up On Right" => $row['pullUpRight'],
        "Reverse Parallel Park" => $row['parallel'], 
      ),
       "Road Use" => array (
        "Anticipation and Planning" => $row['anticipation'], 
        "Clearance to Obstructions" => $row['clearance'], 
        "Meeting Traffic" => $row['meeting'],
        "Overtaking" => $row['overtaking'], 
        "Pedestrian Crossings" => $row['crossings'],
        "Rural Roads" => $row['rural'],
        "Lane Positioning" => $row['lanePosition'],
        "Use of Speed" => $row['useSpeed'],
      ),
      "Other" => array (
        "Dual Carriageways" => $row['dualCarriage'], 
        "Independent Driving" => $row['independent'], 
        "Sat Nav Driving" => $row['satNav'],
        "Emergency Stop" => $row['emergencyStop'], 
        "Show Me Questions" => $row['showMe'],
        "Tell Me Questions" => $row['tellMe'],
      ),
    );

}


//mysqli_close($db);

$date = strtoTime($next_lesson_date);
$date_format = date("d-m-Y", $date);

list($firstName, $lastName) = explode(' ', $name);



?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php');?>
  
<div class="container mt-2">

<!-- TOTAL PROGRESS AREA-->
  <div class="total-progress">
    <p class="total-progress__average"><?php echo $firstName;?> your <span class="total-progress__span">
      <?php echo $averageScore = countRecords($records);?>%</span> on-track
    </p> 
    <div class="total-progress__bar-container mb-3" style="height: 10px">
      <div id="progressBar" class="progress_bar">
      </div>
    </div>
  </div>

  <!-- MAIN AREA-->
  <div class="main-body">
    <div class="message-box" id="message-box">
    </div>
  <div class="row gutters-sm">
    
    <!-- INSTRUCTOR MESSAGE AREA-->
            <div class="col-md-4 mb-3">
              <div class="card--image">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <h6><strong>Linked Instructor</strong></h6>
                    <img src="./src/img/users/daniel.JPG" alt="Admin" class="instructor-img">
                    <div class="mt-3">
                      <p><span>DVSA Fully Qualified instructor</span></p>
                      <h5>Daniel Funnell</h5>

                      <form method="POST" action="">
                        <label for="exampleFormControlTextarea1"><h6>Message Daniel <i class="far fa-comment-alt message-icon"></i></h6></label>
                        <textarea type="text" class="form-control message" id="message" name="user_message" rows="4"><?php echo $error;?></textarea>
                        <div class="error"></div>
                        <button type="submit" name="submit_message" class="btn btn-outline-primary">Send</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card mt-3">
                
              </div>
              
            </div>
            
            <!-- DETAILS AREA-->
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                <h5 class="mb-5"><strong>Your Details</strong></h5>
                  <div class="row">
                  
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-user icon-custom"></i>Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $name;?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-envelope icon-custom"></i>Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $email;?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-mobile-alt icon-custom"></i> Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $telephone;?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-address-card icon-custom"></i>Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      Bay Area, San Francisco, CA
                    </div>
                  </div>
                  <hr>
                  <h5 class="mb-5"><strong>Next Lesson</strong></h5>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-calendar icon-custom"></i>Date</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $date_format;?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-clock icon-custom"></i>Start time</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $start_time;?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-clock icon-custom"></i>End time</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $end_time;?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"><i class="fas fa-bullseye icon-custom"></i>Lesson target</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $notes;?>
                    </div>
                  </div>
                </div>
              </div>
              

            <!-- SKILS SECTION -->
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      
                      <?php foreach($records as $key => $record) {?>
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2"><?php echo $key?> </i></h6>
                      <?php foreach($record as $key => $rec) { ?>
                      <small><?php echo $key?></small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $rec;?>%" aria-valuenow="<?php echo $rec;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $rec;?>%</div>
                      </div>
                        <?php }?>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body"> <?php }?>
                   


<?php include('footer.php')?>

<script>
  // Assign your element ID to a variable.
  var progress = document.getElementById("progressBar");
  // Pause the animation for 100 so we can animate from 0 to x%
  setTimeout(
    function(){
      progress.style.width = "100%";
     
      progress.style.width = "<?php echo $averageScore;?>%";
      progress.style.backgroundColor = "#0fc4b0";
    }
  ,100);
</script>    
