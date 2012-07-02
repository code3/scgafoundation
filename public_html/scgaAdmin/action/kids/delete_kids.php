<?
if (!is_array($_POST['checked_kids'])) {
	died(CLIENTROOT . '/kids/main');
}

foreach ($_POST['checked_kids'] as $scga) {
	$ids = $_mysql->getSingle('SELECT addressid, noteid FROM kids WHERE scga = "' . $scga . '"');
	$_mysql->delete('address' , 'addressid = ' . $ids['addressid']);
	$_mysql->delete('note' , 'noteid = ' . $ids['noteid']);
	$_mysql->delete('kids' , 'scga = "' . $scga . '"');
	$_mysql->delete('quiz' , 'scga = "' . $scga . '"');
	$_mysql->delete('certification' , 'scga = "' . $scga . '"');
	$_mysql->delete('tracking' , 'scga = "' . $scga . '"');
	$_mysql->delete('login' , 'login = "' . $scga . '"');
}

$_SESSION['updated'] = 'Kids Deleted';
died(CLIENTROOT . '/kids/main');
?>