<?php
ob_start();
session_start();
$page=0;
$total_pages=0;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Services</title>
    <!-- my css files -->
    <link rel="icon" href="../imgs/icon.png" type="image/icon type">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/services.css" />
</head>

<body>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>  
    <script src="../js/script.js"></script>
    <!-- Header -->
    <?php include('../header.php'); ?>
    <!-- Services -->


    <!-- Search -->
    <div class="outer ">
        <div class="container">
            <div class="row ">
                <div class="right-side col-6">
                    <h3>Select Choose</h3><hr class="hr">
                    <br>
                    <div class="form-body">
                        <form class="test" action="services.php" method= "post">
                            <!-- Service -->
                            <label class="label">Service</label>
                            <?php 
                            $selected_service_id = !empty($_POST) ? $_POST['Service'] : (!empty($_GET) ? $_GET['Service'] :'');
                            include('search_service.php'); ?>

                             <!-- City -->
                            <label class="label">City</label>
                            <?php 
                            $selected_city_id = !empty($_POST) ? $_POST['City'] : (!empty($_GET) ? $_GET['City'] : null);
                            $selected_region_id = !empty($_POST) ? $_POST['Region'] : (!empty($_GET) ? $_GET['Region'] : null);

                            
                            include('search_citis.php'); ?>

                            <!-- Region -->
                            <label class="label">Region</label>
                            <select id="Region1" name="Region" class="search-select">
                                <?php 
                                
                                if (!empty($_POST) || !empty($_GET)){
                                    include('fetch_regions.php');
                                }else {
                                    echo '<option value="" >Region Name</option>';
                                }
                                
                                ?>
                            </select>
                            <hr>

                            <!-- Name -->
                            <label class="label">Name</label>
                            <?php  
                                $search_name = !empty($_POST) ? $_POST['search_name'] : (!empty($_GET) ? $_GET['search_name'] :'');
                            ?>

                            <input id="name_p" type="text" placeholder="Search.." name="search_name" value="<?php echo $search_name ?>"> <br>

                            <!-- search_submit -->
                            <input class="btn btn-outline-dark" type="submit" value="Search" name="search" >
                        </form>
                    </div>
                </div>

                <!-- result -->
                <div class="left-side col-6">
                    <div class="result">
                        <ul id="result">
                            <?php 
                            include('search_submit.php'); ?>
                        </ul>
                    </div>
                    <div class="text-center">
                        <?php 
                        require_once('pagination.php');
                        echo paginationLinks($page, $total_pages, $temp); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('../footer.php'); ?>

    
    
    
</body>
</html>