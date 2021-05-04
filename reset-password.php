<?php 
    



    
?>


<!DOCTYPE html>
<html lang="en">

<title>Login</title>

<?php include('header.php');?>


<div class="hero">
<div class="content">
    <div class="container">
      <div class="row row-content">
        <div class="col-md-6 order-md-2">
         
        </div>
        <div class="col-md-5 mt-5 contents">
          <div class="row justify-content-center">
            <div class="col-md-8 box">
              <div class="mb-4">
              <h3>Reset Password</h3>
              <p class="mb-4">An email will be send to you with instructions to reset your password</p>
            </div>
            <form action="./src/includes/reset-request.inc.php" method="post">
              <div class="form-group first">
              <label for="email">Username</label>
              <input type="email" name="user-email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="" required>

              </div>
            
              <button type="submit" name="reset-request-submit" class="btn text-white btn-block btn-primary" value="sign-up">Reset Password by email</button>
              
            </form>
            <?php if(isset($_GET["reset"])){
                if($_GET["reset"] == "success") {
                    echo '<p>Please check your e-mail</p>';
                }
                }?>

            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>
  </div>

<?php include('footer.php');?>