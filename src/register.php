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
    if($_POST['user-info']=='Provider')
   { if($_SERVER['REQUEST_METHOD'] == "POST") {
      if(!empty($_FILES["commercial_ID"]["tmp_name"])) { 
        $fileName = basename($_FILES["commercial_ID"]["tmp_name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);     
        $allowTypes = array('jpg','png','jpeg','gif'); 
        // if(in_array($fileType, $allowTypes)){ 
          $image = $_FILES['image']['tmp_name']; 
          $imgContent = addslashes(file_get_contents($image)); 
        $fileName = basename($_FILES["image"]["tmp_name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);     
        $allowTypes = array('jpg','png','jpeg','gif'); 
          // if(in_array($fileType, $allowTypes)){ 
            $imageID = $_FILES['commercial_ID']['tmp_name']; 
            $imgID = addslashes(file_get_contents($imageID)); 
          $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
          $row = $result->fetch_assoc();
          $id =  $row['id'];
          $conn->query("UPDATE users SET Type = 'Provider' WHERE id ='$id'");
          $conn->query("INSERT INTO providers_info (User_id,IDimage,commimage	) VALUES ('$id','$imgID','$imgContent')"); 
        // }
      }
      if(isset($_POST['Gas_Station'])) { 
        $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
          $row = $result->fetch_assoc();
          $id =  $row['id'];
          $conn->query("INSERT INTO services (user_id,servicename) VALUES ('$id','Gas Station')");
        // $Gas_Station=$_POST['Gas_Station'];
        // echo $Gas_Station;
      }
      if(isset($_POST['Car_Wash'])) { 
        $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
          $row = $result->fetch_assoc();
          $id =  $row['id'];
          $conn->query("INSERT INTO services (user_id,servicename) VALUES ('$id','Car Wash')");
        // $Car_Wash=$_POST['Car_Wash'];
        // echo $Car_Wash;
      } 
      if(isset($_POST['Car_Maintenance'])) { 
        $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
          $row = $result->fetch_assoc();
          $id =  $row['id'];
          $conn->query("INSERT INTO services (user_id,servicename) VALUES ('$id','Car Maintenance')");
        // $Car_Maintenance=$_POST['Car_Maintenance'];
        // echo $Car_Maintenance;
      } 
      if(isset($_POST['Trailer_Truck'])) { 
        $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
          $row = $result->fetch_assoc();
          $id =  $row['id'];
          $conn->query("INSERT INTO services (user_id,servicename) VALUES ('$id','Trailer Truck')");
          // $Trailer_Truck=$_POST['Trailer_Truck'];
          // echo $Trailer_Truck;
      }
      if(isset($_POST['city'])) {
        $selected = $_POST['city'];
        $result = $conn->query("SELECT id FROM users WHERE Email='$email'"); 
        $row = $result->fetch_assoc();
        $id =  $row['id'];
        $Region = $_POST['Region'];
        // echo 'You have chosen: ' . $selected;
        $conn->query("INSERT INTO city (user_id,city,Region) VALUES ('$id','$selected','$Region')");
      }
    } 
  }
}
}
//header("Location:signin.php");
?>
