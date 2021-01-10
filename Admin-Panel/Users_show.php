<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');
require_once BASE_PATH . '/includes/auth_validate.php';
// send data to Show Data
$select_coul = 'id,username,email,gender,phone,account_type,prof_img';
$nema_table = 'users';
$nema_table_count='users';
$coul = 'username';
$types = 'account_type';
$select_types = '"Client"';
$select_types_count="'Client'";
include_once('Show_Data.php');

require_once BASE_PATH . '/lib/Users/Users.php';
$Data_once = new Users();

include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Users</h1>
        </div>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_users.php" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
            </div>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

     <!-- Filters -->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo htmlspecialchars($search_string, ENT_QUOTES, 'UTF-8'); ?>">
            <label for="input_order">Order By</label>
            <select name="filter_col" class="form-control">
                <?php
                foreach ($Data_once->setOrderingValues() as $opt_value => $opt_name):
                    ($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
                    echo ' <option value="'.$opt_value.'" '.$selected.'>'.$opt_name.'</option>';
                endforeach;
                ?>
            </select>
            <select name="order_by" class="form-control" id="input_order">
                <option value="Asc" <?php
                if ($order_by == 'Asc') {
                    echo 'selected';
                }
                ?> >Asc</option>
                <option value="Desc" <?php
                if ($order_by == 'Desc') {
                    echo 'selected';
                }
                ?>>Desc</option>
            </select>
            <input type="submit" value="Go" class="btn btn-primary">
        </form>
    </div>
    <hr>
    <!-- //Filters -->


    <div id="export-section">
        <a href="export_users.php"><button class="btn btn-sm btn-primary">Export to CSV <i class="glyphicon glyphicon-export"></i></button></a>
    </div>

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">User Name</th>
                <th width="20%">Email</th>
                <th width="5%">Gender</th>
                <th width="10%">Phone</th>
                <th width="15%">Profil</th>
                <th width="10%">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <th><?php echo $row['id']; ?></th>
                <th><?php echo xss_clean($row['username'] . ' '); ?></th>
                <th><?php echo xss_clean($row['email'] . ' '); ?></th>
                <th><?php echo xss_clean($row['gender'] . ' '); ?></th>
                <th><?php echo xss_clean($row['phone'] . ' '); ?></th>
                <td style="text-align:center;"><?php 
                        if($row['prof_img'] == '') {
                            ?>
                            <img src="./imgs/default-prof.jpg" style='width:100px;height:70px;'/>       
                            <?php 
                        } else {
                            ?>
                            <img  src="data:image/jpg;charset=utf8mb4;base64,<?php echo base64_encode($row['prof_img']); ?>" style=' width:100px;height:70px;' /> 
                            <?php
                        }
                    ?></td>

                <td>
                    <a href="edit_users.php?users_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_Users.php" method="POST">
                        <!-- Modal content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Confirm</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id="del_id" value="<?php echo $row['id']; ?>">
                                <p>Are you sure you want to delete this row?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default pull-left">Yes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- //Delete Confirmation Modal -->
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'Users_show.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
