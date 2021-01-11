<?php 
    include('../Config.php');
    include('forMsg_one.php');

    ob_start();
    session_start();
    $id =  $_GET['id']; 
    if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )  
    {
        if (isset($_SESSION['u_id']))
        {
            $current_id=$_SESSION['u_id'];
        }
        else
        {
            $current_id=$_SESSION['p_id'];
        }
    }
    $sql="SELECT users.*,
        providers.comm_img,
        providers.ID_img,
        p_address.street,
        cities.city_name,
        regions.region_name,
        services.ser_name
    
        FROM (((((( users
        inner join providers on providers.user_id = users.id)
        inner join prov_services on prov_services.p_id = providers.user_id )
        inner join services on prov_services.ser_id = services.id )
        inner join p_address on p_address.p_id = providers.user_id)
        inner join regions on regions.id = p_address.region_id)
        inner join cities on cities.id = regions.city_id )
        WHERE
            users.id = '$id'";

    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);
    $user_data = mysqli_fetch_array($result);
                            
    if (isset($_POST['add_fav']))
    {
        if ( $current_id != $id ){
            $conn->query("INSERT INTO favorite (user_id,favorite_id) VALUES ('$current_id','$id')");
        }
    }
    if (isset($_POST['remove_fav']))
    {
        $conn->query("DELETE FROM favorite WHERE user_id = '$current_id' AND favorite_id='$id' ");
    }                   

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
    <link rel="stylesheet" href="../css/pProfile.css" />
    <link rel="stylesheet" href="../css/chat_direct.css" />
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body>    
    <?php include('../header.php'); ?>

