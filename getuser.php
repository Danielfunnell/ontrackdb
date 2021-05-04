<?php 

require_once "connection.php";
require_once "session.php";



if(!isset($_SESSION["logged_in"])){
    header('Location: login.php');
    exit;
}
$cockpit = "";

// gets varible(id) from admin.php showUsers. intval coverts to number 
$q = intval($_GET['q']);

$sql = "SELECT users.id,
users.name,
users.email, 
users.telephone, 
users.next_lesson_date, 
users.next_lesson_start, 
users.next_lesson_end, 
users.notes, 
records.* FROM users LEFT JOIN records ON users.id = records.userID WHERE users.id = '".$q."'";
$result = mysqli_query($db, $sql);



while($row= mysqli_fetch_array($result)) {

    $user_id = $q;
    $name =  $row['name'];
    $email =  $row['email'];
    $telephone = $row['telephone'];
    $notes = $row['notes'];
    $cockpit = $row['cockpit'];
    $moving_off = $row['moving_off'];
    $stopping = $row['stopping'];
    $steering= $row['steering'];
    $mspsl= $row['mspsl'];
    $approaching = $row["approaching"];
    $crossroads = $row["crossroads"];
    $roundabouts = $row["roundabouts"];
    $trafficLights = $row["trafficLights"];
    $leftTurn = $row["leftTurn"];
    $rightTurn = $row["rightTurn"];
    $bayForward = $row["bayForward"];
    $bayReverse = $row["bayReverse"];
    $pullUpRight = $row["pullUpRight"];
    $parallel = $row["parallel"];
    $anticipation = $row["anticipation"];
    $clearance = $row["clearance"];
    $meeting = $row["meeting"];
    $overtaking = $row["overtaking"];
    $crossings = $row["crossings"];
    $rural = $row["rural"];
    $lanePosition = $row["lanePosition"];
    $useSpeed = $row["useSpeed"];
    $dualCarriage = $row["dualCarriage"];
    $independent = $row["independent"];
    $satNav = $row["satNav"];
    $emergencyStop = $row["emergencyStop"];
    $showMe = $row["showMe"];
    $tellMe = $row["tellMe"];
}

mysqli_close($db);


?>

<!DOCTYPE html>
<html lang="en">

<div class="container user-details">
  <div class="row">
    <div class="col-md-6">
      <div class="tab-content profile-tab" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-md-6">
                    <label>User Id</label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $user_id;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Name</label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $name;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Email</label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $email;?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label>Phone</label>
                </div>
                <div class="col-md-6">
                    <p><?php echo $telephone;?></p>
                </div>
             </div>
              <div class="row">
                  <div class="col-md-6">
                      <label>Notes from last lesson</label>
                  </div>
                  <div class="col-md-6">
                      <p><?php echo $notes;?></p>
                  </div>
              </div>
        </div>
    </div>
    </div>
    
      <div class="col-md-6">
        <form method="POST" action="admin.php">
          <div class="form-group">
            <label for="exampleFormControlInput1">Date of next lesson</label>
            <input type="date" class="form-control" name="date_next_lesson" id="exampleFormControlInput1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">Start time of next lesson</label>
            <input type="time" class="form-control" name="start_time" id="exampleFormControlInput1">
          </div>
          <div class="form-group">
            <label for="exampleFormControlInput1">End time of next lesson</label>
            <input type="time" class="form-control" name="end_time" id="exampleFormControlInput1">
        </div>
          
    </div>
  </div>
</div>

