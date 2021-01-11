<script type="text/javascript">

function handleData()
{
    var form_data = new FormData(document.querySelector("form"));
    
    if(!form_data.has("ser_name[]"))
    {
        document.getElementById("chk_option_error").style.visibility = "visible";
      return false;
    }
    else
    {
        document.getElementById("chk_option_error").style.visibility = "hidden";
      return true;
    }
    
}
</script>

<?php include_once("../Config.php");
$sql="SELECT id,ser_name FROM `services`";
$result=mysqli_query($conn, $sql);

echo '<select name="Service" id="filter" required class="search-select">';
echo '<option value="" selected >Choose...</option>';

while($myservice=mysqli_fetch_array($result)) {

    echo '<option value="'
    .$myservice ['id'] .'">'
    .$myservice ['ser_name'] .'</option>';
}

echo '</select>';
?>
<br><br>