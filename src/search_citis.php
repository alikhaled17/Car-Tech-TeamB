<script type="text/javascript">
    function isDisabled({region, city, button}) { 
        console.log({region, city});
        if (region == "Choose ..." || city == "Choose ...") button.disabled = true;
        else {
            button.disabled = false;
        }
    }
    
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
<select name="City" id="City1" class="search-select" onchange="fetch_region(this.value);" > 
<?php
include_once("../Config.php");
$sql="SELECT id,city_name FROM `cities`";
$result=mysqli_query($conn, $sql);

echo '<option value="Choose" selected >Choose ...</option>';

while($mycitys=mysqli_fetch_array($result)) {

    echo '<option value="'
    .$mycitys ['id'] .'">'
    .$mycitys ['city_name'] .'</option>';
}

?>
</select>
<br><br>
