
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>db on track</title>
    <link rel= "stylesheet" type="text/css" href="dist/css/app.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    
</head>

<body>

<nav class="navbar navbar-expand-lg">

    <!-- Brand -->
   
      <a class="navbar-brand navbar__logo" href="#">
        <img src="./src/img/ontrack-logo.png" alt="Logo" style="width:150px;">
      </a>
  

      <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

     <?php if(isset($_SESSION["name"]))
     { ?> 
     
     <!-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> -->
        <ul class="navbar-nav ml-auto">
        
            <?php 
              $user = $_SESSION["user_id"];
              if($user){
                $sql = "SELECT messages.messageID, messages.message, messages.date, messages.usersID, messages.replyID, users.id, users.name FROM messages LEFT JOIN users ON messages.usersID = users.id WHERE users.id = $user AND messages.replyID = 7 ORDER BY messages.date DESC";
                
               if ($user === 7){
                $sql = "SELECT messages.messageID, messages.message, messages.date, messages.usersID, users.id, users.name FROM messages LEFT JOIN users ON messages.usersID = users.id WHERE users.id != 7 AND messages.replyID != 7 ORDER BY messages.date DESC";
              }
                
                $messages = mysqli_query($db, $sql);
            

              if($messages->num_rows >= 0) {
                $total = $messages->num_rows;
              
              ?><li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle message-dropdown" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-comment-alt message-icon"><div class="message-total"><?php echo $total;?></div></i>
                </a>
                <div class="dropdown-menu messages" aria-labelledby="navbarDropdownMenuLink">
                <h6 class="messages__heading">MESSAGE CENTER</h6>

              <?php 
              while($row = $messages->fetch_assoc()) {
                $message = $row['message'];
                $name_header = $row['name'];
                $date = $row['date'];
                $message_id = $row['messageID'];
                
              echo
              '<a data-value="' . $message_id . '" class="dropdown-item d-flex align-items-center messages__item">' .
               
              '<div class="font-weight-bold">
                    <div class="text-truncate">' . substr($message, 0,35) . '....' . '</div>
                    <div class="small text-gray-500">' . $name_header . ' ' . $date . '</div>
                </div>
              </a>'; 
          }
            }
              }?>
            
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php list($firstName, $lastName) = explode(' ', $_SESSION["name"]);
              
              echo 'Hey' . ' ' . $firstName;?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="logout.php">Log Out</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
         
        </ul>
       
     <?php };?> 
      
     <?php if(!isset($_SESSION['user_id'])) {

        echo 
        '<button class="btn btn-primary mt-1 my-2 my-sm-0 ml-auto navbar__signup" type="submit"> <a href="sign-up.php" class="text-white"> Sign Up</a></button>';
     }?>
      
    
    </div>
</nav>
