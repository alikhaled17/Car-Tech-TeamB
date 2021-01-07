<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');

require_once BASE_PATH . '/includes/auth_validate.php';
// Admins class
require_once BASE_PATH.'/lib/Admins/Admins.php';
$Data_once = new Admins();
// Only super admin is allowed to access this page

// send data to Show Data
$select_coul = 'id, user_name, admin_type';
$nema_table = 'admin_accounts';
$nema_table_count= 'admin_accounts';
$coul = 'user_name';
$select_types = null;
include_once('Show_Data.php');

include BASE_PATH.'/includes/header.php';
if ($_SESSION['admin_type'] != 'super')
{
    // Show permission denied message
    $_SESSION['failure'] = "Only super admin is allowed to access this page";
    //header('HTTP/1.1 401 Unauthorized', true, 401);        // exit();
    // header('HTTP/1.1 401 Unauthorized', true, 401);
    // exit('<a class="navbar-brand"> Only super admin is allowed to access this page </a>');
}
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Admin</h1>
        </div>
        <?php if ($_SESSION['admin_type'] == 'super') { ?>
        <div class="col-lg-6">
            <div class="page-action-links text-right">
                <a href="add_admin.php" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Add new</a>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>
<?php if ($_SESSION['admin_type'] == 'super')
{
    if (isset($del_stat) && $del_stat == 1)
    {
        echo '<div class="alert alert-info">Successfully deleted</div>';
    }  
    ?>
    
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

    <!-- Table -->
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="45%">Name</th>
                <th width="40%">Admin type</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <th><?php echo $row['id']; ?></th>
                <th><?php echo htmlspecialchars($row['user_name']); ?></th>
                <th><?php echo htmlspecialchars($row['admin_type']); ?></th>
                <td>
                    <a href="edit_admin.php?admin_user_id=<?php echo $row['id']; ?>&operation=edit" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_Admin.php" method="POST">
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
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- //Table -->

    <!-- Pagination -->
    <div class="text-center">
    <?php echo paginationLinks($page, $total_pages, 'admin_users.php'); ?>
    </div>
    <!-- //Pagination -->
<?php } ?>
</div>
<!-- //Main container -->
<?php include BASE_PATH.'/includes/footer.php'; ?>
