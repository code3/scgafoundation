<?
if (!is_array($_POST['checked_user'])) {
	died(CLIENTROOT . '/user/main');
}

foreach ($_POST['checked_user'] as $loginid) {
	if (!is_numeric($loginid)) {
		$_SESSION[PREFIX . 'error'] = $p . ' - 0';
		died(CLIENTROOT . '/error');
	}
	
	$_mysql->delete('login' , 'loginid = ' . $loginid);
}
died(CLIENTROOT . '/user/main');
?>