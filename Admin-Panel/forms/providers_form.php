    <!-- Form Name -->
    <legend>Providers Form</legend>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Providers Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" name="username" autocomplete="off" placeholder="Providers Name" class="form-control"
                required="" value="<?php echo ($edit) ? $users['username'] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <?php 
        $required_field= $operation == 'edit' ? '': 'required';
         ?>
    <!-- Text input-->
    
   
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Password</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" name="password" autocomplete="off" placeholder="Password "
                    class="form-control" required="<?php echo $required_field; ?>" autocomplete="off">
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
                    required="" placeholder="E-Mail Address" class="form-control" id="email">
            </div>
        </div>
    </div>
    <!-- Text input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Phone</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
                <input name="phone" value="<?php echo htmlspecialchars($edit ? $users['phone'] : '', ENT_QUOTES, 'UTF-8'); ?>"
                required="" placeholder="01#########" class="form-control" type="text" id="phone">
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
                $required_field= ($edit) ? '': 'required';
                $selected_city_id =($edit) ?  $users['city_id']: null ;
                $selected_region_id =($edit) ?  $users['region_id']: null ;
                include_once('include_citis.php'); ?>
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
                 value="<?php echo ($edit) ? $users['region_id'] : ''; ?>">
                 <option value="none" selected >Region Name</option>
                 <?php 
                    if ($edit){
                    include_once('fetch_regions.php');
                 } ?>
                </select>
            </div>
        </div>
    </div>
    <!-- checks box-->
    <div class="form-group">
        <label class="col-md-4 control-label">Service Name</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="service-check">
                <?php 
                $selected_service_ids = ($edit) ? $users['ser_id'] : "";
                include_once('include_service.php'); ?>
            </div>
            <div style="visibility:hidden; color:red; " id="chk_option_error">
                Please select at least one option.
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
                        <?php echo ($edit && $users['account_type'] =='Client') ? "checked": "" ; ?>
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
    <?php if($operation == 'edit'){ ?>
    <!-- File input-->
    <div class="form-group">
        <label class="col-md-4 control-label">National ID</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="ID_img" autocomplete="off" placeholder="National ID" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $users[''] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <!-- File input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Commercial ID</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="comm_img" autocomplete="off" placeholder="Commercial ID" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $users[''] : ''; ?>" autocomplete="off">
            </div>
        </div>
    </div>
    <?php } else { ?>
    <!-- File input-->
    <div class="form-group">
        <label class="col-md-4 control-label">National ID</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="ID_img" autocomplete="off" placeholder="National ID" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $users[''] : ''; ?>" required=""  autocomplete="off">
            </div>
        </div>
    </div>
    <!-- File input-->
    <div class="form-group">
        <label class="col-md-4 control-label">Commercial ID</label>
        <div class="col-md-4 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-picture-o fa-fw"></i></span>
                <input type="file" name="comm_img" autocomplete="off" placeholder="Commercial ID" class="form-control" accept="image/*"
                    value="<?php echo ($edit) ? $users[''] : ''; ?>" required=""  autocomplete="off">
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if($operation == 'edit'){ ?>
    <!-- radio checks -->
    <div class="form-group">
        <label class="col-md-4 control-label">Provider State</label>
        <div class="col-md-4">
            <div class="radio">
                <label>
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
    <?php } ?>
    <!-- Button -->
    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-4">
            <button type="submit" class="btn btn-warning">Save <span class="glyphicon glyphicon-send"></span></button>
        </div>
    </div>
    </fieldset>
