<?php 

require_once "connection.php";
require_once "session.php";

//Reply to message

if(isset($_POST['message']) && isset($_POST['userId'])) {

    $message = test_input($_POST['message']);
    $user_id = $_POST['userId'];
    $reply_id = $_SESSION['user_id'];


    $sql_insert = $db->prepare("INSERT INTO messages (message, usersID, replyID) VALUES (?, ?,?);"); 
    $sql_insert->bind_param("sii", $message, $user_id, $reply_id);
    $results = $sql_insert->execute();
  
    if($results) {
      $error .= 'Message delivered thankyou';
    }else {
      echo "Error";
    }
}

//mysqli_close($db);

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}

// Delete message
$q = intval($_GET['q']);

  $sql_delete = "DELETE from messages WHERE messageID = '".$q."'";

  if (mysqli_query($db, $sql_delete)) {
    echo "Record deleted successfully";
  } else {
    echo "Error deleting record: " . mysqli_error($db);
  }

  mysqli_close($db);

?>

<h1><?php echo "hello"?></h1>