<?php 
if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )  {
    ?>
    <div class="wrapper">
    <div class="chat-box">
      <div class="chat-head">
        <h2 id="user_details"></h2>
        <img src="https://maxcdn.icons8.com/windows10/PNG/16/Arrows/angle_down-16.png" title="Expand Arrow" width="16">
      </div>
      <div class="chat-body" id="chat-body">
        <div  class="msg-insert" id="user_model_details">
        </div>
        <div class="chat-text">
          <textarea class="fresh" id="<?php echo $id; ?>" placeholder="Send"></textarea>
        </div>
      </div>
    </div>
  </div>
<?php
} 
?>
  
    <div class="prof-section">
        <div class="container">
            <div class="upper-prof row">
                <div class="img-prof col-3">
                    <div class='imgProf'>
                        <?php
                            $background_colors = array('#282E33', '#25373A', '#164852', '#495E67', '#FF3838');
                            $rand_background = $background_colors[array_rand($background_colors)];
                            
                            echo"<h2 style='background-color: ". $rand_background .";width: 100%;'>";
                            echo strtoupper(substr($user_data['username'], 0, 1)) ;
                            echo "</h2>";
                        ?> 
                    </div>
                    <?php
                        if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) ) 
                        {
                            $search_sql="SELECT favorite_id FROM favorite WHERE user_id = '$current_id' AND favorite_id='$id'  " ;
                            $search_result = mysqli_query($conn, $search_sql);
                            if(mysqli_num_rows($search_result) != 1)
                        {
                    ?>
                        <form method="POST" >
                            <button class="btn btn-outline-info Add" name="add_fav"> Add To Favorite  </button>
                        </form>
                        
                    <?php
                        }
                        else
                        { ?>
                        <form method="POST">
                            <button class="btn btn-outline-info Add" name="remove_fav"> Remove From Favorite  </button>
                        </form>
                        <?php
                        }
                    }
                    if(!isset($_SESSION['p_id']) && !isset($_SESSION['u_id']) )
                    {
                    ?>
                    
                    <form action='login.php' >
                        <button class="btn btn-outline-info Add" name="add_fav"> Add To Favorite  </button>
                    </form>
                    <?php
                     } 
                    ?>
                </div>
                
                
                <div class="col-9 contact-info">
                    <div class="account-name">
                        <h3>
                            <?php 
                                echo $user_data['username'];
                            ?>
                        </h3>
                    </div>
                    
                    <div class="phone">
                        <i class="fa fa-phone-square"></i>
                        <span>
                            <?php 
                                echo $user_data['phone'];
                            ?>
                        </span>
                    </div>
                    <div class="mail">
                        <i class="fa fa-envelope-square"></i>
                        <span>
                            <?php 
                                echo $user_data['email'];
                            ?>
                        </span>
                    </div>
                    <div class="adress">
                        <i class="fa fa-address-book"></i>
                        <span> <?php
                            echo " " . $user_data['street'] ;
                            echo ",";
                            echo " " . $user_data['region_name'] . " ";
                            echo ",";
                            echo " " . $user_data['city_name'] . " ";
                        ?>  
                        </span>
                        <?php
                            $sql="SELECT * FROM coordinates WHERE p_id = '$id' ";
                            $Result = mysqli_query($conn, $sql);
                            
                            if(mysqli_num_rows($Result) == 1) {
                                $Location = mysqli_fetch_array($Result);
                                $lon= $Location['longitude'];
                                $lat= $Location['latitude'];
                        ?>
                            <button class="go btn btn-outline-info">
                                <?php 
                                    echo "<a class='location' href='https://www.google.com/maps/?q=".$lat.",".$lon."'"." target='_blank'> Go |  </a>   ";
                                ?>
                                <i class="fa fa-location-arrow"></i>
                            </button>
                        <?PHP } ?>
                    </div>
                </div>
                <div class="services-prof col-12">
                    <h4>Services</h4>
                    <ul>
                        <?php
                            $sql = "SELECT * FROM prov_services WHERE p_id = '$id'";
                            $res = mysqli_query($conn, $sql);
                    
                            while($ser_id = mysqli_fetch_array($res))
                            {
                                $Sql_ser="SELECT * FROM services WHERE id = ".$ser_id['ser_id']." ";
                                $res_Ser = mysqli_query($conn, $Sql_ser);
                                while($ser_Name = mysqli_fetch_array($res_Ser))
                                { 
                                echo "<li>".$ser_Name['ser_name']."</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="v-gallery col-12">
                    <h4>Work Gallery</h4>
                    <?php
                        $sql_G= "SELECT * FROM gallery WHERE P_id='$id'";
                        $result_G = mysqli_query($conn, $sql_G); 
                        $_rows = mysqli_num_rows($result_G);
                        if($_rows >= 1) {
                        while ($user_G = mysqli_fetch_array($result_G))
                            {
                        ?>
                            <div class="card" style="width: 19%;">
                                <div class="card-img-top" >
                                    <img width="100%" src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($user_G['G_image']); ?> " />
                                </div>    
                                    <div class="card-body" >
                                    <?php 
                                        echo"<p class='card-text'>". $user_G['MSG']."</p>";
                                    ?>
                                    </div>
                            </div>
                            <?php
                            }
                        }
                    ?>  
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
    <?php 
    if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) ) {
    ?>
    <script>
        

        $(function(){
            var arrow = $('.chat-head img');
            var textarea = $('.chat-text textarea');

            arrow.on('click', function(){
                var src = arrow.attr('src');

                $('.chat-body').slideToggle('fast');
                if(src == 'https://maxcdn.icons8.com/windows10/PNG/16/Arrows/angle_down-16.png'){
                    arrow.attr('src', 'https://maxcdn.icons8.com/windows10/PNG/16/Arrows/angle_up-16.png');
                }
                else{
                    arrow.attr('src', 'https://maxcdn.icons8.com/windows10/PNG/16/Arrows/angle_down-16.png');
                }
            });
        });


        $(document).ready(function () {
        fetch_user();
        setInterval(function () {
            update_last_activity();
            update_chat_history_data();
        }, 5000);
            
        $(document).on('focus', '.fresh', function () {
            $('.chat-body').animate({ scrollTop: $('.chat-body').prop('scrollHeight') }, 1000);
        });
        // $(document).on('focus', '.fresh', function () {
        //     update_last_activity();
        //     update_chat_history_data();
        //     $('.chat-body').animate({ scrollTop: $('.chat-body').prop('scrollHeight') }, 1000);
        // });
        
        function update_last_activity() {
            $.ajax({
                url: "update_last_activity_one.php",
                success: function () {
                }
            })
        }

        function fetch_user() {
            $.ajax({
                url: "fetch_one_user.php?id=<?php echo $id; ?>",
                method: "POST",
                success: function (data) {
                    $('#user_details').html(data);
                }
            })
        }
        function make_chat_dialog_box(to_user_id, to_user_name) {
            var modal_content = '<div class="chat-history" data-touserid="' + to_user_id + '" id="chat_history_' + to_user_id + '">';
            let chat_content = fetch_one_user_chat_history(to_user_id);
            if (chat_content !== undefined){
                modal_content += chat_content;
            }
            else
                modal_content += '<i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="margin:16px;"></i> <span class="sr-only">Loading...</span>';
            modal_content += '</div>';
            
            $('#user_model_details').html(modal_content);
        }

        $(document).on('click', '.start_chat', function () {
            var to_user_id = $(this).data('touserid');
            var to_user_name = $(this).data('tousername');
            make_chat_dialog_box(to_user_id, to_user_name);
        });

        
        $('.chat-text textarea').keypress(function(event) {
            $('.chat-body').animate({ scrollTop: $('.chat-body').prop('scrollHeight') }, 1000);
            var thi =  $(this);
            var to_user_id = thi.attr('id');
            if(event.keyCode == '13') {
                event.preventDefault();
                var chat_message = thi.val().trim();
                if((chat_message != '') && (chat_message != ' ')) {
                    $.ajax({
                        url: "insert_chat_one.php",
                        method: "POST",
                        data: { to_user_id: to_user_id, chat_message: chat_message },
                        success: function (data) {
                            var chatDiv = $('#chat_history_' + to_user_id);
                        }
                    }) 
                    thi.val(' ');
                } 
            }
        });

        function fetch_one_user_chat_history(to_user_id) {
            $.ajax({
                url: "fetch_one_user_chat_history.php",
                method: "POST",
                data: { to_user_id: to_user_id },
                success: function (data) {
                    var chatDiv = $('#chat_history_' + to_user_id);
                    chatDiv.html(data);
                }
            })
        }


        function update_chat_history_data() {
            $('.chat-history').each(function () {
                var to_user_id = $(this).data('touserid');
                fetch_one_user_chat_history(to_user_id);
            });
        }

        function fetch_one_user_chat_history(to_user_id) {
            $.ajax({
                url: "fetch_one_user_chat_history.php",
                method: "POST",
                data: { to_user_id: to_user_id },
                success: function (data) {
                    $('#chat_history_' + to_user_id).html(data);
                }
            })
        }

        $(document).on('focus', '.chat_message', function () {
            var is_type = 'yes';
            $.ajax({
                url: "update_is_type_status_one.php",
                method: "POST",
                data: { is_type: is_type },
                success: function () {
                }
            })
        });

        $(document).on('blur', '.chat_message', function () {
            var is_type = 'no';
            $.ajax({
                url: "update_is_type_status_one.php",
                method: "POST",
                data: { is_type: is_type },
                success: function () {
                }
            })
        });

    });  
        
    </script>
    <?php
} 
?>
</body>
</html>