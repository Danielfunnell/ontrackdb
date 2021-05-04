<?php 

require_once "connection.php";
require_once "session.php";



if(!isset($_SESSION["logged_in"])){
    header('Location: login.php');
    exit;
}


//Send Message
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


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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

    $records = array(
    $cockpit = $row['cockpit'],
    $moving_off = $row['moving_off'],
    $stopping = $row['stopping'],
    $steering = $row['steering'],
    $mspsl = $row['mspsl'],
    $approaching = $row["approaching"],
    $crossroads = $row["crossroads"],
    $roundabouts = $row["roundabouts"],
    $trafficLights = $row["trafficLights"],
    $leftTurn = $row["leftTurn"],
    $rightTurn = $row["rightTurn"],
    $bayForward = $row["bayForward"],
    $bayReverse = $row["bayReverse"],
    $pullUpRight = $row["pullUpRight"],
    $parallel = $row["parallel"],
    $anticipation = $row["anticipation"],
    $clearance = $row["clearance"],
    $meeting = $row["meeting"],
    $overtaking = $row["overtaking"],
    $crossings = $row["crossings"],
    $rural = $row["rural"],
    $lanePosition = $row["lanePosition"],
    $useSpeed = $row["useSpeed"],
    $dualCarriage = $row["dualCarriage"],
    $independent = $row["independent"],
    $satNav = $row["satNav"],
    $emergencyStop = $row["emergencyStop"],
    $showMe = $row["showMe"],
    $tellMe = $row["tellMe"]);
}


//mysqli_close($db);

$date = strtoTime($next_lesson_date);
$date_format = date("d-m-Y", $date);


$totalRecords = array_sum($records);
$numRecords = count($records);
$averageScore = round($totalRecords / $numRecords);  


list($firstName, $lastName) = explode(' ', $name);




?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.php');?>
  


