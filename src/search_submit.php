<?php 
    include_once ("../Config.php");
    include_once ("pagination.php");
    $limit = 2;  
    if (isset($_GET["page"])) {
        $page  = $_GET["page"]; 
        } 
        else{ 
        $page=1;
        };  
    $start_from = ($page-1) * $limit; 

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
            $sql="SELECT  users.prof_img,
                    users.id,
                    users.username, 
                    services.ser_name,
                    cities.city_name,
                    regions.region_name,
                    COUNT(users.id)
                    
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
                    users.username like '$Name%' LIMIT $start_from, $limit";

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
                                <div class="lift col-2" style="text-align:center; padding: 5px; color: #f47e3d;">' );
                    echo ('<h2>'.strtoupper(substr($provider['username'], 0, 1)).'</h2>');
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
    // $nema_table_count= 'providers';
    // $select_types = "'accept'";
    // $select_types_count="'accept'";
    // $coul = 'username';
    // $types = 'prov_state';
    // // Per page limit for pagination.
    // $pagelimit = 2;
    // // Get current page.
    // $page = filter_input(INPUT_GET, 'page');
    // if (!$page) {
    //     $page = 1;
    // }

    // $offset = ($page - 1) * $pagelimit ;
    // $sql.=" LIMIT $pagelimit OFFSET $offset";
    // $rows=mysqli_query($conn, $sql);
    // $total_count = 0 ;
    // if ($nema_table_count == 'users' || $nema_table_count == 'providers'){
    //     $total_count = counting_type($nema_table_count, $types, $select_types_count);
    // }else {
    //     $total_count = counting($nema_table);
    // }
    // $total_pages = ceil( $total_count / $pagelimit);
    // //}
  
    // echo paginationLinks($page, $total_pages, 'search_submit.php'); 
    $row_db = mysqli_fetch_row($result);  
    $total_records = $row_db[0];  
    $total_pages = ceil($total_records / $limit); 
    $pagLink = "<ul class='pagination'>";  
    for ($i=1; $i<=$total_pages; $i++) {
                $pagLink .= "<li class='page-item'><a class='page-link' href='pagination.php?page=".$i."'>".$i."</a></li>";	
    }
    echo $pagLink . "</ul>";  

?>