<?php
include('../Config.php');
if (isset($_POST['submit'])) {      
    
  if(
    isset($_POST['UserName'])
    && isset($_POST['Email'])
    && isset($_POST['PWD'])
    && isset($_POST['PhoneNum'])
    && !empty($_POST['user-info']))
  {
    $username = $_POST['UserName'];
    $email = $_POST['Email'];
    $password = $_POST['PWD'];
    $PhoneNum = $_POST['PhoneNum'];
    $conn->query("INSERT INTO users (userName,userPassword,Email,Phone) VALUES ('$username','$password','$email','$PhoneNum')");

    if($_SERVER['REQUEST_METHOD'] == "POST") {

      if(!empty($_FILES["commercial_ID"]["tmp_name"])) { 
        $fileName = basename($_FILES["commercial_ID"]["tmp_name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);     
        $allowTypes = array('jpg','png','jpeg','gif'); 
        
        // if(in_array($fileType, $allowTypes)){ 
        
          $image = $_FILES['commercial_ID']['tmp_name']; 
          $imgContent = addslashes(file_get_contents($image)); 
          $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
          $row = $result->fetch_assoc();
          $id =  $row['id'];
          $conn->query("INSERT INTO providers_info (User_id,IDimage,commimage	) VALUES ('$id','$imgContent','$imgContent')"); 
        
        // }
    
      }
    }
    
    
    
  }

}

?>
