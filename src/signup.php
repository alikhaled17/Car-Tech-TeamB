<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Tech - Contact</title>
    <!-- my css files -->
    <link rel="stylesheet" href="../css/bootstrap.css" />
    <link rel="stylesheet" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/animate.css"/>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/signup.css"/>

    <script src="../js/responde.js"></script>
	<script src= 
		"https://code.jquery.com/jquery-1.12.4.min.js"> 
    </script> 
</head>
<body>
    
    <?php include('../header.php'); ?>
    
    <div class="signup row">
        <div class="container">
            <div class="left-side col-6">
                <!-- form -->
                <h2>Registration</h2><hr>
                <input type="radio" id="user" name="user-info" />
                <label for="user">Sign Up as User</label>
                <input type="radio" id="Provider" name="user-info" />
                <label for="Provider">Sign Up as Provider Of service</label>

                <br>
                <form method="POST">
                    <div class="global-info">
                        <label>User Name</label>
                        <input type="text" name="UserName" required placeholder="Enter Your User Name *"><br>
                        <label>Password</label>
                        <input type="Password" name="PWD" required placeholder="Enter Your Password *"><br>
                        <label>Email</label>
                        <input type="Email" name="Email" required placeholder="Enter Your E-mail *"><br>
                        <label>Phone Number</label>
                        <input type="text" name="PhoneNum" required placeholder="Enter Your Phone Number"><br>
                    </div>
                    <div class="prov-info" id="provider-info" style="display: none">
                        <h4>services</h4>
                        <div class="service-check">
                            <input type="checkbox" name="Gas_Station">
                            <label>Gas Station</label><br>
                            <input type="checkbox" name="Car_Wash">                            
                            <label>Car Wash</label><br>
                            <input type="checkbox" name="Car_Maintenance">
                            <label>Car Maintenance</label><br>
                            <input type="checkbox" name="Trailer_Truck">
                            <label>Trailer Truck</label><br>
                        </div>
                        <label>National ID</label>
                        <input type="file" name="National_ID">
                        <label>commercial ID</label>
                        <input type="file" name="commercial_ID"><br>
                        <label>City </label>
                        <select id="first-choice">
                            <option selected value="base_City">Select the city</option>
                            <option  value="Alexandria">Alexandria</option>
                            <option  value="Aswan">Aswan</option>
                            <option  value="Giza">Giza</option>
                            <option  value="Asyut">Asyut</option>
                            <option  value="Beheira">Beheira</option>
                            <option  value="Beni Suef">Beni Suef</option>
                            <option  value="Cairo">Cairo</option>
                            <option  value="Dakahlia">Dakahlia</option>
                            <option  value="Damietta">Damietta</option>
                            <option  value="Faiyum">Faiyum</option>
                            <option  value="Gharbia">Gharbia</option>
                            <option  value="Giza">Giza</option>
                            <option  value="Ismailia">Ismailia</option>
                            <option  value="Kafr El Sheikh">Kafr El Sheikh</option>
                            <option  value="Luxor">Luxor</option>
                            <option  value="Matruh">Matruh</option>
                            <option  value="Minya">Minya</option>
                            <option  value="Monufia">Monufia</option>
                            <option value="New Valley">New Valley</option>
                            <option  value="North Sinai">North Sinai</option>
                            <option value="Port Said">Port Said</option>
                            <option value="Qalyubia">Qalyubia</option>
                            <option value="Qena Sea">Qena</option>
                            <option value="Red">Red Sea</option>
                            <option value="Sharqia">Sharqia</option>
                            <option value="Sohag">Sohag</option>
                            <option value="South">South Sinai</option>
                            <option value="Suez">Suez</option>
                        </select><br>
                        <label>Region</label>
						<input type="text" name="Region" required placeholder="Enter Your region">
                    </div>
                </form>
            </div>
            <div class="right-side col-5">
                <div class="sign-img">
                    <div class="shape"></div>
                    <img src="/Car-Tech-TeamB/imgs/signup.png" width="100%">
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript">
    	$(function () {
			//on click of an input whose name is chkQstn
            $("input[name='user-info']").click(function () {
                //it will check if the checked input has id chkYes
                if ($("#Provider").is(":checked")) {
                //then the hidden div will be shown
                    $("#provider-info").show();
                } else {
                    $("#provider-info").hide();
                }
            });
 		});
    </script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/wow.min.js"></script>
    <script>new WOW().init();</script>
    <script src="../js/script.js"></script>
</body>
</html>