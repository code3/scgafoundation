<?
if (!is_array($_POST['checked_game'])) {
	died(CLIENTROOT . '/kids/details');
}


foreach ($_POST['checked_game'] as $id) {
	if ($id == '') {
		$_SESSION[PREFIX . 'error'] = $_p . ' id is not numeric';
		died(CLIENTROOT . '/error');
	}
	$_mysql->delete('game' , 'gameid = ' . $id);
}

$_SESSION['updated'] = 'GAME Points Deleted';
died(CLIENTROOT . '/kids/details');
?>