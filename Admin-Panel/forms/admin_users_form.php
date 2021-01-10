<fieldset>
    <!-- Form Name -->
    <legend>Admin Form</legend>
    <?php include_once('counting.php');
    $count_super=counting_type('admin_accounts','admin_type',"'super'");
?>

    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Admin Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="user_name" autocomplete="off" placeholder="Admin Name" class="form-control"
                required="" value="<?php echo ($edit) ? $admin_account['user_name'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <?php if($operation != ''){ ?>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" autocomplete="off" placeholder="Password " class="form-control"
                     value ="" autocomplete="off">
            </div>
        </div>
    </div>
    <?php } else { ?>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" autocomplete="off" placeholder="Password " class="form-control"
                    required="<?php echo $edit == false? true: false; ?>" value ="" autocomplete="off">
            </div>
        </div>
    </div>
    <?php } ?>
    <?php $displayed_attribute = $operation == 'edit' && $count_super == '1' && $admin_account['admin_type'] =='super'?  " disabled " : " ";
    ?>
    <!-- radio checks -->
    <div class="form-group">
    
        <label class="col-md-4 control-label">Admin Type</label>
        <div class="col-md-4">
            <div class="radio">
                <label>
                    <?php //echo $admin_account['admin_type'] ?>
                    <input type="radio" name="admin_type" value="super" required=""
                        <?php 
                        echo ($edit && $admin_account['admin_type'] =='super') ? "checked": "" ;
                        echo $displayed_attribute;
                         ?> /> Super Admin
                </label>
            </div>
            <div class="radio">
                <label>
                    
                    <input type="radio" name="admin_type" value="admin" required=""
                        <?php 
                        echo ($edit && $admin_account['admin_type'] =='admin') ? "checked": "" ;
                        echo $displayed_attribute;
                        ?> /> Admin
                </label>
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