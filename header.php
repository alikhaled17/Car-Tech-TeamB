<?php 
include('Config.php');
function count_unseen_message_h($connect)
{
    if(isset($_SESSION['p_id']) )    
    {
        $p_id = $_SESSION['p_id'];
        $query = "
        SELECT * FROM chat_message 
        WHERE 
        to_user_id = '$p_id' 
        AND status = '1'
        ";
        $result = mysqli_query($connect, $query);
        $rows = mysqli_num_rows($result);
        $count = mysqli_num_rows($result);
        $output = '';
        if($count > 0)
        {
        $output = '<span class="label label-success">'.$count.'</span>';
        }
        echo $output;   
    }
    else
    {
        $u_id = $_SESSION['u_id'];
        $query = "
        SELECT * FROM chat_message 
        WHERE  
        to_user_id = '$u_id' 
        AND status = '1'
        ";
        $result = mysqli_query($connect, $query);
        $rows = mysqli_num_rows($result);
        $count = mysqli_num_rows($result);
        $output = '';
        if($count > 0)
        {
        $output = '<span class="label label-success">'.$count.'</span>';
        }
        echo $output;
    }    
}


?>  
<script>
        /*Task One */
        function getOne()
        {
            var tipsArray=[];
            tipsArray[0]="You can totally do this";
            tipsArray[1]="If it matters to you, you’ll find a way." ;
            tipsArray[2]="Dream without fear. Love without limits.";
            tipsArray[3]="When nothing goes right, go left";
            tipsArray[4]="Impossible is for the unwilling. John Keats";
            tipsArray[5]="At the end of hardship comes happiness.";
            tipsArray[6]="Take the risk or lose the chance";
            tipsArray[7]="He who is brave is free. Seneca ";
            tipsArray[8]="Prove them wrong";
            tipsArray[9]="No guts, no story. Chris Brady";
            tipsArray[10]="My life is my message";
            tipsArray[11]="Boldness be my friend. William Shakespeare";
            tipsArray[13]="Keep going. Be all in. Bryan Hutchinson";
            tipsArray[14]="My life is my argument. Albert Schweitzer";
            tipsArray[15]="Dream big. Pray bigger.";
            tipsArray[16]="Leave no stone unturned. Euripides";
            tipsArray[17]="Fight till the last gasp. William Shakespeare";
            tipsArray[18]="If you want it, work for it.";
            tipsArray[19]="And so the adventure begins.";
            tipsArray[20]="Do it with passion or not at all";
            tipsArray[21]="Grow through what you go through.";
            tipsArray[22]="Do it with passion or not at all.";
            tipsArray[23]="You matter";
            function shuffle(array) {
                array.sort(() => Math.random() - 0.5);
            }
            shuffle(tipsArray);
            document.getElementById("test").innerHTML = tipsArray[1];
        }
</script>
    <!-- Start Upper Bar -->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <i class="fa fa-phone"></i><span> +20 000 0000 000</span>,
                    <i class="fa fa-envelope-o"></i> CarTech@gmail.com
                </div>
                <div class="col-sm text-right">
                    <span id="test">
                    </span>
                    <div class="get-quote" onclick="getOne();">Get Qoute</div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Upper Bar -->
    <!-- Start Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" data-wow-duration='.5s' href="#">
                <img class="wow wobble" src="/Car-Tech-TeamB/imgs/logo2.png" alt="car-tech" width="100px">
                <span>Car</span><span>Tech</span>
            </a>

            <div class="collapse navbar-collapse" id="ournavbar">
                <ul class="navbar-nav navar ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/AboutUs.php">About US</a>
                    </li>
                    <li class="nav-item">
                    <?php if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )
                             {if(isset($_SESSION['p_id']) )    
                             {
                                 echo "<a class='nav-link' href='/Car-Tech-TeamB/src/pProfile.php'> Profile </a>"; 
                             }
                             else
                             {
                                 echo "<a class='nav-link' href='/Car-Tech-TeamB/src/uProfile.php'> Profile </a>"; 
                                 
                             }}
                    ?>
                        <!-- <a class="nav-link" href="src/pProfile.php">Profile</a> -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./src/services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/contact.php">Contact US</a>
                    </li>
                    <li class="nav-item">
                    <?php
                            if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )      // if there is no valid session
                            {
                             echo "<a class='nav-link fa fa-comment' aria-hidden='true' style='margin-top: 3px;'
                              href='/Car-Tech-TeamB/src/messenger/msg.php'> </a>" ;
                              count_unseen_message_h( $conn);
                            }      
                    ?>                    
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fa fa-user-circle " style="margin-top: 5px;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!-- Settings -->
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                            if(isset($_SESSION['p_id']) || isset($_SESSION['u_id']) )      // if there is no valid session
                            {
                                if (isset($_SESSION['p_id']))
                                   { echo "<a class='dropdown-item' href='/Car-Tech-TeamB/src/logoutP.php'> Logout</a>" ;}
                                else
                                    { echo "<a class='dropdown-item' href='/Car-Tech-TeamB/src/logoutU.php'> Logout</a>"; }
                            }
                            else
                            {
                                echo "<a class='dropdown-item' href='/Car-Tech-TeamB/src/login.php'> Login</a>" ;
                                echo "<a class='dropdown-item' href='/Car-Tech-TeamB/src/signup.php'> Sign Up</a>" ;
                                
                            }
                        ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
