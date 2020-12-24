<script type="text/javascript">function fetch_region(val) {
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
<select name="City"id="City1"class="search-select"onchange="fetch_region(this.value);" required> 
<?php
include_once("../Config.php");
$sql="SELECT id,city_name FROM `cities`";
$result=mysqli_query($conn, $sql);

echo '<option value="" selected >Choose...</option>';

while($mycitys=mysqli_fetch_array($result)) {

    echo '<option value="'
    .$mycitys ['id'] .'">'
    .$mycitys ['city_name'] .'</option>';
}

?>
</select>
<br><br>