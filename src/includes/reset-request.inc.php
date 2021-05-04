<?php 



if(isset($_POST['reset-request-submit'])){

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    $url = "www.ontrackdb.co.uk/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    $expire = date("U") + 1800;

    require "../../connection.php";


    $userEmail = $_POST["user-email"];

    // delete any existing tokens
    $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail); 
        mysqli_stmt_execute($stmt);
    }

    // insert token into database
    $sql = "INSERT INTO pwdreset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";

    $stmt = mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error";
        exit();
    } else {
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expire); 
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($db);

    //send user email
    $to = $userEmail;

    $subject = 'Reset password form ontrackdb';

    $message = '<p>We recieved a password reset request. The link to reset your password is below. If you did not request this you can
    ignore this emal.</p>';
    $message .= '<p>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: ontrackdb <daniel@ontrackdb.co.uk>\r\n";
    $headers .= "Reply-To: <daniel@ontrackdb.co.uk.co.uk>\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../../reset-password.php?reset=success");

} else {
    header("Location: ../../login.php");
}




?>