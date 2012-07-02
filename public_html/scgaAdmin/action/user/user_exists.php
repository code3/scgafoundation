<?
$_mysql->makeInputsSafe();

$user = $_mysql->getSingle('SELECT login from login WHERE login = "' . $_GET['login'] . '"');

if ($user) { // exist
	die('true');
}
else { //does not exist
	die ('false');
}
?>