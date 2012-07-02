<?
$adminEmail = $_mysql->getSingle('SELECT config AS email FROM config WHERE name = "adminEmail"', false);

if ($_POST['email'] == $adminEmail['email']) {
	$adminLogin = $_mysql->getSingle('SELECT login FROM login WHERE groupID = 1');
	$tempPass = $_login->resetPass($adminLogin['login']);
	$emailBody = 'Username:<br/>' . $adminLogin['login'] . '<br/>Password:<br/>' . $tempPass;
	email('Rapidtech.org admin panel', 'No-Reply@No-Reply.com', 'Administrator', $adminEmail['email'], 'Administrator Password Reseted', $emailBody);
	$_SESSION[PREFIX . 'resetLogin'] = true;
}
else {
	$_SESSION[PREFIX . 'resetLogin'] = false;
}
died(CLIENTROOT . '/login/reset_login.php');
?>