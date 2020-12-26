
    <!-- Start Upper Bar -->
    <div class="upper-bar">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <i class="fa fa-phone"></i><span> +20 111 2332 199</span>,
                    <i class="fa fa-envelope-o"></i> CarTech@gmail.com
                </div>
                <div class="col-sm text-right">
                    <span>Let's Work Together! </span>
                    <span class="get-quote">Get Qoute</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Upper Bar -->
    <!-- Start Nav Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" data-wow-duration='.5s' href="#">
                <img class="wow wobble" src="/Car-Tech-TeamB/imgs/logo1.png" alt="car-tech" width="100px">
                <span>Car</span><span>Tech</span>
            </a>

            <div class="collapse navbar-collapse" id="ournavbar">
                <ul class="navbar-nav navar ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/pProfile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Car-Tech-TeamB/src/contact.php">Contact US</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Settings
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
    
   