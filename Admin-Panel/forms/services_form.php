<fieldset>
    <!-- Form Name -->
    <legend>Services Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Services Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-car fa-fw"></i></span>
                <input type="text" name="ser_name" autocomplete="off" placeholder="Services Name" class="form-control"
                required="required" value="<?php echo ($edit) ? $services['ser_name'] : ''; ?>" autocomplete="off">
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