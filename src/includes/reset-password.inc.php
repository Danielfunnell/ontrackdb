<?php 

if(isset($_POST['reset-password-submit'])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"];
    
    if(empty($password) || empty($passwordRepeat)) {
        header("Location: ../../reset-password.php");
        exit();
    } else if($password != $passwordRepeat){
        header("Location: ../../create-new-password.php?newpwd=pwdnotsame");
        exit();

    }

    $currentDate = date("U");

    require "../../connection.php";

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >=?";
    $stmt = mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        //?
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate); 
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if(!$row = mysqli_fetch_assoc($result)){
            echo "You need to re-submit your reset request" . $currentDate . '/br>'
            . $selector;
            exit();
        } else {
            //got to here // no $["pwdResetToken]
            $pwdReset = $row["pwdResetToken"];
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $pwdReset);

            if($tokenCheck === false){
                echo  "errors" . $pwdReset . '</br>'. $tokenBin;
                exit();

            } else if($tokenCheck === true){
                // SELECT users password that matchs email field
                $tokenEmail = $row['pwdResetEmail'];

                $sql = "SELECT * FROM users WHERE email=?;";
                $stmt = mysqli_stmt_init($db);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "There was an error";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s",  $tokenEmail);
                    mysqli_stmt_execute($stmt);

                    $result = mysqli_stmt_get_result($stmt);

                    if(!$row = mysqli_fetch_all($result)){
                        echo "There was an error!";
                        exit();
                    } else {
                        // UPDATE users password
                        $sql = "UPDATE users SET password=? WHERE email=?;";

                        $stmt = mysqli_stmt_init($db);
                        if(!mysqli_stmt_prepare($stmt, $sql)) {
                            echo "There was an error";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail);
                            mysqli_stmt_execute($stmt);

                            //DELETE existing tokens
                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($db);
                            if(!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error";
                                exit();
                            } else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail); 
                                mysqli_stmt_execute($stmt);
                                header("Location: ../../create-new-password.php?newpwd=passwordupdated");
                            }
                        }
                    }

                }
                
            }
        }
    }




} else {
    header("Location: ../login.php");
}


?>