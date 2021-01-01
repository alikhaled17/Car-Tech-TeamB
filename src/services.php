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
    <title>Car Tech - Contact</title>
    <!-- my css files -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="../css/services.css" />
</head>

<body>
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
                            <?php include('search_service.php'); ?>

                             <!-- City -->
                            <label class="label">City</label>
                            <?php include('search_citis.php'); ?>

                            <!-- Region -->
                            <label class="label">Region</label>
                            <!-- onchange="change()"  -->
                            <select id="Region1" name="Region" class="search-select" onchange="change()" >
                                <option value="Choose" >Choose ...</option>
                            </select>
                            <hr>

                            <!-- Name -->
                            <label class="label">Name</label>
                            <input id="name_p" type="text" placeholder="Search.." name="search_name"> <br>

                            <!-- search_submit -->
                            <input id="check" class="btn btn-outline-dark" disabled="disabled" 
                                type="submit" value="Search" name="search" onclick="location.reload();">
                        </form>
                        <!-- //mosh bedo5l el if condition asln becaus rhe form didin't post because disabel att. -->   
                    </div>
                </div>

                <!-- result -->
                <div class="left-side col-6">
                    <div class="result">
                        <ul id="result">
                            <?php include('search_submit.php'); ?>
                        </ul>
                    </div>
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
    <script>
    var City = localStorage.getItem('City');
    var Region = localStorage.getItem('Region');
    var Service = localStorage.getItem('Service');
    var name = localStorage.getItem('Name');
    function changeCity(){
    document.getElementById("City1").selectedIndex = City;
    }    
    function changeService(){
        document.getElementById("filter").selectedIndex = Service;
    }

    function changeRigion(){
        var opt= document.getElementById('Region1').options[0];
        opt.value = localStorage.getItem('Region');
        opt.text = localStorage.getItem('Region');
        console.log (opt.value);
        console.log (opt.text);
        if ( opt.text == 'null'|| opt.text=='null')
        {
            opt.value = 'Choose ...';
            opt.text = 'Choose ...';
        }
    }
</script>
<script>
    function isDisabled({region, city, button}) {
        console.log({region, city});
        if (region == "Choose ..." || city == "Choose ...") button.disabled = true;
        else {
            button.disabled = false;
        }
    }

    function change()
    {
        let region= document.getElementById('Region1').value;
        let city= document.getElementById('City1').value;
        let button = document.getElementById("check");
        return isDisabled({ region, city, button });
    }

    changeService();
    changeCity();
    changeRigion();   
    localStorage.clear();
    
</script>

</body>
</html>