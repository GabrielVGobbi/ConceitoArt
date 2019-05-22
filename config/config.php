<?php
require 'environment.php';

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://www2.adminnovo.com.br/admin/");
	$config['dbname'] = 'db_adminart';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://www.conceitoart.com.br/admin/");
	$config['dbname'] = 'soare416_dbMarcio';
	$config['host'] = 'ns528.hostgator.com.br';
	$config['dbuser'] = 'soare416_marcio';
	$config['dbpass'] = 'GGv27080';
}
?>