<div class="container mt-2">
<div class="total-progress">
  <p class="total-progress__average"><?php echo $firstName;?> your <span class="total-progress__span"><?php echo $averageScore?>%</span> on-track</p> 
      <div class="total-progress__bar-container mb-3" style="height: 10px">
      <div id="progressBar" class="progress_bar">
      </div>
      </div>
  </div>
    <div class="main-body">
    <div class="message-box" id="message-box">
  </div>
        
  
  
      
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card--image">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                  <h6><strong>Linked Instructor</strong></h6>
                    <img src="./src/img/users/daniel.JPG" alt="Admin" class="instructor-img">
                    <div class="mt-3">
                      <p><span>DVSA Fully Qualified instructor</span></p>
                      <h5>Daniel Funnell</h5>
                      
                      <p class="text-secondary mb-1">Full Stack Developer</p>
                      <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>

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
              


              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <!-- BASIC SKILS -->
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Basic Skills</i></h6>
                      <small>Cockpit Drill & Safety Checks</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $cockpit;?>%" aria-valuenow="<?php echo $cockpit;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $cockpit;?>%</div>
                      </div>
                      <small>Moving Off Safely</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $moving_off;?>%" aria-valuenow="<?php echo $moving_off;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $moving_off;?>%</div>
                      </div>
                      <small>Stopping Safetly</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $stopping;?>%" aria-valuenow="<?php echo $stopping;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $stopping;?>%</div>
                      </div>
                      <small>Steering</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $steering;?>%" aria-valuenow="<?php echo $steering;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $steering;?>%</div>
                      </div>
                      <small>MSPSL</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $mspsl;?>%" aria-valuenow="<?php echo $mspsl;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $mspsl;?>%</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                    <!--JUNCTIONS-->
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Junctions</i></h6>
                      <small>Approaching</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $approaching;?>%" aria-valuenow="<?php echo $approaching;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $approaching;?>%</div>
                      </div>
                      <small>Crossroads</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $crossroads;?>%" aria-valuenow="<?php echo $crossroads;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $crossroads;?>%</div>
                      </div>
                      <small>Roundabouts</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $roundabouts;?>%" aria-valuenow="<?php echo $roundabouts;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $roundabouts;?>%</div>
                      </div>
                      <small>Traffic Lights</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $trafficLights;?>%" aria-valuenow="<?php echo $trafficLights;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $trafficLights;?>%</div>
                      </div>
                      <small>Turn Left/Emerge Left</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $leftTurn;?>%" aria-valuenow="<?php echo $leftTurn;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $leftTurn;?>%</div>
                      </div>
                      <small>Turn Right/Emerge Right</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $rightTurn;?>%" aria-valuenow="<?php echo $rightTurn;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $rightTurn;?>%</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row gutters-sm">
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                      <!-- MANOEUVRES -->
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Manoeuvres</i></h6>
                      <small>Bay Park Forward</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $bayForward;?>%" aria-valuenow="<?php echo $bayForward;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $bayForward;?>%</div>
                      </div>
                      <small>Bay Park Reverse</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $bayReverse;?>%" aria-valuenow="<?php echo $bayReverse;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $bayReverse;?>%</div>
                      </div>
                      <small>Pull Up On The Right</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $pullUpRight;?>%" aria-valuenow="<?php echo $pullUpRight;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $pullUpRight;?>%</div>
                      </div>
                      <small>Reverse Parallel Park</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $parallel;?>%" aria-valuenow="<?php echo $parallel;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $parallel;?>%</div>
                      </div>
                    </div>
                  </div>
                </div>
    
                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                    <!--ROAD USE-->
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Road Use</i></h6>
                      <small>Anticipation and Planning</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $anticipation;?>%" aria-valuenow="<?php echo $anticipation;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $anticipation;?>%</div>
                      </div>
                      <small>Clearance to Obstructions</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $clearance;?>%" aria-valuenow="<?php echo $clearance;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $clearance;?>%</div>
                      </div>
                      <small>Meeting Traffic</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $meeting;?>%" aria-valuenow="<?php echo $meeting;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $meeting;?>%</div>
                      </div>
                      <small>Overtaking</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $overtaking;?>%" aria-valuenow="<?php echo $overtaking;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $overtaking;?>%</div>
                      </div>
                      <small>Pedestrian Crossings</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $crossings;?>%" aria-valuenow="<?php echo $crossings;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $crossings;?>%</div>
                      </div>
                      <small>Rural Roads</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $rural;?>%" aria-valuenow="<?php echo $rural;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $rural;?>%</div>
                      </div>
                      <small>Lane Positioning</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $lanePosition;?>%" aria-valuenow="<?php echo $lanePosition;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $lanePosition;?>%</div>
                      </div>
                      <small>Use of Speed</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $useSpeed;?>%" aria-valuenow="<?php echo $useSpeed;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $useSpeed;?>%</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6 mb-3">
                  <div class="card h-100">
                    <div class="card-body">
                    <!--OTHER-->
                      <h6 class="d-flex align-items-center mb-3"><i class="material-icons text-info mr-2">Other</i></h6>
                      <small>Dual Carriageways</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $dualCarriage;?>%" aria-valuenow="<?php echo $dualCarriage;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $dualCarriage;?>%</div>
                      </div>
                      <small>Independent Driving</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $independent;?>%" aria-valuenow="<?php echo $independent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $independent;?>%</div>
                      </div>
                      <small>Sat Nav Driving</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $satNav;?>%" aria-valuenow="<?php echo $satNav;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $satNav;?>%</div>
                      </div>
                      <small>Emergency Stop</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $emergencyStop;?>%" aria-valuenow="<?php echo $emergencyStop;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $emergencyStop;?>%</div>
                      </div>
                      <small>Show Me Questions</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $showMe;?>%" aria-valuenow="<?php echo $showMe;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $showMe;?>%</div>
                      </div>
                      <small>Tell Me Questions</small>
                      <div class="progress mb-3" style="height: 10px">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?php echo $tellMe;?>%" aria-valuenow="<?php echo $tellMe;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tellMe;?>%</div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>


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

