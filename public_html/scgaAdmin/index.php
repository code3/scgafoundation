<?
session_start();
require('config/define.php');
require('config/config.php');
require('library/php/mysql_v6.php');
require('library/php/emg.php');
require('library/php/login_v2.php');
require('library/php/pl_v2.php');

httpsOn();
$_title = 'Home';

//content
$_p = str_replace('-', '_', $_GET['p']);
if($_p == ''){
	$_p = 'home.php';
}
if(!file_exists($_p)){
	$_SESSION[PREFIX.'error'] = $_p.'scgaAdmin/index'; 
	$_p = 'error.php';
}
$file = explode('.php', $_p);
$dir = explode('/', $file[0]);
$_page = strtolower(str_replace('-', ' ', $dir[0]));

$pageConvert = array('facility' => 'facilities'
					, 'organization' => 'organizations'
					, 'tracking' => 'yoc tracking'
					, 'user' => 'admin'
					, 'life_skills' => 'life skills'
					, 'purchase' => 'online purchases'
					, 'yoc_membership' => 'yoc membership'
					);
if (array_key_exists($_page, $pageConvert)) {
	$_page = $pageConvert[$_page];
}
unset($pageConvert);
$_mysql = new mysql();

//login

$_login = new login($_mysql);
if( !$_login->protect(array(1,2,3)) ){
	$_SESSION[PREFIX.'access'] = $_SERVER['REQUEST_URI'];
	died(CLIENTROOT.'/login/index.php');
}
else{
	$_username = $_login->login;
}
//data
if(file_exists('data/'.$_p)){
	include 'data/'.$_p;
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script type="text/javascript">
<!--
window.CLIENTROOT = '<?= CLIENTROOT ?>';
//-->
</script>
<? 
if(file_exists('header/'.$_p)){
	require 'header/'.$_p;
}
require('parts/header.php'); 
?>
</head>
<body>
	<? require('parts/nav.php'); ?>
	<div id="container">
	<? require('parts/action-msg.php'); ?>
	<? require($_p); ?>
	<? require('parts/footer.php'); ?>
</div>
</body>
</html>

<?php
$_mysql->close();
unset($_mysql, $_login);
?>