<div class="container mt-5 skills">
<h5>Basic Skills</h5>
  <div class="row">
    <div class="col-md-6">
      
        <p><strong>Cockpit Drill</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $cockpit;?>%" aria-valuenow="<?php echo $cockpit;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $cockpit;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cockpit" id="inlineRadio1" value="0" <?php if($cockpit == "0" || $cockpit == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cockpit" id="inlineRadio2" value="20" <?php if($cockpit == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cockpit" id="inlineRadio3" value="40" <?php if($cockpit == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cockpit" id="inlineRadio3" value="60" <?php if($cockpit == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cockpit" id="inlineRadio3" value="80" <?php if($cockpit == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="cockpit" id="inlineRadio3" value="100" <?php if($cockpit == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Moving Off Safely</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $moving_off;?>%" aria-valuenow="<?php echo $moving_off;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $moving_off;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="moving_off" id="inlineMovingOff" value="0" <?php if($moving_off == "0" || $moving_off == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="moving_off" id="inlineMovingOff" value="20" <?php if($moving_off == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="moving_off" id="inlineMovingOff" value="40" <?php if($moving_off == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="moving_off" id="inlineMovingOff" value="60" <?php if($moving_off == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="moving_off" id="inlineMovingOff" value="80" <?php if($moving_off == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="moving_off" id="inlineMovingOff" value="100" <?php if($moving_off == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Stopping</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $stopping;?>%" aria-valuenow="<?php echo $stopping;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $stopping;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="stopping" id="inlineRadio1" value="0" <?php if($stopping == "0" || $stopping == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="stopping" id="inlineRadio2" value="20" <?php if($stopping == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="stopping" id="inlineRadio3" value="40" <?php if($stopping == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="stopping" id="inlineRadio3" value="60" <?php if($stopping == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="stopping" id="inlineRadio3" value="80" <?php if($stopping == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="stopping" id="inlineRadio3" value="100" <?php if($stopping == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Steering</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $steering;?>%" aria-valuenow="<?php echo $steering;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $steering;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="steering" id="inlineMovingOff" value="0" <?php if($steering == "0" || $steering == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="steering" id="inlineMovingOff" value="20" <?php if($steering == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="steering" id="inlineMovingOff" value="40" <?php if($steering == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="steering" id="inlineMovingOff" value="60" <?php if($steering == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="steering" id="inlineMovingOff" value="80" <?php if($steering == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="steering" id="inlineMovingOff" value="100" <?php if($steering == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>MSPSL</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $mspsl;?>%" aria-valuenow="<?php echo $mspsl;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $mspsl;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="mspsl" id="inlineRadio1" value="0" <?php if($mspsl == "0" || $mspsl == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="mspsl" id="inlineRadio2" value="20" <?php if($mspsl == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="mspsl" id="inlineRadio3" value="40" <?php if($mspsl == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="mspsl" id="inlineRadio3" value="60" <?php if($mspsl == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="mspsl" id="inlineRadio3" value="80" <?php if($mspsl == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="mspsl" id="inlineRadio3" value="100" <?php if($mspsl == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  </div>
</div>

<!-- JUNCTIONS -->
<div class="container mt-5 skills">
<h5>Junctions</h5>
  <div class="row">
    <div class="col-md-6">
      
        <p><strong>Approaching</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $approaching;?>%" aria-valuenow="<?php echo $approaching;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $approaching;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="approaching" id="inlineRadio1" value="0" <?php if($approaching == "0" || $approaching == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="approaching" id="inlineRadio2" value="20" <?php if($approaching == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="approaching" id="inlineRadio3" value="40" <?php if($approaching == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="approaching" id="inlineRadio3" value="60" <?php if($approaching == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="approaching" id="inlineRadio3" value="80" <?php if($approaching == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="approaching" id="inlineRadio3" value="100" <?php if($approaching == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Crossroads</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $crossroads;?>%" aria-valuenow="<?php echo $crossroads;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $crossroads;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossroads" id="inlineMovingOff" value="0" <?php if($crossroads == "0" || $crossroads == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossroads" id="inlineMovingOff" value="20" <?php if($crossroads == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossroads" id="inlineMovingOff" value="40" <?php if($crossroads == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossroads" id="inlineMovingOff" value="60" <?php if($crossroads == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossroads" id="inlineMovingOff" value="80" <?php if($crossroads == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossroads" id="inlineMovingOff" value="100" <?php if($crossroads == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Roundabouts</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $roundabouts;?>%" aria-valuenow="<?php echo $roundabouts;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $roundabouts;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="roundabouts" id="inlineRadio1" value="0" <?php if($roundabouts == "0" || $roundabouts == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="roundabouts" id="inlineRadio2" value="20" <?php if($roundabouts == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="roundabouts" id="inlineRadio3" value="40" <?php if($roundabouts == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="roundabouts" id="inlineRadio3" value="60" <?php if($roundabouts == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="roundabouts" id="inlineRadio3" value="80" <?php if($roundabouts == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="roundabouts" id="inlineRadio3" value="100" <?php if($roundabouts == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Traffic Lights</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $trafficLights;?>%" aria-valuenow="<?php echo $trafficLights;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $trafficLights;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="trafficLights" id="inlineMovingOff" value="0" <?php if($trafficLights == "0" || $trafficLights == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="trafficLights" id="inlineMovingOff" value="20" <?php if($trafficLights == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="trafficLights" id="inlineMovingOff" value="40" <?php if($trafficLights == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="trafficLights" id="inlineMovingOff" value="60" <?php if($trafficLights == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="trafficLights" id="inlineMovingOff" value="80" <?php if($trafficLights == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="trafficLights" id="inlineMovingOff" value="100" <?php if($trafficLights == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Turn Left/Emerge Left</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $leftTurn;?>%" aria-valuenow="<?php echo $leftTurn;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $leftTurn;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="leftTurn" id="inlineRadio1" value="0" <?php if($leftTurn == "0" || $leftTurn == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="leftTurn" id="inlineRadio2" value="20" <?php if($leftTurn == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="leftTurn" id="inlineRadio3" value="40" <?php if($leftTurn == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="leftTurn" id="inlineRadio3" value="60" <?php if($leftTurn == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="leftTurn" id="inlineRadio3" value="80" <?php if($leftTurn == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="leftTurn" id="inlineRadio3" value="100" <?php if($leftTurn == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Turn Right/Emerge Right</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $rightTurn;?>%" aria-valuenow="<?php echo $rightTurn;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $rightTurn;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rightTurn" id="inlineRadio1" value="0" <?php if($rightTurn == "0" || $rightTurn == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rightTurn" id="inlineRadio2" value="20" <?php if($rightTurn == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rightTurn" id="inlineRadio3" value="40" <?php if($rightTurn == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rightTurn" id="inlineRadio3" value="60" <?php if($rightTurn == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rightTurn" id="inlineRadio3" value="80" <?php if($rightTurn == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rightTurn" id="inlineRadio3" value="100" <?php if($rightTurn == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  </div>
</div>

<!-- MANOEUVRES -->
<div class="container mt-5 skills">
<h5>Manoeuvres</h5>
  <div class="row">
    <div class="col-md-6">
      
        <p><strong>Bay Park Forwards</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $bayForward;?>%" aria-valuenow="<?php echo $bayForward;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $bayForward;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayForward" id="inlineRadio1" value="0" <?php if($bayForward == "0" || $bayForward == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayForward" id="inlineRadio2" value="20" <?php if($bayForward == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayForward" id="inlineRadio3" value="40" <?php if($bayForward == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayForward" id="inlineRadio3" value="60" <?php if($bayForward == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayForward" id="inlineRadio3" value="80" <?php if($bayForward == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayForward" id="inlineRadio3" value="100" <?php if($bayForward == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Bay Park Reverse</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $bayReverse;?>%" aria-valuenow="<?php echo $bayReverse;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $bayReverse;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayReverse" id="inlineMovingOff" value="0" <?php if($bayReverse == "0" || $bayReverse == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayReverse" id="inlineMovingOff" value="20" <?php if($bayReverse == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayReverse" id="inlineMovingOff" value="40" <?php if($bayReverse == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayReverse" id="inlineMovingOff" value="60" <?php if($bayReverse == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayReverse" id="inlineMovingOff" value="80" <?php if($bayReverse == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="bayReverse" id="inlineMovingOff" value="100" <?php if($bayReverse == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Pull up on Right</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $pullUpRight;?>%" aria-valuenow="<?php echo $pullUpRight;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $pullUpRight;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="pullUpRight" id="inlineRadio1" value="0" <?php if($pullUpRight == "0" || $pullUpRight == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="pullUpRight" id="inlineRadio2" value="20" <?php if($pullUpRight == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="pullUpRight" id="inlineRadio3" value="40" <?php if($pullUpRight == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="pullUpRight" id="inlineRadio3" value="60" <?php if($pullUpRight == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="pullUpRight" id="inlineRadio3" value="80" <?php if($pullUpRight == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="pullUpRight" id="inlineRadio3" value="100" <?php if($pullUpRight == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Parallel Park</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $parallel;?>%" aria-valuenow="<?php echo $parallel;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $parallel;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="parallel" id="inlineMovingOff" value="0" <?php if($parallel == "0" || $parallel == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="parallel" id="inlineMovingOff" value="20" <?php if($parallel == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="parallel" id="inlineMovingOff" value="40" <?php if($parallel == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="parallel" id="inlineMovingOff" value="60" <?php if($parallel == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="parallel" id="inlineMovingOff" value="80" <?php if($parallel == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="parallel" id="inlineMovingOff" value="100" <?php if($parallel == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>
  </div>
</div>

<!-- ROAD USE -->
<div class="container mt-5 skills">
<h5>Road Use</h5>
  <div class="row">
    <div class="col-md-6">
      
        <p><strong>Anticipation and Planning</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $anticipation;?>%" aria-valuenow="<?php echo $anticipation;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $anticipation;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="anticipation" id="inlineRadio1" value="0" <?php if($anticipation == "0" || $anticipation == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="anticipation" id="inlineRadio2" value="20" <?php if($anticipation == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="anticipation" id="inlineRadio3" value="40" <?php if($anticipation == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="anticipation" id="inlineRadio3" value="60" <?php if($anticipation == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="anticipation" id="inlineRadio3" value="80" <?php if($anticipation == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="anticipation" id="inlineRadio3" value="100" <?php if($anticipation == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Clearance to Obstructions</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $clearance;?>%" aria-valuenow="<?php echo $clearance;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $clearance;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="clearance" id="inlineMovingOff" value="0" <?php if($clearance == "0" || $clearance == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="clearance" id="inlineMovingOff" value="20" <?php if($clearance == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="clearance" id="inlineMovingOff" value="40" <?php if($clearance == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="clearance" id="inlineMovingOff" value="60" <?php if($clearance == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="clearance" id="inlineMovingOff" value="80" <?php if($clearance == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="clearance" id="inlineMovingOff" value="100" <?php if($clearance == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Meeting Traffic</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $meeting;?>%" aria-valuenow="<?php echo $meeting;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $meeting;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="meeting" id="inlineRadio1" value="0" <?php if($meeting == "0" || $meeting == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="meeting" id="inlineRadio2" value="20" <?php if($meeting == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="meeting" id="inlineRadio3" value="40" <?php if($meeting == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="meeting" id="inlineRadio3" value="60" <?php if($meeting == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="meeting" id="inlineRadio3" value="80" <?php if($meeting == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="meeting" id="inlineRadio3" value="100" <?php if($meeting == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Overtaking</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $overtaking;?>%" aria-valuenow="<?php echo $overtaking;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $overtaking;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="overtaking" id="inlineMovingOff" value="0" <?php if($overtaking == "0" || $overtaking == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="overtaking" id="inlineMovingOff" value="20" <?php if($overtaking == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="overtaking" id="inlineMovingOff" value="40" <?php if($overtaking == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="overtaking" id="inlineMovingOff" value="60" <?php if($overtaking == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="overtaking" id="inlineMovingOff" value="80" <?php if($overtaking == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="overtaking" id="inlineMovingOff" value="100" <?php if($overtaking == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Pedestrian Crossings</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $crossings;?>%" aria-valuenow="<?php echo $crossings;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $crossings;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossings" id="inlineRadio1" value="0" <?php if($crossings == "0" || $crossings == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossings" id="inlineRadio2" value="20" <?php if($crossings == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossings" id="inlineRadio3" value="40" <?php if($crossings == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossings" id="inlineRadio3" value="60" <?php if($crossings == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossings" id="inlineRadio3" value="80" <?php if($crossings == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="crossings" id="inlineRadio3" value="100" <?php if($crossings == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Rural Roads</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $rural;?>%" aria-valuenow="<?php echo $rural;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $rural;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rural" id="inlineRadio1" value="0" <?php if($rural == "0" || $rural == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rural" id="inlineRadio2" value="20" <?php if($rural == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rural" id="inlineRadio3" value="40" <?php if($rural == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rural" id="inlineRadio3" value="60" <?php if($rural == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rural" id="inlineRadio3" value="80" <?php if($rural == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="rural" id="inlineRadio3" value="100" <?php if($rural == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>
  <div class="col-md-6">
        <p><strong>Lane Positioning</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $lanePosition;?>%" aria-valuenow="<?php echo $lanePosition;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $lanePosition;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="lanePosition" id="inlineRadio1" value="0" <?php if($lanePosition == "0" || $lanePosition == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="lanePosition" id="inlineRadio2" value="20" <?php if($lanePosition == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="lanePosition" id="inlineRadio3" value="40" <?php if($lanePosition == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="lanePosition" id="inlineRadio3" value="60" <?php if($lanePosition == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="lanePosition" id="inlineRadio3" value="80" <?php if($lanePosition == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="lanePosition" id="inlineRadio3" value="100" <?php if($lanePosition == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Use of Speed</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $useSpeed;?>%" aria-valuenow="<?php echo $useSpeed;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $useSpeed;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="useSpeed" id="inlineRadio1" value="0" <?php if($useSpeed == "0" || $useSpeed == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="useSpeed" id="inlineRadio2" value="20" <?php if($useSpeed == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="useSpeed" id="inlineRadio3" value="40" <?php if($useSpeed == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="useSpeed" id="inlineRadio3" value="60" <?php if($useSpeed == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="useSpeed" id="inlineRadio3" value="80" <?php if($useSpeed == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="useSpeed" id="inlineRadio3" value="100" <?php if($useSpeed == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

<!-- OTHER -->
  <div class="container mt-5 skills">
<h5>Other</h5>
  <div class="row">
    <div class="col-md-6">
      
        <p><strong>Dual Carriageways</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $dualCarriage;?>%" aria-valuenow="<?php echo $dualCarriage;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $dualCarriage;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="dualCarriage" id="inlineRadio1" value="0" <?php if($dualCarriage == "0" || $dualCarriage == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="dualCarriage" id="inlineRadio2" value="20" <?php if($dualCarriage == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="dualCarriage" id="inlineRadio3" value="40" <?php if($dualCarriage == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="dualCarriage" id="inlineRadio3" value="60" <?php if($dualCarriage == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="dualCarriage" id="inlineRadio3" value="80" <?php if($dualCarriage == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="dualCarriage" id="inlineRadio3" value="100" <?php if($dualCarriage == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Independent Driving</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $independent;?>%" aria-valuenow="<?php echo $independent;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $independent;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="independent" id="inlineMovingOff" value="0" <?php if($independent == "0" || $independent == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="independent" id="inlineMovingOff" value="20" <?php if($independent == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="independent" id="inlineMovingOff" value="40" <?php if($independent == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="independent" id="inlineMovingOff" value="60" <?php if($independent == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="independent" id="inlineMovingOff" value="80" <?php if($independent == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="independent" id="inlineMovingOff" value="100" <?php if($independent == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Sat Nav Driving</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $satNav;?>%" aria-valuenow="<?php echo $satNav;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $satNav;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="satNav" id="inlineRadio1" value="0" <?php if($satNav == "0" || $satNav == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="satNav" id="inlineRadio2" value="20" <?php if($satNav == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="satNav" id="inlineRadio3" value="40" <?php if($satNav == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="satNav" id="inlineRadio3" value="60" <?php if($satNav == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="satNav" id="inlineRadio3" value="80" <?php if($satNav == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="satNav" id="inlineRadio3" value="100" <?php if($satNav == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>

  <p><strong>Emergency Stop</strong></p>
    <div class="progress mb-3" style="height: 15px">
      <div class="progress-bar bg-primary" role="progressbar" style="width: 
        <?php echo $emergencyStop;?>%" aria-valuenow="<?php echo $emergencyStop;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $emergencyStop;?>%</div>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="emergencyStop" id="inlineMovingOff" value="0" <?php if($emergencyStop == "0" || $emergencyStop == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="emergencyStop" id="inlineMovingOff" value="20" <?php if($emergencyStop == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="emergencyStop" id="inlineMovingOff" value="40" <?php if($emergencyStop == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="emergencyStop" id="inlineMovingOff" value="60" <?php if($emergencyStop == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="emergencyStop" id="inlineMovingOff" value="80" <?php if($emergencyStop == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="emergencyStop" id="inlineMovingOff" value="100" <?php if($emergencyStop == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineMovingOff">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Show Me Questions</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $showMe;?>%" aria-valuenow="<?php echo $showMe;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $showMe;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="showMe" id="inlineRadio1" value="0" <?php if($showMe == "0" || $showMe == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="showMe" id="inlineRadio2" value="20" <?php if($showMe == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="showMe" id="inlineRadio3" value="40" <?php if($showMe == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="showMe" id="inlineRadio3" value="60" <?php if($showMe == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="showMe" id="inlineRadio3" value="80" <?php if($showMe == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="showMe" id="inlineRadio3" value="100" <?php if($showMe == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  <div class="col-md-6">
        <p><strong>Tell Me Questions</strong></p>
          <div class="progress mb-3" style="height: 15px">
            <div class="progress-bar bg-primary" role="progressbar" style="width: 
              <?php echo $tellMe;?>%" aria-valuenow="<?php echo $tellMe;?>" aria-valuemin="0" aria-valuemax="100"><?php echo $tellMe;?>%</div>
          </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tellMe" id="inlineRadio1" value="0" <?php if($tellMe == "0" || $tellMe == NULL) print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio1">Not Started</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tellMe" id="inlineRadio2" value="20" <?php if($tellMe == "20") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio2">Introduced</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tellMe" id="inlineRadio3" value="40" <?php if($tellMe == "40") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Fully guided</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tellMe" id="inlineRadio3" value="60" <?php if($tellMe == "60") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tellMe" id="inlineRadio3" value="80" <?php if($tellMe == "80") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Seldom Prompted</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="tellMe" id="inlineRadio3" value="100" <?php if($tellMe == "100") print "checked"; ?>>
      <label class="form-check-label skills__label" for="inlineRadio3">Independent</label>
    </div>
  </div>

  </div>
</div>


<div class="container mt-5">
  <div class="row">
    <div class="col-md-12">
    <div class="form-group">
      <label for="exampleFormControlTextarea1"><h5>Notes for next lesson</h5></label>
      <textarea type="text" class="form-control" id="exampleFormControlTextarea1" name="notes" rows="4"></textarea>
    </div>
    </div>
  </div>
</div>

<div class="container">
    <input type="hidden" name="user-name" value="<?php echo $user_id;?>">
    <button type="submit" name="submit_all" class="btn btn-primary text-white" value="submit_all">Submit</button>
  </form>
</div>

<script>
  const deleteButton = document.getElementById('delete-btn');
  console.log(deleteButton);
</script>




    
    





