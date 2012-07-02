<?
//create login
$loginID = $_login->createLogin($_POST['login'], $_POST['password'], $_POST['login_groupid']);

$_SESSION['updated'] = 'User Added';
died(CLIENTROOT . '/user/main');
?>