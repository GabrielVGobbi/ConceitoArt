<?php
session_start();
require 'config/config.php';
require 'config/autoload.php';
require 'config/constant.php';
require 'backup.php';

$core = new Core();
$core->run();
?>