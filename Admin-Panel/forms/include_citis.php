<script type="text/javascript">
    
    function fetch_region(val) {
        console.log({region, city})
        var region= document.getElementById('Region1').value;
        var city= document.getElementById('City1').value;
        var button = document.getElementById("check");
        isDisabled({ region, city, button });

        $.ajax( {

                type: 'post',
                url: 'fetch_regions.php',
                data: {
                    get_option:val
                }
                ,
                success: function (response) {
                    document.getElementById("Region1").innerHTML=response;
                }
            }
        );
    }
</script>

<?php
include_once("./config/config.php");
$sql="SELECT id,city_name FROM `cities`";
$result=mysqli_query($conn, $sql);

echo '<option value="Choose" >City Name</option>';

while($mycitys=mysqli_fetch_array($result)) {
    $selected_attribute = $selected_city_id == $mycitys ['id'] ? "selected" : "";
    echo '<option value="'
    .$mycitys ['id'].'"'.$selected_attribute.'>'
    .$mycitys ['city_name'] .'</option>';
}

?>
