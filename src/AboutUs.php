<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech</title>
    <!-- my css files -->    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/home.css" />
</head>
<body>
    <?php include('../header.php'); ?>
    <?php include('../Config.php'); ?>

    <div class="about-us row">
        <div class="container">
            <div class="left-side col-2">
                <h2 class="aboutH2">About us</h2>
            </div>
            <div class="right-side col-10">
                <div></div>
                <p>
                Our expertise with various vehicles, automotive technologies is as diverse as the people .
                We believe in the power of ordinary people to do extra ordinary things.
                We employ our collective potential to vastly improve your automotive service experience.
                We all have one thing in common .. Passion for the automobile.
            </p>
            </div>
        </div>
    </div>

    <div id="port" class="our-team row">
        <div class="container">
            <h2>Our Team </h2>
            <p>Our team is your team. When your mission is to be better, faster and smarter, you need the best people driving your vision forward , Get to know some of us.</p>
            <div class="box">
                <div class="member wow bounceInUp">
                    <div class="overlay">Ali</div>
                    <img src="../imgs/ali_k.jpg" alt="">
                </div>
                <div class="member wow bounceInUp">
                    <div class="overlay">Mayar</div>                    
                    <img src="../imgs/mayar_a.jpg" alt="">
                </div>
                <div class="member wow bounceInDown">
                    <div class="overlay">Mahmoud</div>                    
                    <img src="../imgs/mahmoud_Y.jpg" alt="">
                </div>
                <div class="member wow bounceInDown">
                    <div class="overlay">Turki</div>
                    <img src="../imgs/ahmed_T.jpg" alt="">
                </div>
                
                <div class="member wow bounceInDown">
                    <div class="overlay">Sally</div>                    
                    <img src="../imgs/sally_E.jpg" alt="">
                </div>  
            </div>
        </div>
    </div>
    
    
    <?php include('../footer.php'); ?>

    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>  
    <script src="/Car-Tech-TeamB/js/script.js"></script>
</body>

</html>