<fieldset>
    <!-- Form Name -->
    <legend>Cities Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Cities Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <input type="text" name="city_name" autocomplete="off" placeholder="Cities Name" class="form-control"
                required="required" value="<?php echo ($edit) ? $cities['city_name'] : ''; ?>" autocomplete="off">
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