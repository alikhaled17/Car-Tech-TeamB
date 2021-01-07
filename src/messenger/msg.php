<?php
include('forMsg.php');
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
            <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
            <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
            <link rel="stylesheet" href="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.css">
            <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script src="https://cdn.rawgit.com/mervick/emojionearea/master/dist/emojionearea.min.js"></script>
            <link rel="stylesheet" href="../../css/bootstrap.css">
            <link rel="stylesheet" href="../../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="../../css/animate.css">
            <link rel="stylesheet" href="../../css/style.css" />
            <link rel="stylesheet" href="../../css/test.css" />
            
    </head>  
    <body>  
            <?php include('../../header.php'); ?>
            
            <div class="chats row">
                  <div class="container">
                        <div class="people-list col-4"  id="user_details" ></div>
                        <div class="chat col-8 row" id="user_model_details"></div>
                  </div>
            </div>
            <div style="clear:both;"></div>
            
            <script src="../../js/jquery-3.5.1.min.js"></script>
            <script src="../../js/bootstrap.min.js"></script>
            <script src="../../js/wow.min.js"></script>
            <script>
                  new WOW().init();
            </script>
            <script src="../../js/ajax_chat.js">  
            </script>
      </body>  
</html>  
