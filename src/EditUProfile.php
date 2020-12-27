<?php 
    include('../Config.php');
    session_start();
    session_regenerate_id();
    $id = $_SESSION['u_id'];
    if(isset($_POST['update']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];

        $result = mysqli_query($conn, "UPDATE users SET username='$username',email='$email',
        password='$password',gender='$gender',phone='$phone' WHERE id=$id");  
        
        header("Location:uProfile.php");
    }
    

	$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id"); 
	$user_data = mysqli_fetch_array($result);

    $username = $user_data['username'];
    $email = $user_data['email'];
    $password = $user_data['password'];
    $gender = $user_data['gender'];
    $phone = $user_data['phone'];

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Profile</title>
    <!-- my css files -->    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/uProfile.css" />
    <link rel="stylesheet" href="../css/EditUProfile.css" />


    <script src="../js/responde.js"></script>    
</head>
<body>
    <?php include('../header.php'); ?>
    <div class="prof-section">
        <div class="container">
            <div class="upper-prof row">
                <div class="img-prof col-3">
                    <?php 
                        if($user_data['prof_img'] == '') {
                            ?>
                            <img src="../imgs/default-prof.png"/>       
                            <?php 
                        } else {
                            ?>
                            <img src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($user_data['prof_img']); ?>" /> 
                            <?php
                        }
                    ?>
                </div>
                <form name="update_user" method="post" action="EditUProfile.php">
                    <div class="info-prof col-9">
                        <div class="account-name">
                            <h3>
                            <input type="text" class="inputStyle" name="username" value="<?php echo $username ?>"  required>
                            </h3>
                        </div>
                        <hr>
                        <div class="personal-info">
                            <input type="password" class="inputStyle" name="pass" value="<?php echo $password ?>" required>
                            <div class="gender">
                                <i class="fa fa-venus-mars"></i>
                                <span class="gender-span">
                                <input type="radio" class="RadioStyle" name="gender" value="Male"  required/>
                                <label class="gender">Male</label>
                                <input type="radio" class="RadioStyle" name="gender" value="Female" required />
                                <label class="gender">Female</label><br>
                                </span>
                            </div>
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
    
    <?php include('../footer.php'); ?>

    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>