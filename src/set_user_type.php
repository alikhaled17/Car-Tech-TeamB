<?php 

echo 
'<h4>services *</h4>
<div class="service-check">';
include_once('include_service.php');
echo '</div>
    <div style="visibility:hidden; color:red; " id="chk_option_error">
        Please select at least one option.
    </div>
    
    <label>National ID *</label>
    <input type="file" required name="nation_id" value="none" accept="image/*">
    <label>commercial ID *</label>
    <input type="file" required name="commerc_id" value="none" accept="image/*"><br><br>
    <label>City *</label>';
include('include_citis.php');
echo '<label>Region *</label>
    <select id="Region1" name="Region" class="search-select" required>
        <option value="" selected>Choose ...</option>
    </select><br><br>
    <label for="">Street *</label>
    <input type="text" name="street" placeholder="street">';

?>