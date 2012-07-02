<?php session_start();
error_reporting(E_ALL);
require("../library/php/mysql_v6.php");
require('../../zend/application/modules/scga/models/UrlLocator.php');
require("../library/php/check_class_objects.php");
echo 'hellos';
echo $_POST['yoc_id']; exit;

if ( !empty($_POST['yoc_id']) && !empty($_POST['scga_ghin']) ){

$mysqlObj->update('yoc_membership', 'scga_ghin_number', $_POST['scga_ghin'], 'yoc_id = "' . $_POST['yoc_id'] . '"');

$urlLocatorObj->getRedirector($_POST['return_url']);
 
}else{
	
	$urlLocatorObj->getRedirector($_POST['return_url']);
	$_SESSION['error_type'] = 1;
	
	}






 ?>
 