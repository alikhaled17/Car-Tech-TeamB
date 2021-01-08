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

    if ($rows == 1) {
        $user_data = mysqli_fetch_array($result);
        if($user_data["account_type"] == "Client") 
        {
            $_SESSION['u_id'] = $user_data["id"];
            header("Location: uProfile.php");
        }
        else
        {
            $_SESSION['p_id'] = $user_data["id"];
            header("Location: pProfile.php");
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
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/animate.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/login.css" />

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
                    <img src="/Car-Tech-TeamB/imgs/login-img.png" width="100%">
                </div>
            </div>
        </div>
    </div>

    <?php include('../footer.php'); ?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../js/script.js"></script>
</body>

</html>