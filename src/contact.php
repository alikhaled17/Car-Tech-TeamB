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
    <link rel="stylesheet" href="../css/contact.css" />

    <script src="../js/responde.js"></script>   
    <script type="text/javascript">

    function addActionTest(theForm) {
    if (theForm.subjectTitle.value != '') {
        theForm.action += theForm.subjectTitle.value;
        return true;
    }
    else { alert('Error'); return false;}
    }
    </script>  
</head>
<body>
    
    <?php include('../header.php'); ?>

    <!-- Contact -->
    <div class="Outer">
        <div class="container">
            <div class="row">
            		<div class="ContactForm col-6">
            			<form action="mailto:info.cartechb@gmail.com?subject=" method="POST" onsubmit="return addActionTest(this);"
                        enctype="Contact/plain" >
                    <h5>You can contact me using the following form<img src="../imgs/contactUs_Tittle.png" width="50px"></h5>
                        <p>Name</p>
                        <p>
                            <input type="text" name="name" class="Inputs_Text" required
                            placeholder="Enter Your Name *" size="40">
                        </p> 
                        <p>Email</p> 
                        <p>
                            <input type="email" name="email" class="Inputs_Text" required
                            placeholder="Enter Your Email *" size="40">
                        </p>
                        <p>Mobile phone</p> 
                        <p>
                            <input type="text" name="number" class="Inputs_Text" required
                            placeholder="Enter Your Number *" size="40">
                        </p>
                        <p>Subject</p> 
                        <p>
                            <input type="text" name="subjectTitle" class="Inputs_Text" required placeholder="Enter Your subject title *"
                             size="40" value="">
                        </p>
                        <p>Massege</p> 
                        <p>
                            <textarea name="message" cols="40" rows="10" placeholder="Your Message" required></textarea>
                        </p>
                        <table width="70%">
                            <tr>
                                 <td>
                                    <input type="submit" value="Send" name="send" class="btn btn-outline-dark" ></td>
                                <td align="left">
                                    <input type="reset" value="Reset" class="btn btn-outline-dark">
                                </td>
                            </tr>
                        </table>
                </form>
        	</div>
                <div class="img_contact col-6">
            <h1 class="contact_UnderLine">Contact Us</h1>
            <img class="img_Form" src="../imgs/ContactUsForm.png">
            </div>
        </div>	
        </div>
    </div>
    
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>    
    <script src="../js/script.js"></script>
</body>
</html>