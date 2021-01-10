<fieldset>
    <!-- Form Name -->
    <legend>Region Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Region Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input type="text" name="region_name" autocomplete="off" placeholder="Region Name" class="form-control"
                required="required" value="<?php echo ($edit) ? $region['region_name'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- drop down list -->
    <div class="form-group">
        <label class="col-md-4 control-label">City Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <?php 
                $selected_city_id =($edit) ? $region['city_id'] : '' ;
                include_once('include_citis.php'); ?>
                
                
            </div>
        </div>
    </div>

    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
            <button type="submit" class="btn btn-warning">Save <span class="glyphicon glyphicon-send"></span></button>
        </div>
    </div>
</fieldset>