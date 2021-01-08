<?php
session_start();
require_once 'config/config.php';
include_once('counting.php');
require_once BASE_PATH . '/includes/auth_validate.php';
// send data to Show Data
$select_coul = "users.id,username,email,gender,phone,account_type,prof_img,
city_name,region_name,ID_img,comm_img,prov_state, group_concat(ser_name SEPARATOR ',<br> ')ser_name ";
$nema_table = 'users inner join p_address on users.id = p_address.p_id
 inner join regions on p_address.region_id = regions.id
 inner join cities on regions.city_id = cities.id
 inner join prov_services on prov_services.p_id = users.id
 inner join providers on providers.user_id = users.id
 inner join services on services.id = prov_services.ser_id ';
$nema_table_count= 'providers';
$coul = 'username';
$types = 'prov_state';
$select_types = "'hold' GROUP BY id";
$select_types_count="'hold'";
include_once('Show_Data.php');
// Data class
require_once BASE_PATH . '/lib/Providers/Providers.php';
$Data_once = new Providers();
include BASE_PATH . '/includes/header.php';
?>
<!-- Main container -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Providers Hold</h1>
        </div>
    </div>
    <?php include BASE_PATH . '/includes/flash_messages.php';?>

    <!-- Filters -->
    <div class="well text-center filter-form">
        <form class="form form-inline" action="">
            <label for="input_search">Search</label>
            <input type="text" class="form-control" id="input_search" name="search_string" value="<?php echo xss_clean($search_string); ?>">
            <label for="input_order">Order By</label>
            <select name="filter_col" class="form-control">
                <?php
                    foreach ($Data_once->setOrderingValues() as $opt_value => $opt_name):
                        ($order_by === $opt_value) ? $selected = 'selected' : $selected = '';
                        echo ' <option value="' . $opt_value . '" ' . $selected . '>' . $opt_name . '</option>';
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
                <th width="10%">provider Name</th>
                <th width="10%">Email</th>
                <th width="10%">Phone</th>
                <th width="5%">City</th>
                <th width="5%">Region</th>
                <th width="5%">services</th>
                <th width="10%">National ID</th>
                <th width="11%">Commercial ID</th>
                <th width="10%">Actions</th>

            </tr>
        </thead>
        <script type="text/javascript"> function accept_prov(prov_id){
            $.ajax({
                type: "POST",
                url: "accept_hold_prov.php",
                data: {
                    get_prov_id:prov_id
                },
                success: function (response) {
                    setInterval(function() {
                    location.reload();
                }, 100);
                }
            });
        }
        </script>
        <tbody>
            <?php foreach ($rows as $row): ?>
            <tr>
                <th><?php echo $row['id']; ?></td>
                <th><?php echo xss_clean($row['username'] . ' '); ?></th>
                <th><?php echo xss_clean($row['email'] . ' '); ?></th>
                <th><?php echo xss_clean($row['phone'] . ' '); ?></th>
                <th><?php echo xss_clean($row['city_name'] . ' '); ?></th>
                <th><?php echo xss_clean($row['region_name'] . ' '); ?></th>
                <th><?php echo ($row['ser_name'] . ' '); ?></th>
                <td style="text-align:center;"><img src="data:image/jpg;charset=utf8mb4;base64,
                <?php echo base64_encode($row['ID_img']); ?>" style='width:70px;height:50px;'/></td>
                <td style="text-align:center;"><img src="data:image/jpg;charset=utf8mb4;base64,
                <?php echo base64_encode($row['comm_img']); ?>" style='width:70px;height:50px;'/></td>

                <td>
                    <?php $selected_prov = $row['id']; ?>
                    <button onclick="accept_prov(<?php echo $selected_prov; ?>)" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i></button>
                    <button href="#" class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-<?php echo $row['id']; ?>"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="confirm-delete-<?php echo $row['id']; ?>" role="dialog">
                <div class="modal-dialog">
                    <form action="delete_hold_prov.php" method="POST">
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
    <?php echo paginationLinks($page, $total_pages, 'providers_show.php'); ?>
    </div>
    <!-- //Pagination -->
</div>
<!-- //Main container -->
<?php include BASE_PATH . '/includes/footer.php';?>
