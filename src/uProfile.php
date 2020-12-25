<?php 
    include('../Config.php');  
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Contact</title>
    <!-- my css files -->    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/uProfile.css" />

    <script src="../js/responde.js"></script>    
</head>
<body>
    
    <?php include('../header.php'); ?>

    <div class="prof-section">
        <div class="container">
            <div class="upper-prof row">
                <div class="img-prof col-3">
                    <?php 
                        $id= $_SESSION['id'];
                        $sql = "SELECT * FROM users WHERE id = '$id'";
                        $result = $conn->query($sql);
                        $rows = $result->fetch_assoc();
                    ?> 
                    <img src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($rows['prof_img']); ?>" /> 
                </div>
                <div class="info-prof col-9">
                    <div class="account-name">
                        <h3>
                            <?php 
                                echo $rows['username'];
                            ?>
                        </h3>
                    </div>
                    <hr>
                    <div class="personal-info">
                        <div class="gender">
                            <i class="fa fa-venus-mars"></i>
                            <span>
                                <?php
                                    echo $rows['gender'] ;
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="phone">
                        <i class="fa fa-phone-square"></i>
                        <span> 
                            <?php
                               echo $rows['phone'] ;
                            ?>
                        </span>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="col-9 contact-info">
                    
                    
                </div>
            </div>
        </div>
    </div>
    
    <!-- Services -->
    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>