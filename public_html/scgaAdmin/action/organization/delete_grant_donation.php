<?
if (!is_array($_POST['checked_' . $_GET['subsection']])) {
	died(CLIENTROOT . '/organization/details');
}

if ($_GET['subsection'] != 'grant' && $_GET['subsection'] != 'donation') {
	$_SESSION[PREFIX . 'error'] = $_p . ' - delete grant_donation:' . $_GET['subsection'];
	died(CLIENTROOT . '/error');
}

foreach ($_POST['checked_' . $_GET['subsection']] as $id) {
	if ($id == '') {
		$_SESSION[PREFIX . 'error'] = $_p . ' - delete grant_donation:' . $_GET['subsection'];
		died(CLIENTROOT . '/error');
	}
	$_mysql->delete('`' . $_GET['subsection'] . '`' , $_GET['subsection'] . 'id = ' . $id);
}

$_SESSION['updated'] = ucfirst($_GET['subsection']) . 's Deleted';
died(CLIENTROOT . '/organization/details');
?>