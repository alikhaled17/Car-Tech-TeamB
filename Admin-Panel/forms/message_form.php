<fieldset>
    <!-- Form Name -->
    <legend>Message Form</legend>
    <!-- Text -->
    <div class="form-group">
        <label class="col-md-4 control-label">Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-bookmark"></i></span>
                <label class="col-md-4 control-label">Car Tech</label>
            </div>
        </div>
    </div>
    <!-- Text -->
    <div class="form-group">
        <label class="col-md-4 control-label">From</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <label class="col-md-4 control-label">info.cartechb@gmail.com</label>
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">To</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="email" name="email"
                    value="<?php echo htmlspecialchars($edit ? $users['email'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="E-Mail Address" class="form-control" id="email">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Subject</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="text" name="Subject" autocomplete="off" placeholder="Subject" class="form-control"
                    value="<?php echo ($edit) ? $users[''] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label">Massege</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-text-height"></i></span>
                <textarea type="text" name="Massege" autocomplete="off" placeholder="Massege" class="form-control"
                    value="<?php echo ($edit) ? $users[''] : ''; ?>" autocomplete="off"></textarea>
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