<?php function prompt ($prompt_msg) {
    echo("<script type='text/javascript'>
        window.alert('Please Choose ".$prompt_msg." For Search');
        </script> ");

    }

    include_once ("../Config.php");

    if (isset ($_POST['search'])) {
        echo('<h3>Click On Your Selection</h3>
            <br><br>');
        if ($_POST['Service'] !="none"&& $_POST['City'] !="none") {
            $Service=$_POST['Service'];
            $City=$_POST['City'];
            $Region=$_POST['Region'];
            $Name=$_POST['search_name'];
            $sql="SELECT users.prof_img,
                    users.id,
                    users.username, 
                    services.ser_name,
                    cities.city_name,
                    regions.region_name
                    
                    FROM (((((( users
                    inner join providers on providers.user_id = users.id)
                    inner join prov_services on prov_services.p_id = providers.user_id )
                    inner join services on prov_services.ser_id = services.id )
                    inner join p_address on p_address.p_id = providers.user_id)
                    inner join regions on regions.id = p_address.region_id)
                    inner join cities on cities.id = regions.city_id )
                    
                    WHERE users.account_type ='Provider' and 
                    prov_services.ser_id ='$Service' and 
                    regions.city_id='$City' and 
                    users.username like '$Name%'";

            if ($Region != "none") {
                $sql = $sql."and p_address.region_id = '$Region'";
            }
            
            $result=mysqli_query($conn, $sql);
            while($provider=mysqli_fetch_array($result)) {

                echo ('
                        <li class="result-card row">
                            <div class="lift col-2">
                                <img src="data:image/jpg;charset=utf8mb4;base64,'.base64_encode($provider['prof_img']).'">
                            </div>'.
                            '<div class="mid col-6">
                                <h5>'.$provider['username'].'</h5>'.
                                '<span class="address-card">'.$provider['region_name'].'  '.$provider['city_name'].'</span>
                            </div>
                            <div class="right col-4">
                            <a class="btn btn-outline-dark" href="pProfile.php"'.$provider['id'].'">View</a>
                            </div>'.
                        '</li>
                    ');
            }
            
        }
    }

    ?>