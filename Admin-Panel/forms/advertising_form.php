<fieldset>
    <!-- Form Name -->
    <legend>Advertising Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Advertising Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-bullhorn fa-fw"></i></span>
                <input type="text" name="name_adver" autocomplete="off" placeholder="Advertising Name" class="form-control"
                    value="<?php echo ($edit) ? $services['name_adver'] : ''; ?>" required="" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Advertising Content</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-paragraph fa-fw"></i></span>
                <input type="text" name="ad_content" autocomplete="off" placeholder="Advertising Name" class="form-control"
                    value="<?php echo ($edit) ? $services['ad_content'] : ''; ?>" required="" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Advertising Img</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="img_adver" autocomplete="off" placeholder="Advertising Name" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $services['img_adver'] : ''; ?>" required="" autocomplete="off">
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