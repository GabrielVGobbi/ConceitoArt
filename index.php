<?php
session_start();

ini_set('display_errors', 0);
ini_set('display_startup_erros', 0);
error_reporting(E_ALL);


require '../../../config/config.php';
require '../../../config/autoload.php';
require '../../../config/constant.php';
#require '../../../backup.php';

$core = new Core();
$core->run();
?>