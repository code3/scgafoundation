<?
session_start();
chdir('../');
require 'config/define.php';
require 'config/config.php';
require 'library/php/mysql_v6.php';
require 'library/php/emg.php';
require 'library/php/validate.php';
require 'library/php/login_v2.php';

httpsOn();

//content

$_p = 'action/'.str_replace('-', '_', $_GET['p']); 
if (!file_exists($_p)) {
	$_SESSION[PREFIX . 'error'] = $_p . 'action/index';
	died(CLIENTROOT . '/error');
}

$_mysql = new mysql();
$_login = new login($_mysql);

$noProtect = array('action/login.php', 'action/reset_login.php'); //dosnt need login
if (!in_array($_p, $noProtect)) { 
	if(!$_login->protect(array(1,2,3))) {
		died(CLIENTROOT . '/login/index.php');
	}
}

require($_p);
unset($_mysql, $_login); 
?>