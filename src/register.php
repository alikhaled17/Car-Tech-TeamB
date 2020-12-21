<?php
    include('../Config.php');
    if (isset($_POST['submit']))
    {
        if(isset($_POST['UserName'])&& isset($_POST['Email'])&& isset($_POST['PWD'])&& isset($_POST['PhoneNum'])&& !empty($_POST['user-info']))
          {
            $username = $_POST['UserName'];
            $email = $_POST['Email'];
            $password = $_POST['PWD'];
            $PhoneNum = $_POST['PhoneNum'];
            $result = "INSERT INTO users (userName,userPassword,Email,Phone) VALUES ('$username','$password','$email','$PhoneNum')";
            if($_POST['user-info']=='Provider') 
            {
              if (isset($_POST['Car_Wash']))
              {
                echo"Car Wash";
              }  
              if(isset($_POST['Car_Wash']))
              {
                echo"Car_Maintenance";
              }
              if(isset($_POST['Gas_Station']))
              {
                echo"Gas_Station";
              }
              if(isset($_POST['Trailer_Truck']))
              {
                echo"Trailer_Truck";
              }
              // $status = $statusMsg = ''; 
              //     $status = 'error'; 
              //     if(!empty($_FILES["image"]["name"])) { 
              //         // Get file info 
              //         $fileName = basename($_FILES["image"]["name"]); 
              //         $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
                      
              //         // Allow certain file formats 
              //         $allowTypes = array('jpg','png','jpeg','gif'); 
              //         if(in_array($fileType, $allowTypes)){ 
              //             $image = $_FILES['image']['tmp_name']; 
              //             $imgContent = addslashes(file_get_contents($image)); 
              //             $id = $conn->query("SELECT id from users where Email='$email'"); 
              //             // Insert image content into database 
              //             $insert = $conn->query("INSERT into providers_info (User_id,IDimage,commimage	) VALUES ('$id','$imgContent','$imgContent')"); 
                          
              //             if($insert){ 
              //                 $status = 'success'; 
              //                 $statusMsg = "File uploaded successfully."; 
              //             }else{ 
              //                 $statusMsg = "File upload failed, please try again."; 
              //             }  
              //         }else{ 
              //             $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
              //         } 
              //     }else{ 
              //         $statusMsg = 'Please select an image file to upload.'; 
              //     } 
              
              
              // Display status message 
              // echo $statusMsg; 
              



            }
          }
            if ($conn->query($result) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $result . "<br>" . $conn->error;
              }
              
        
        
    }

?>



