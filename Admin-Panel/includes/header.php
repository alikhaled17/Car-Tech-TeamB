<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <!-- MetisMenu CSS -->
    <link href="assets/js/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="assets/css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>

</head>

<body>
    <div id="wrapper">

        <!-- Navigation -->
        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true): ?>
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"> Car Tech Admin Panel </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="../Car-Tech-TeamB/"><i class="fa fa-user fa-fw"></i> Car Tech </a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <!-- Admin Users -->
                        <li
                            <?php echo (CURRENT_PAGE == "admin_users.php" || CURRENT_PAGE == "add_admin.php") ? 'class="active"' : ''; ?>>
                            <a href="#"><i class="fa fa-adn fa-fw"></i> Admin <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne"">
                                <div class=" nav nav-second-level" id="collapseOne">
                                <li>
                                    <a href="admin_users.php"><i class="fa fa-list fa-fw"></i>List All</a>
                                </li>
                                <li>
                                    <a href="add_admin.php"><i class="fa fa-plus fa-fw"></i>Add New</a>
                                </li>
                                </div>
                            </ul>
                        </li>
                <!-- services -->
                <li
                    <?php echo (CURRENT_PAGE == "services_Show.php" || CURRENT_PAGE == "add_services.php") ? 'class="active"' : ''; ?>>
                    <a href="#"><i class="fa fa-car fa-fw"></i> Services <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne"">
                                <div class=" nav nav-second-level" id="collapseOne">
                        <li>
                            <a href="services_Show.php"><i class="fa fa-list fa-fw"></i>List All</a>
                        </li>
                        <li>
                            <a href="add_services.php"><i class="fa fa-plus fa-fw"></i>Add New</a>
                        </li>
            </div>
            </ul>
            </li>
            <!-- providers -->
            <li
                <?php echo (CURRENT_PAGE == "providers_show.php" || CURRENT_PAGE == "add_providers.php") ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-user-circle-o fa-fw"></i> Providers <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne">
                    <div class="nav nav-second-level" id="collapseOne">
                        <li>
                            <a href="hold_providers.php"><i class="fa fa-clock-o fa-fw"></i>Providers Hold</a>
                        </li>
                        <li>
                            <a href="providers_show.php"><i class="fa fa-list fa-fw"></i>Providers Accept</a>
                        </li>
                        <li>
                            <a href="add_providers.php"><i class="fa fa-plus fa-fw"></i>Add New</a>
                        </li>
                    </div>
                </ul>
            </li>
            <!-- Users -->
            <li
                <?php echo (CURRENT_PAGE == "Users_show.php" || CURRENT_PAGE == "add_users.php") ? 'class="active"' : ''; ?>>
                <a href="#"><i class="fa fa-users fa-fw"></i> Users <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne"">
                                <div class=" nav nav-second-level" id="collapseOne">
                    <li>
                        <a href="Users_show.php"><i class="fa fa-list fa-fw"></i>List All</a>
                    </li>
                    <li>
                        <a href="add_users.php"><i class="fa fa-plus fa-fw"></i>Add New</a>
                    </li>
    </div>
    </ul>
    </li>
    <!-- citis -->
    <li <?php echo (CURRENT_PAGE == "Cities_Show.php" || CURRENT_PAGE == "add_Cities.php") ? 'class="active"' : ''; ?>>
        <a href="#"><i class="fa fa-address-book fa-fw"></i> Citis & Region <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne"">
                                <div class=" nav nav-second-level" id="collapseOne">
            <li>
                <a href="Cities_Show.php"><i class="fa fa-list fa-fw"></i>List all Citis</a>
            </li>
            <li>
                <a href="add_Cities.php"><i class="fa fa-plus fa-fw"></i>Add New Citis</a>
            </li>
            <li>
                <a href="Region_show.php"><i class="fa fa-list fa-fw"></i>List all Region</a>
            </li>
            <li>
                <a href="add_Region.php"><i class="fa fa-plus fa-fw"></i>Add New Region</a>
            </li>
            </div>
        </ul>
    </li>
    <!-- advertising -->
    <li
        <?php echo (CURRENT_PAGE == "advertising_show.php" || CURRENT_PAGE == "add_advertising.php") ? 'class="active"' : ''; ?>>
        <a href="#"><i class="fa fa-bullhorn fa-fw"></i> Advertising <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne"">
                                <div class=" nav nav-second-level" id="collapseOne">
            <li>
                <a href="advertising_show.php"><i class="fa fa-list fa-fw"></i>List All</a>
            </li>
            <li>
                <a href="add_advertising.php"><i class="fa fa-plus fa-fw"></i>Add New</a>
            </li>
            </div>
        </ul>
    </li>
    <!-- Inbox Message -->
    <li <?php echo (CURRENT_PAGE == "Message_show.php" || CURRENT_PAGE == "") ? 'class="active"' : ''; ?>>
        <a href="#"><i class="fa fa-envelope-open fa-fw"></i> Inbox Message <span class="fa arrow"></span></a>
        <ul class="nav nav-second-level collapse " data-toggle="collapse" data-target="#collapseOne"">
                                <div class=" nav nav-second-level" id="collapseOne">
            <li>
                <a href="Message_show.php"><i class="fa fa-list fa-fw"></i>List All</a>
            </li>
            </div>
        </ul>
    </li>

    </ul>
    </div>
    <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
    </nav>
    

    <?php endif;?>
    <!-- The End of the Header -->

<!-- Load Facebook SDK for JavaScript -->

