<?
if (!is_array($_POST['checked_contact'])) {
	died(CLIENTROOT . '/' . $_GET['section'] . '/details?' . $_GET['section'] . 'id=' . $_GET['sectionid']);
}

foreach ($_POST['checked_contact'] as $id) {
	if (!is_numeric($id) ){
		$_SESSION[PREFIX . 'error'] = $_p . ' id not numeric';
		died(CLIENTROOT . '/error');
	}
	
	$_mysql->delete('contact', 'contactid2 = ' . $id);
}
$_SESSION['updated'] = 'Contact Deleted';

died(CLIENTROOT . '/' . $_GET['section'] . '/details');
?>