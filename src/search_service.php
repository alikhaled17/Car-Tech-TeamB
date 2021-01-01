<?php include_once("../Config.php");
$sql="SELECT id,ser_name FROM `services`";
$result=mysqli_query($conn, $sql);
?>
<select name="Service" id="filter" required class="search-select">
<option value="" selected >Choose ...</option>
<?php
while($myservice=mysqli_fetch_array($result)) {

    echo '<option value="'
    .$myservice ['id'] .'">'
    .$myservice ['ser_name'] .'</option>';
}

echo '</select>';
echo "<script> var City </script>";
?>
<br><br>
<script>
console.log(City);
</script>
