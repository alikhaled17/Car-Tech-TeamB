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
    <title>Car Tech - Profile</title>
    <!-- my css files -->    
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/pProfile.css" />

    <script src="../js/responde.js"></script>
</head>
<body>
    
    <?php include('../header.php'); ?>

    <div class="prof-section">
        <div class="container">
            <div class="upper-prof row">
                <div class="img-prof col-3">

                    <?php 
                        $p_id = $_SESSION['p_id'];
                        $sql = "SELECT * FROM providers WHERE user_id = '$p_id'";
                        $result = $conn->query($sql);
                        $rows = $result->fetch_assoc();
                        $dbsql = "SELECT * FROM users WHERE id = '$p_id'";
                        $dbresult = $conn->query($dbsql);
                        $dbrow = $dbresult->fetch_assoc();
                    ?> 
                    <img src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($rows['ID_img']); ?>" /> 

                </div>
                <div class="info-prof col-9">
                    <div class="account-name">
                        <h3><?php 
                                echo $_SESSION['username'];
                            ?>
                        </h3>
                    </div>
                    <hr>
                    <div class="card-body text-center"> 
                        <fieldset class="rating"> 
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label class="full" for="star5" title="Awesome - 5 stars"></label>
                            <input type="radio" id="star4half" name="rating" value="4.5" />
                            <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> 
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label class="full" for="star4" title="Pretty good - 4 stars"></label> 
                            <input type="radio" id="star3half" name="rating" value="3.5" />
                            <label class="half" for="star3half" title="Meh - 3.5 stars"></label> 
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label class="full" for="star3" title="Meh - 3 stars"></label>
                            <input type="radio" id="star2half" name="rating" value="2.5" />
                            <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label> 
                            <input type="radio" id="star1half" name="rating" value="1.5" />
                            <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label class="full" for="star1" title="Sucks big time - 1 star"></label> 
                            <input type="radio" id="starhalf" name="rating" value="0.5" />
                            <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                        </fieldset>
                        <span class="myratings">4.5</span>
                    </div>
                </div>
                <div class="col-3"></div>
                <div class="col-9 contact-info">
                    <div class="gender">
                        <i class="fa fa-venus-mars"></i>
                        <span>
                            <?php 
                                echo $dbrow['gender'];
                            ?>
                        </span>
                    </div>
                    <div class="phone">
                        <i class="fa fa-phone-square"></i>
                        <span>
                            <?php 
                                echo $dbrow['phone'];
                            ?>
                        </span>
                    </div>
                    <div class="mail">
                        <i class="fa fa-envelope-square"></i>
                        <span>
                            <?php 
                                echo $dbrow['email'];
                            ?>
                        </span>
                    </div>
                    <div class="adress">
                        <i class="fa fa-address-book"></i>
                        <span>Salam st, Aswan 18511 </span>
                        <button>
                            Go | 
                            <i class="fa fa-location-arrow"></i>
                        </button>
                    </div>
                </div>
                <div class="services-prof col-12">
                    <h4>Services</h4>
                    <ul>
                        <li>Station</li>
                        <li>Maintainance</li>
                        <li>Wash</li>
                    </ul>
                </div>
                <div class="work-gallery col-12">
                    <h4>Work Gallery</h4>
                    
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