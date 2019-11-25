<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_erros', 1);
error_reporting(E_ALL);


require 'config/config.php';
require 'config/autoload.php';
require 'config/constant.php';
#require 'backup.php';

$core = new Core();
$core->run();
?>