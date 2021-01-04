    <!-- Form Name -->
    <legend>Providers Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Providers Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="username" autocomplete="off" placeholder="Providers Name" class="form-control"
                    value="<?php echo ($edit) ? $users['username'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>

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
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Email</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                <input type="email" name="email"
                    value="<?php echo htmlspecialchars($edit ? $users['email'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="E-Mail Address" class="form-control" id="email">
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
                    value="<?php echo htmlspecialchars($edit ? $users['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="01#########" class="form-control" type="text" id="phone">
            </div>
        </div>
    </div>
    <!-- drop down list -->
    <div class="form-group">
        <label class="col-md-4 control-label">City Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <select id="City1" name="city_name" class="form-control" required="" value="<?php echo ($edit) ? $region['city_id'] : ''; ?>">
                <?php 
                $selected_city_id = $region['city_id'];
                include_once('include_citis.php'); ?>
                </select>
            </div>
        </div>
    </div>
    <!-- drop down list -->
    <div class="form-group">
        <label class="col-md-4 control-label">Region Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <select id="Region1" name="region_name" class="form-control" required="" 
                 value="<?php echo ($edit) ? $region['region_name'] : ''; ?>">
                <?php 
                $selected_city_id = $region['city_id'];
                include_once('include_citis.php'); ?>
                </select>
            </div>
        </div>
    </div>
    <!-- checks box-->
    <div class="form-group">
        <label class="col-md-4 control-label">Service Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                <select name="ser_name" class="form-control" required="" value="<?php echo ($edit) ? $services['ser_name'] : ''; ?>">
                <?php 
                $selected_service_id = $services['ser_name'];
                include_once('include_service.php'); ?>
                </select>
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
    <!-- radio checks -->
    <div class="form-group">
        <label class="col-md-4 control-label">Provider State</label>
        <div class="col-md-4">
            <div class="radio">
                <label>
                    <?php //echo $admin_account['admin_type'] ?>
                    <input type="radio" name="prov_state" value="accept" required=""
                        <?php echo ($edit && $users['prov_state'] =='accept') ? "checked": "" ; ?> /> Accept
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="prov_state" value="hold" required=""
                        <?php echo ($edit && $users['prov_state'] =='hold') ? "checked": "" ; ?> /> Hold
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
