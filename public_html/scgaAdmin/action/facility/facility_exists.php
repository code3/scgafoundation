<?
$_mysql->makeInputsSafe();

$info = $_mysql->getSingle('SELECT name, facilityid FROM facility WHERE name= "' . $_GET['name'] . '"');

if ($info) { // name exists
	if ($_GET['edit'] == '1') {
		if ($_GET['facilityid'] == $info['facilityid']) {
			die('false');
		}
		else {
			die('This facility already exists');
		}
	}
	else {
		die('This facility already exists');
	}
}
else {
	die('false');
}
?>