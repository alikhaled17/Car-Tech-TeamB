<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');
require_once BASE_PATH.'/includes/auth_validate.php';
// Data class
require_once BASE_PATH.'/lib/Message/Message.php';
$Data_once = new Message();
// send data to Show Data
$select_coul = '*';
$nema_table = 'message';
$nema_table_count= 'message';
$coul = 'Name';
$types = 'message_type';
$select_types = "'new'";
$select_types_count="'new'";
include_once('Show_Data.php');

include BASE_PATH.'/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Inbox New Message</h1>
        </div>
    </div>
    <?php include BASE_PATH.'/includes/flash_messages.php'; ?>

    <?php
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
                <th width="15%">Sender's Name</th>
                <th width="15%">Email</th>
                <th width="15%">Subject</th>
                <th width="25%">Massege</th>
                <th width="15%">Date Time</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <script type="text/javascript"> function accept_mess(mess_id){
            $.ajax({
                type: "POST",
                url: "select_see_mess.php",
                data: {
                    get_mess_id:mess_id
                },
                success: function (response) {
                    setInterval(function() {
                    location.reload();
                }, 50);
                }
            });
        }
        </script>
        <tbody>
        <?php foreach ($rows as $row): ?>
            <tr>
                <th><?php echo $row['id']; ?></td>
                <th><?php echo htmlspecialchars($row['Name']); ?></th>
                <th><?php echo htmlspecialchars($row['Email']); ?></th>
                <th><?php echo htmlspecialchars($row['Subject']); ?></th>
                <th><?php echo htmlspecialchars($row['Massege']); ?></th>
                <th><?php echo htmlspecialchars($row['date_time']); ?></th>
                <th>
                    <?php $selected_mess = $row['id']; ?>
                    <button onclick="accept_mess(<?php echo $selected_mess; ?>)" class="btn btn-primary"><i class="glyphicon glyphicon-eye-close"></i></button>
                    <a href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_new_Message.php" method="POST">
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
    <?php echo paginationLinks($page, $total_pages, 'inbox_new_message.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH.'/includes/footer.php'; ?>
