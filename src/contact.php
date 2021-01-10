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
    <title>Car Tech - Contact Us</title>
    <!-- my css files -->    
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">

    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/contact.css" />

    <script type="text/javascript">

    function addActionTest(theForm) {
        if (theForm.subjectTitle.value != '') {
            theForm.action += theForm.subjectTitle.value;
            return true;
        }
        else { alert('Error'); 
            return false;
        }
    }
    </script>  
</head>
<body>
    
    <?php include('../header.php'); ?>

    <!-- Contact -->
    <div class="Outer">
        <div class="container">
        <?php include('contact_insert.php'); ?>
        <?php include('contact_config.php'); ?>
        
            <div class="row">
                <div class="ContactForm col-6">
                    <form class="Mail"  method="POST"
                            enctype="Contact/plain" name="myemailform" >
                            <h3>Contact Us<img src="../imgs/contactUs_Tittle.png" width="50px"></h3>
                            <span>Name</span>
                                <input type="text" name="nameUser" class="Inputs_Text" required placeholder="Enter Your Name *" size="50">
                            <span>Email</span> 
                                <input type="email" name="Emailsend" class="Inputs_Text" required placeholder="Enter Your Email *" size="50">
                            <span>Subject</span> 
                                <input type="text" name="subjectTitle" class="Inputs_Text" required placeholder="Enter Your subject title *" size="50" value="">
                            <span>Massege</span> 
                                <textarea name="message" cols="60" rows="5" placeholder="Your Message" required></textarea>
                                <input type="submit" value="Send" name="send" class="btn btn-outline-dark" ></td>
                                <input type="reset" value="Reset" class="btn btn-outline-dark">
                                
                    </form>
                </div>
                <div class="img_contact col-6 wow bounceInRight">
                    <img class="img_Form" src="../imgs/ContactUsForm.png">
                </div>
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