<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
if (!defined('BASE_PATH')) define('BASE_PATH', dirname(dirname(__FILE__)));
if (!defined('APP_FOLDER')) define('APP_FOLDER', 'simpleadmin');
if (!defined('CURRENT_PAGE')) define('CURRENT_PAGE', basename($_SERVER['REQUEST_URI']));

require_once BASE_PATH . '/helpers/helpers.php';

$conn = new mysqli('localhost', 'root', '', 'cartech1');


?>