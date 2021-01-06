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
                    value="<?php echo ($edit) ? $advertising['name_adver'] : ''; ?>" required="" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Advertising Content</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-paragraph fa-fw"></i></span>
                <textarea type="text" name="ad_content" autocomplete="off" placeholder="Advertising Content" class="form-control"
                required="" autocomplete="off"><?php echo ($edit) ? $advertising['ad_content'] : ''; ?></textarea>
            </div>
        </div>
    </div>
    <?php if($operation != ''){ ?>
    <!-- File input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Advertising Img</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="img_adver" autocomplete="off" placeholder="Advertising Img" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $advertising[''] : ''; ?>"  autocomplete="off">
            </div>
        </div>
    </div>
    <?php } else { ?>
    <!-- File input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Advertising Img</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="img_adver" autocomplete="off" placeholder="Advertising Img" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $advertising[''] : ''; ?>" required="" autocomplete="off">
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
            <button type="submit" class="btn btn-warning">Save <span class="glyphicon glyphicon-send"></span></button>
        </div>
    </div>
</fieldset>