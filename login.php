<?php 

    require_once "connection.php";
    require_once "session.php";

$error = $email = $id = '';

if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
      
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //validate if email is empty
    if (empty($email)) {
        $error .= '<div class="alert alert-danger">
                    Please type in your email address </div>';
    }
    //Validate if password is empty
    if (empty($password)) {
        $error .= '<div class="alert alert-danger">
                    Please enter your password </div>';
    }

    if(empty($error)) {
        if($query = $db->prepare('SELECT id, password, name FROM users WHERE email = ?')) {
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        
    
        if($query->num_rows > 0){
            $query->bind_result($id, $pass, $name);
            $query->fetch();
            

            if(password_verify($password, $pass)) {
                session_regenerate_id();
                $_SESSION["logged_in"] = TRUE;
                $_SESSION["name"] = $name;
                $_SESSION["user_id"] =$id;
               
                if ($id === 7){
                    header('Location: admin.php');
                    exit;
                } else {
                    header('Location: profile.php');
                    exit;
                }
                
                
            } else {
                $error .= '<div class="alert alert-danger">
                    Invalid password or username please try again</div>';
            }
            
        } else {
            $error .= '<div class="alert alert-danger">
                Invalid password or username please try again</div>';
        }
        
        $query->close();   
    }

    mysqli_close($db);  
}
}
    
?>

<!DOCTYPE html>
<html lang="en">

<title>Login</title>

<?php include('header.php');?>


<div class="hero">
<div class="content">
    <div class="container">
      <div class="row row-content">
        <div class="col-lg-7 order-md-2 iphone-container">
          <img src="./src/img/iphone-mock.png" class="phone-img" alt="iphone-mock">
        </div>
        <div class="col-lg-5 contents mb-4">
          <div class="row justify-content-center">
            <div class="col-md-8 box">
              <div class="mb-4">
              <h3>Sign in </h3>
              <p class="mb-4">This is a demo site with dummy data. Please select how you would like to log in below and use predefined username and password fields</p>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                <label class="form-check-label" for="inlineRadio1"><span style="color:#0fc4b0">Student</span></label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" >
                <label class="form-check-label" for="inlineRadio2"><span style="color:#0fc4b0">Instructor (admin)</span></label>
              </div>
            </div>
            <div>
                <?php echo $error;?>
                <?php if(isset($_GET["newpwd"])) {

                  if($_GET["newpwd"] == "passwordupdated"){
                    echo '<p>Your password has been reset</p>';
                  }
                 
                  }?>
            </div>
            <form action="#" method="POST">
              <div class="form-group first">
              <label for="email">Username</label>
              <input type="email" name="email" class="form-control username-field" id="exampleInputEmail1" aria-describedby="emailHelp" value="janedoe@jcloud.com" >


              </div>
              <div class="form-group last mb-4">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control password-field" id="exampleInputPassword1" value='Student1234'  >
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="reset-password.php" class="forgot-pass">Forgot Password</a></span> 
              </div>
              <button type="submit" name="submit" class="btn text-white btn-block btn-primary" value="sign-up">Login</button>
              
              <div>
                <p>Dont have an account? <a href="sign-up.php">Register here!</a></p>
            </div>
              
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
  </div>


<script>
const emailField = document.querySelector(".username-field");
const passwordField = document.querySelector(".password-field");

const studentRadio = document.getElementById('inlineRadio1');
const instructorRadio = document.getElementById('inlineRadio2');

instructorRadio.addEventListener('change', ()=>{
  if (instructorRadio.checked = true ){
    emailField.value= 'admin@ontrackdb.co.uk'
    passwordField.value = 'Admin1234';
} 
})

studentRadio.addEventListener('change', ()=>{
  if (studentRadio.checked = true ){
    emailField.value= 'janedoe@jcloud.com'
    passwordField.value = 'Student1234';
}
})

</script>
  
<?php include('footer.php');?>
