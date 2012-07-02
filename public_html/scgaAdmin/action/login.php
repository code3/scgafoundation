<?php
if ($_POST['login'] == '' || $_POST['password'] == '') {
	//redirect back to login page
	$_SESSION[PREFIX . 'loginFailed'] = true;
	died(CLIENTROOT . '/login/index.php');
}
require 'library/php/email.php';
$date = date("Y-m-d H:i:s"); 
//check if the system was locked out within the last hour
$lastLockOut = $_mysql->getSingle('SELECT logid FROM log WHERE type = "System Locked Out" AND date >= DATE_SUB("' . $date . '", INTERVAL 1 HOUR)');

if ($lastLockOut) { //if so, redirect back to login page
	$_SESSION[PREFIX . 'loginFailed'] = "<h1>The system has been locked due to too many failed login attempts.<br />";
	$_SESSION[PREFIX . 'loginFailed'] .= "Please contact an administrator.</h1><br />";
	died(CLIENTROOT . '/login/index.php');
}

//check log table to see how many failed attempts there have been in the last 5 minutes
$numLoginAttempts = $_mysql->getSingle('SELECT COUNT(logid) FROM log WHERE type="Failed Login Attempt" AND date >= DATE_SUB("' . $date . '", INTERVAL 1 MINUTE)');

if ($numLoginAttempts['COUNT(logid)'] >= 20 ) { //if too many failed login in attempts
	//lock out/update database
	$_mysql->makeInputsSafe();
	$description = 'System Locked Out: ' . $date;
	$fields = array('loginid', 'type', 'date','description');
	$values = array('96', 'System Locked Out', $date, $description);
	$_mysql->insert('log', $fields, $values);
	
	//Email Alex
	$serverStr = implode("<br />", $_SERVER);
	email('SCGA', 'atran@eckxmediagroup.com', 'Alex Tran', 'atran@eckxmediagroup.com', 'SCGA Admin Panel Locked Out', 'Locked out ' . $date . ' Server variables:' . $serverStr);
	
	//redirect back to login page
	$_SESSION[PREFIX . 'loginFailed'] = "<h1>The system has been locked due to too many failed login attempts. ";
	$_SESSION[PREFIX . 'loginFailed'] .= "Please contact an administrator.</h1><br />";
	died(CLIENTROOT . '/login/index.php');
}

if ($_login->authen($_POST['login'], $_POST['password'])) {

	if ($_login->groupID == 4) {
		$_SESSION[PREFIX . 'loginFailed'] = true;
		died(CLIENTROOT . '/login/index.php');
	}

	if (isset($_SESSION[PREFIX . 'access'])) {
		$_SESSION[PREFIX . 'error'] = $_p . $_SESSION[PREFIX . 'access'];
		died($_SESSION[PREFIX . 'access']);
		unset($_SESSION[PREFIX . 'access']);
	}
	else {
		died(CLIENTROOT);
	}
	
}
else {
	$_mysql->makeInputsSafe();
	//update log table with the failed login attempt
	$description = 'Failed login attempt with username: ' . $_POST['login'];
	$fields = array('loginid', 'type', 'date','description');
	$values = array('0', 'Failed Login Attempt', $date, $description);
	$_mysql->insert('log', $fields, $values);
	
	//redirect back to login page	
	$_SESSION[PREFIX . 'loginFailed'] = true;
	died(CLIENTROOT . '/login/index.php');
}
?>