<fieldset>
    <!-- Form Name -->
    <legend>User Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">User Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="username" autocomplete="off" placeholder="User Name" class="form-control"
                required="" value="<?php echo ($edit) ? $users['username'] : ''; ?>" autocomplete="off">
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
                value="" autocomplete="off">
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
                    required="" autocomplete="off">
            </div>
        </div>
    </div>
    <?php } ?>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Email</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="email" name="email"
                required="" value="<?php echo htmlspecialchars($edit ? $users['email'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="E-Mail Address" class="form-control" id="email">
            </div>
        </div>
    </div>
    <!-- radio checks -->
    <div class="form-group">
        <label class="col-md-4 control-label">Gender</label>
        <div class="col-md-4">
            <div class="radio">
                <label>
                    <?php //echo $admin_account['admin_type'] ?>
                    <input type="radio" name="gender" value="Male"
                        <?php echo ($edit && $users['gender'] =='Male') ? "checked": "" ; ?> /> Male
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="gender" value="Female"
                        <?php echo ($edit && $users['gender'] =='Female') ? "checked": "" ; ?> /> Female
                </label>
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Phone</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input name="phone"
                required="required" value="<?php echo htmlspecialchars($edit ? $users['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="01#########" class="form-control" type="text" id="phone">
            </div>
        </div>
    </div>
    <!-- radio checks -->
    <?php if($operation == 'edit'){ ?>
    <div class="form-group">
        <label class="col-md-4 control-label">Account Type</label>
        <div class="col-md-4">
            <div class="radio">
                <label>
                    <input type="radio" name="account_type" value="Client"
                        <?php echo ($edit &&$users['account_type'] =='Client') ? "checked": "" ; ?>
                        required="required" /> Client
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="account_type" value="Provider"
                        <?php echo ($edit && $users['account_type'] =='Provider')? "checked": "" ; ?>
                        required="required" /> Provider
                </label>
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
