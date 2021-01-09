<?php 
    include('https://care-tech.herokuapp.com/Config.php');
    session_start();
    session_regenerate_id();
    function success()
    {
        echo ("<div class='success'>Account created successfully!</div>");
    }

    function fail()
    {
        echo ("<div class='fail'>Please complete your info</div>");
    }
    $id = $_SESSION['u_id'];
    if(isset($_POST['update']))
    {
        if (
            isset($_POST['username'])
            && isset($_POST['email'])
            && isset($_POST['pass'])
            && isset($_POST['phone'])
        )
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['pass'];
            $phone = $_POST['phone'];
            
            $result = mysqli_query($conn, "UPDATE users SET username='$username',email='$email',
            password='$password',phone='$phone' WHERE id=$id");  
            success();
            header("Location:uProfile.php");
        }
        else{
            fail();
        }  
    }

    

	$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id"); 
	$user_data = mysqli_fetch_array($result);

    $username = $user_data['username'];
    $email = $user_data['email'];
    
    $password = $user_data['password'];
    $phone = $user_data['phone'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Edit Profile</title>
    <!-- my css files -->    
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/css/bootstrap.css">
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/css/animate.css">
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/css/style.css" />
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/css/EditPProfile.css" />
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/css/uProfile.css" />
    <link rel="stylesheet" href="https://care-tech.herokuapp.com/css/EditPProfile.css" />

</head>
<body>
    <?php include('https://care-tech.herokuapp.com/header.php'); ?>
    <div class="prof-section">
        <div class="container">
            <div class="upper-prof row">
                <div class="img-prof col-3">
                <form name="update_user" method="post" action="EditUProfile.php">
                    <?php 
                        if($user_data['prof_img'] == '') {
                            ?>
                            <img src="https://care-tech.herokuapp.com/imgs/default-prof.png"/>       
                            <?php 
                        } else {
                            ?>
                            <img src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($user_data['prof_img']); ?>" /> 
                            <?php
                        }
                    ?>
                </div>
                    <div class="info-prof col-9">
                        <div class="account-name" style>
                            <label>User Name</label><br>
                            <input type="text" class="inputStyle" name="username" value="<?php echo $user_data['username'] ?>"  required>
                        </div>
                        <hr>
                        <div class="personal-info">
                            <label>password</label><br>
                            <input type="password" class="inputStyle" id="myInput" name="pass" value="<?php $user_data['password'] ?>" required>
                            <img src="https://care-tech.herokuapp.com/imgs/eye-slash-512.png" width="20px" onclick=" myFunction();" style="cursor: pointer;" />
                            
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone-square"></i>
                            <span> 
                                <input class="inputStyle" type="number" name="phone" value="<?php echo $phone ?>" required> 
                            </span>
                        </div>
                        <div class="mail">
                            <i class="fa fa-envelope-square"></i>
                            <span> 
                                <input type="Email" class="inputStyle" name="email" value="<?php echo $email ?>" required>
                            </span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <div >
                            <span> 
                            <input type="submit" class="btn btn-outline-info loc" name="update" value="Update">
                            </span>
                        </div>
                        <br>
				        
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <?php include('https://care-tech.herokuapp.com/footer.php'); ?>

    
    <script src="https://care-tech.herokuapp.com/js/jquery-3.5.1.min.js"></script>
    <script src="https://care-tech.herokuapp.com/js/Password.js"></script>
    <script src="https://care-tech.herokuapp.com/js/bootstrap.min.js"></script>
    <script src="https://care-tech.herokuapp.com/js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="https://care-tech.herokuapp.com/js/script.js"></script>
</body>
</html>