<?php 

require_once "connection.php";
require_once "session.php";



if(!isset($_SESSION["logged_in"])){
    header('Location: login.php');
    exit;
}



$q = intval($_GET['q']);


$sql = "SELECT messages.messageID, 
messages.message,
messages.date, 
messages.usersID, 
users.id, 
users.name 
FROM messages JOIN users ON messages.usersID = users.id 
WHERE messages.messageID =  '".$q."'";
$result = mysqli_query($db, $sql);

while($row = mysqli_fetch_array($result)) {
    $message = $row['message'];
    $message_id = $row['messageID'];
    $name = $row['name'];
    $date = $row['date'];
    $user_id = $row['usersID'];

    $date = strtoTime($date);
    $date_format = date("d-m-Y H:i:s", $date);

}


mysqli_close($db);


?>


<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><small>from</small> <?php echo $name;?> <small><?php echo $date_format;?> </small></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
        <?php echo $message;?>
        
      </div>
      <div class="reply-box" id="reply-bx">
        <form method="POST" action="">
       
          <label for="exampleFormControlTextarea1"><h6>Reply</h6></label>
          <textarea type="text" class="form-control message" id="reply-message" name="message" rows="4"></textarea>
          <div class="error"></div>
          <button name="reply_message" data-value="<?php echo $user_id;?>" id="reply" class="btn btn-primary text-white">Send</button>
          <button data-value="<?Php echo $message_id;?>" name="delete-message" id="delete-btn" class="btn btn-outline-danger">Delete</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
          
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

