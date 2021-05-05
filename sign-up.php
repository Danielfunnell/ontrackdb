<?php 

require_once "connection.php";
require_once "session.php";

$fullname = $email = $telephone = $error = '';


if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    //trim removes whitespace 
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $telephone = trim($_POST['telephone']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    


    if($query = $db->prepare("SELECT * FROM users WHERE email = ?" )) {
        $error = '';
        $query->bind_param('s', $email);
        $query->execute();
        // store result to check if user already exists
        $query->store_result();
            if($query->num_rows > 0){
                $error .= '<div class="alert alert-danger" role="alert">
                                This email address is already registered!</div>';

            } else {
                //validate email address
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error .= '<div class="alert alert-danger" role="alert">
                                 Email is not a valid email!</div>';   
                }
                // validate password
                if(strlen($password) < 6){
                    $error .= '<div class="alert alert-danger" role="alert">
                                 Password must be more than 6 characters long!</div>';   
                }

                // validate confirm password
                if(empty($confirm_password)){
                    $error .= '<div class="alert alert-danger " role="alert">
                                Please enter confirmed password</div>';
                } else {
                    if(empty($error) && $password != $confirm_password){
                        $error .= '<div class="alert alert-danger custom-alert" role="alert">
                                Passwords do not match!</div>'; 
                    }
                }

                if(empty($error)) {
                    $insertQuery = $db->prepare("INSERT INTO users (name, email, telephone, password) VALUES(?, ?, ?, ?);");
                    $insertQuery->bind_param("ssss", $fullname, $email, $telephone, $password_hash);
                    $result = $insertQuery->execute();
                    if($result){
                        $error .= '<div class="alert alert-success" role="alert">
                                    Registration was successful!</div>';
                    }else {
                        $error .= '<div class="alert alert-danger" role="alert">
                                    Something went wrong</div>';
                    }
                }

            } 
    }
    
    $query->close();
    //$insertQuery->close();  
    mysqli_close($db);
    
}
    
?>

<!DOCTYPE html>
<html lang="en">

<title>Sign-up</title>

<?php include('header.php');?>


<div class="hero">
<div class="content">
    <div class="container">
      <div class="row row-content">
        <div class="col-md-6 order-md-2">
          <img src="./src/img/iphone-mock.png" class="phone-img" alt="iphone-mock">
        </div>
        <div class="col-md-6 contents mb-4">
          <div class="row justify-content-center">
            <div class="col-md-8 box">
              <div class="mb-4">
              <h3>Sign Up to On-track</h3>
              <p class="mb-4">Stay organised, track your progress with your driving lesson reports, next lesson details and targets
              all in one secure area.</p>
            </div>
            <div>
                <?php echo $error;?>
            </div>
            <form action="#" method="post">
              <div class="form-group first">
              <label for="name">Full Name</label>
              <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($fullname);?>" required> 
             </div>

              <div class="form-group last mb-4">
              <label for="email">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo htmlspecialchars($email);?>" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
              </div>

              <div class="form-group last mb-4">
              <label for="telephone">Telephone</label>
              <input type="tel" name="telephone" class="form-control" value="<?php echo htmlspecialchars($telephone);?>" required>    
              </div>

              <div class="form-group last mb-4">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" required> 
                
              </div>

              <div class="form-group last mb-4">
              <label for="exampleInputPassword1">Confirm password</label>
            <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword2" required> 
                
              </div>


              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div>
              <button type="submit" name="submit" class="btn text-white btn-block btn-primary" value="sign-up">Submit</button>
              
              <div>
                <a href="login.php">Already registered click to Login</a>
            </div>
              
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
  </div>


<?php include('footer.php')?>