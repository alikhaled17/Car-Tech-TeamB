<?php
include('../Config.php');

if (isset($_POST['submit'])) {   
  if(
    isset($_POST['username'])
    && isset($_POST['email'])
    && isset($_POST['pass'])
    && isset($_POST['phone'])
    && isset($_POST['gender'])
    && !empty($_POST['user-info'])) 
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $gender = $_POST['gender'];
    $Phone = $_POST['phone'];
    
    $conn->query("INSERT INTO users (username, email, password, gender, phone) VALUES ('$username','$email','$password', '$gender','$Phone')");
    
    if($_POST['user-info']=='Provider') {
      if($_SERVER['REQUEST_METHOD'] == "POST") {
      if(!empty($_FILES["commercial_ID"]["tmp_name"])) { 
        $fileName = basename($_FILES["commercial_ID"]["tmp_name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);     
        $allowTypes = array('jpg','png','jpeg','gif'); 
        $image = $_FILES['image']['tmp_name']; 
        $imgContent = addslashes(file_get_contents($image)); 
        $fileName = basename($_FILES["image"]["tmp_name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowTypes = array('jpg','png','jpeg','gif'); 
        $imageID = $_FILES['commercial_ID']['tmp_name'];
        $imgID = addslashes(file_get_contents($imageID));
        $result = $conn->query("SELECT id FROM users WHERE email='$email'");
        $row = $result->fetch_assoc();
        $id =  $row['id'];

        $conn->query("UPDATE users SET account_type = 'Provider' WHERE id ='$id'");
        $conn->query("INSERT INTO providers (user_id,ID_img,comm_img	) VALUES ('$id','$imgID','$imgContent')"); 

        if(isset($_POST['Gas_Station'])) { 
            $conn->query("INSERT INTO services (p_id,ser_name) VALUES ('$id','Gas Station')");
        }
        if(isset($_POST['Car_Wash'])) { 
            $conn->query("INSERT INTO services (p_id,ser_name) VALUES ('$id','Car Wash')");
        } 
        if(isset($_POST['Car_Maintenance'])) { 
            $conn->query("INSERT INTO services (p_id,ser_name) VALUES ('$id','Car Maintenance')");
        } 
        if(isset($_POST['Trailer_Truck'])) { 
            $conn->query("INSERT INTO services (p_id,ser_name) VALUES ('$id','Trailer Truck')");
        }
        if(isset($_POST['city'])) {
          $selected = $_POST['city'];
          $Region = $_POST['Region'];
          $conn->query("INSERT INTO city (p_id,city,region) VALUES ('$id','$selected','$Region')");
        }
      }
    } 
  }
}
}
//header("Location:signin.php");
?>
