<script type="text/javascript">function fetch_region(val) {
$.ajax( {

        type: 'post',
        url: 'forms/fetch_regions.php',
        data: {
            get_option:val
        }
        ,
        success: function (response) {
            console.log(response)
            document.getElementById("Region1").innerHTML=response;
        }
    }
);
}
</script>

<select id="City1" name="city_name" class="form-control" onchange="fetch_region(this.value)" required="required" value="<?php echo ($edit)? $selected_city_id : ''; ?>">

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
</select>

