<?
if (!is_array($_POST['checked_certification'])) {
	died(CLIENTROOT . '/kids/details');
}

foreach ($_POST['checked_certification'] as $id) {
	if ($id == '') {
		$_SESSION[PREFIX . 'error'] = $_p . ' id not numeric';
		died(CLIENTROOT . '/error');
	}
	
	$_mysql->delete('certification' , 'certificationid = ' . $id);
}

$_SESSION['updated'] = 'Certifications Deleted';
died(CLIENTROOT . '/kids/details');
?>