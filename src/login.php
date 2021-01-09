<?php
include('../Config.php');
ob_start();
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pass'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $user_data = mysqli_fetch_array($result);

    if ($rows == 1) {
        if($user_data["account_type"] == "Client") 
        {
            

            $_SESSION['u_id'] = $user_data["id"];
            header("Location: uProfile.php");

        }
        else
        {

            $sub_query = "
                INSERT INTO login_details (user_id) 
                VALUES ('".$user_data['id']."')
            ";
            $statement = $conn->prepare($sub_query);
            $statement->execute();

            $sq = "SELECT * FROM login_details WHERE user_id = '". $user_data['id'] ."'";
            $cat = mysqli_query($conn, $sq);
            $hh = mysqli_fetch_array($cat);

            $_SESSION['login_details_id'] = $hh['login_details_id'];


            $sql = "SELECT * FROM users ";
            if ($user_data["account_type"] == "Provider"){
                $sql .= "inner join providers on providers.user_id = users.id";
            }
            
            $sql .= " WHERE email = '$email' and password = '$pass'";
            $result = mysqli_query($conn, $sql);
            $rows = mysqli_num_rows($result);
            $user_data = mysqli_fetch_array($result);

            if($user_data["prov_state"] == "accept"  ){
                $_SESSION['p_id'] = $user_data["user_id"];
                header("Location: pProfile.php");
            } else {
                $_SESSION['info'] = "The data will be reviewed within 24 hours.'<br>'Please try after 24 hours of registration.";
                header('location: login.php');
                exit();
            }
        }
    } else {
        header("Location: login.php");
    }
} 
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Login</title>
    <!-- my css files -->
    <link rel="icon" href="imgs/icon.png" type="https://car-tch.herokuapp.comimage/icon type">

    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/bootstrap.css" />
    <link rel="stylesheet" href="https://car-tch.herokuapp.comfonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/animate.css" />
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/style.css" />
    <link rel="stylesheet" href="https://car-tch.herokuapp.comcss/login.css" />

    <script src="https://code.jquery.com/jquery-1.12.4.min.js">
    </script>
</head>

<body>

    <?php include('../header.php'); ?>

    <div class="login-section row">
        <div class="container">
            <div class="left-side col-7">
                <h2>Login</h2>
                <hr>
                <?php include '../flash_messages.php';?>
                <div form-login>
                    <form action="" method="post">
                        <label>Your Email</label>
                        <input type="email" name="email" placeholder="Email"><br>
                        <label>Your Password</label>
                        <input type="password" name="password" placeholder="Password"><br>
                        <input type="submit" value="Login" name="login" class="btn btn-outline-dark">
                    </form>
                </div>
            </div>
            <div class="right-side col-5">
                <div class="login-img">
                    <img src="https://car-tch.herokuapp.comimgs/login-img.png" width="100%">
                </div>
            </div>
        </div>
    </div>

    <?php include('../footer.php'); ?>

    <script src="https://car-tch.herokuapp.comjs/jquery-3.5.1.min.js"></script>
    <script src="https://car-tch.herokuapp.comjs/bootstrap.min.js"></script>
    <script src="https://car-tch.herokuapp.comjs/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="https://car-tch.herokuapp.comjs/script.js"></script>
</body>

</html>