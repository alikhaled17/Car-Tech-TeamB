


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

    <script src="../js/responde.js"></script>
</head>

<body>
    <!-- Header -->
    <?php include('../header.php'); ?>
    <!-- Services -->


    <!-- Search -->
    <div class="outer">
        <div class="container">
            <div class="row">
                <div class="right-side col-6">
                    <h3>Select Choose</h3><hr class="hr">
                    <br>
                    <div class="form-body">
                        <form class="test" action="#" method= "post">
                            <label class="label">Service</label>
                            <select name="Service" id="filter" class="search-select">';
                                <option selected>Choose</option>
                                <option value="Trailer Truck">Trailer Truck</option>
                                <option value="Gas Station">Gas Station</option>
                                <option value="Car Wash">Car Wash</option>
                                <option value="Car Maintenance">Car Maintenance</option>
                            </select>
                            <br><br>
                            <label class="label">City</label>
                            <select name="City" id="City1" class="search-select" onchange="myFunction()">
                                <option selected>Choose</option>
                                <option value="Alexandria">Alexandria</option>
                                <option value="Aswan">Aswan</option>
                                <option value="Giza">Giza</option>
                                <option value="Asyut">Asyut</option>
                                <option value="Beheira">Beheira</option>
                                <option value="Beni Suef">Beni Suef</option>
                                <option value="Cairo">Cairo</option>
                                <option value="Dakahlia">Dakahlia</option>
                                <option value="Damietta">Damietta</option>
                                <option value="Faiyum">Faiyum</option>
                                <option value="Gharbia">Gharbia</option>
                                <option value="Giza">Giza</option>
                                <option value="Ismailia">Ismailia</option>
                                <option value="Kafr El Sheikh">Kafr El Sheikh</option>
                                <option value="Luxor">Luxor</option>
                                <option value="Matruh">Matruh</option>
                                <option value="Minya">Minya</option>
                                <option value="Monufia">Monufia</option>
                                <option value="New Valley">New Valley</option>
                                <option value="North Sinai">North Sinai</option>
                                <option value="Port Said">Port Said</option>
                                <option value="Qalyubia">Qalyubia</option>
                                <option value="Qena Sea">Qena</option>
                                <option value="Red">Red Sea</option>
                                <option value="Sharqia">Sharqia</option>
                                <option value="Sohag">Sohag</option>
                                <option value="South">South Sinai</option>
                                <option value="Suez">Suez</option>
                            </select>
                            <br><br>
                            <label class="label">Region</label>
                            <select onchang="filter()" name="Region" id="Region1" name="Region1" class="search-select">
                                <option selected>Choose</option>
                            </select>
                            <hr>
                            <label class="label">Name</label>
                            <input id="name_p" type="text" placeholder="Search.." name="search_name"><br>
                            <input class="btn btn-outline-dark" type="submit" value="search">
                        </form>
                    </div>
                </div>

                <div class="left-side col-6">
                    <h3>Click On Your Selection</h3>
                    <br><br>
                    <form class="result" action="">
                        <ul>
                            
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>

        function myFunction() {
            <?php

                include("../Config.php");
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                $rows = mysqli_num_rows($result);
                
                if ($rows == 1) {
                    $user_data = mysqli_fetch_array($result);
                    ?>
                        document.querySelector(".left-side .result ul").innerHTML = " <li class='result-card row'> " +
                        "    <div class='lift col-2'>"+
                        "        <img src='http://www.myiconfinder.com/uploads/iconsets/256-256-5d8cab7b01ffef290b73909d06d92705.png'>"+
                        "    </div>"+
                        "    <div class='mid col-6'>"+
                        "        <h5>"+ <?php echo $user_data['user_id']; ?> +"</h5>"+
                        "        <span class='address-card'>Address</span>"+
                        "    </div>"+
                        "    <div class='right col-4'>"+
                        "        <a class='btn btn-outline-dark' href='#' >View</a>"+
                        "    </div>"+
                        "</li>";
                    <?php
                } else {
                    echo "wrong, not found!";
                }
            ?>
            // document.querySelector(".left-side .result ul").innerHTML = " <li class='result-card row'> " +
            //     "    <div class='lift col-2'>"+
            //     "        <img src='http://www.myiconfinder.com/uploads/iconsets/256-256-5d8cab7b01ffef290b73909d06d92705.png'>"+
            //     "    </div>"+
            //     "    <div class='mid col-6'>"+
            //     "        <h5>Account Name</h5>"+
            //     "        <span class='address-card'>Address</span>"+
            //     "    </div>"+
            //     "    <div class='right col-4'>"+
            //     "        <a class='btn btn-outline-dark' href='#' >View</a>"+
            //     "    </div>"+
            //     "</li>"
        }
        
    </script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="../js/script.js"></script>
</body>

</html>