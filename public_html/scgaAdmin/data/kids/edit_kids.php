<?
require 'library/php/states.php';

$_GET['kidsStr'] = trim($_GET['kidsStr'], "*");
$kidsStr = explode('*', $_GET['kidsStr']);
$edit = 1;
$numberOfKids = sizeof($kidsStr);
$kidsList = array();

for($i = 0; $i < $numberOfKids; $i++){
	$kid = $_mysql->getSingle('SELECT kids.*, organization.name, address.* FROM kids INNER JOIN organization ON kids.organizationid = organization.organizationid INNER JOIN address ON kids.addressid = address.addressid WHERE kids.scga = "' . $kidsStr[$i] . '"');
	
	if (!$kid) {
		$_SESSION[PREFIX . 'error'] = $_p . ' record does not exist: scga is:' . $kidsStr[$i];
		died(CLIENTROOT . '/error/');
	}
	
	$_maxYear = $_mysql->getSingle('SELECT MAX(year) AS maxYear FROM certification WHERE scga = "' . $kid['scga'] . '"');
	$_certStatus = $_mysql->getSingle('SELECT certification_status, year, certificationid, date_certified FROM certification WHERE year = ' . $_maxYear['maxYear'] . ' AND scga = "' . $kid['scga'] . '"');
	
	$kid['year'] = $_maxYear['maxYear'];
	$kid['certification_status'] = $_certStatus['certification_status'];
	if ($_certStatus['date_certified'] != '0000-00-00' && $_certStatus['date_certified'] != '') {
		$kid['date_certified'] = date('m/d/Y', strtotime($_certStatus['date_certified']));
	}
	else {
		$kid['date_certified'] = '';
	}
	
	array_push($kidsList, $kid);
}
?>