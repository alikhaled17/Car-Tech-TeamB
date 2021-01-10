<?php 
    include_once ("../Config.php");

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
    if (isset ($_POST['search'])) {
        
        if ($_POST['Service'] !="" && $_POST['City'] !="") {
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
                    
                    WHERE
                    users.account_type ='Provider' and 
                    prov_services.ser_id ='$Service' and 
                    regions.city_id='$City' and 
                    users.username like '$Name%'";

            if ($Region != "none") {
                $sql = $sql."and p_address.region_id = '$Region'";
            }
            
            if(isset($_SESSION['p_id']))  {
                $x = $_SESSION['p_id'];
                $sql = $sql."and users.id != '$x'";
            }
            
            $info=mysqli_query($conn, $sql);
            if($x=mysqli_fetch_array($info)) {
               
                echo("<h3>Result</h3> <span>". $x['ser_name']. ", ".$x['city_name']
                ."</span><br><br>"); 
            }

            $result=mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) >= 1) {
                while($provider=mysqli_fetch_array($result)) {

                    echo ('
                            <li class="result-card row wow bounceInDown">
                                <div class="lift col-2"> ');
                        echo ("<div style='text-align: center;'><h2 style='color:#f47e3d;font-size:30px;'>".strtoupper(substr($provider['username'], 0, 1))."</h2></div>";     
                    echo   ('</div>'.
                            '<div class="mid col-7">
                                <h5>'.$provider['username'].'</h5>'.
                                '<span class="address-card">'.$provider['region_name'].'  '.$provider['city_name'].'</span>
                            </div>
                            <div class="right col-3">
                            <a class="btn btn-outline-dark" target="_blank" href="visitProvider.php?id='.$provider['id'].' ">View</a>
                            </div>'.
                        '</li>
                    ');
                }
            } else {
                echo "<div class='wow flip no-result'>";
                echo "<img src='../imgs/search.png'>";
                echo "<h5>Sorry, We haven't found any results matching this search</h5>";
                echo "</div>";

            }
            
            
        } 
        else  {
            echo "<div class='wow rotateIn no-result'>";
            echo "<img src='../imgs/search.png'>";
            echo "<h5>Sorry, please select city</h5>";
            echo "</div>";
        }
    } else {
        echo "<div class='wow slideInRight no-result'>";
        echo "<img src='../imgs/search.png'>";
        echo "<h5>Search Result </h5>";
        echo "<h5>----------------------------------</h5>";
        echo "</div>";
    }

?>