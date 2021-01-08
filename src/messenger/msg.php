<?php
include('forMsg.php');
include('../../Config.php'); 
session_start();
if(isset($_SESSION['p_id']) )    
{
      $id = $_SESSION['p_id'];
}
else
{
      $id = $_SESSION['u_id'];
}
?>
<html>  
      <head>  
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Car Tech - Chat</title>
            <link rel="stylesheet" href="../../css/bootstrap.css">
            <link rel="stylesheet" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="../../css/animate.css">
            <link rel="stylesheet" href="../../css/style.css" />
            <link rel="stylesheet" href="../../css/test.css" />
    </head>  
    <body>  
            <?php include('../../header.php'); ?>
            <?php echo $id; ?>
            <div class="chats row">
                  <div class="container">
                        <div class="people-list col-4"  id="user_details" ></div>
                        <div class="chat col-8 row" id="user_model_details"></div>
                  </div>
            </div>
            <div style="clear:both;"></div>
            <?php include('../../footer.php'); ?>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
            <script src="../../js/jquery-3.5.1.min.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/wow.min.js"></script>
            <script>
                  new WOW().init();
       
                  function hamada() {
                        $('.chat-history').animate({ scrollTop: $('.chat-history').prop('scrollHeight') }, 1000);
                  }
            </script>

            <script src="../../js/ajax_chat.js">  
            </script>
      </body>  
</html>  
