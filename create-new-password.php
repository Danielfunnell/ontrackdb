<?php 
    



    
?>


<!DOCTYPE html>
<html lang="en">

<title>Create new password</title>

<?php include('header.php');?>


<div class="hero">
<div class="content">

    <div class="container">
      <div class="row row-content">
        <div class="col-md-6 order-md-2">
         
        </div>
        <div class="col-md-5 contents mt-4">
          <div class="row justify-content-center">
            <div class="col-md-8 box">
              <div class="mb-4">
              

            <?php 
        $selector = $_GET["selector"];
        $validator = $_GET["validator"];

        if(isset($_GET["newpwd"])){
          if($_GET["newpwd"] == "passwordupdated") {
              echo '<p class="alert alert-success" role="alert">New password created</p></br>';
              echo '<a href="login.php">Login here!</a>';
          }
          } else if(empty($selector) || empty($validator)){
            echo 'We could not validator your request';
        } else {
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                ?>
                <h3>Reset Password</h3>
                  <p class="mb-4">Please type in a new password to reset.</p>
                </div>
                 <form action="./src/includes/reset-password.inc.php" method="post">
                    <input type="hidden" name="selector" value="<?php echo $selector;?>">
                    <input type="hidden" name="validator" value="<?php echo $validator;?>">
                    <div class="form-group first">
                    <label for="pwd">Enter a new password</label>
                    <input type="password" name="pwd" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <label for="pwd-repeat">Repeat new password</label>
                    <input type="password" name="pwd-repeat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    
                    <button type="submit" name="reset-password-submit" class="btn text-white btn-block btn-primary" value="sign-up">Reset Password</button>
              

                <?php

            }
        }


    ?>

           
            </form>
            

            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
  </div>

<?php include('footer.php');?>