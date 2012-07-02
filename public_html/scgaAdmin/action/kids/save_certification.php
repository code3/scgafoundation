<?
$_mysql->makeInputsSafe();
if (!isset($_POST['scga']) && !is_numeric($_POST['certificationid'])) {
	$_SESSION[PREFIX . 'error'] = $_p . ' scga or certification id not set';
	died(CLIENTROOT . '/error');
}

$fields = array('scga', 'year', 'certification_status');
$values = array($_POST['scga'], $_POST['year'], $_POST['certification_status']);

if ($_POST['date_certified'] != '') {
	$_POST['date_certified'] = changeDateFormat($_POST['date_certified']);
	array_push($fields, 'date_certified');
	array_push($values, $_POST['date_certified']);
}

if ($_POST['edit'] == '0') { //add new
	$_mysql->insert('certification', $fields, $values);
	$_SESSION['updated'] = 'Certification Added';
}
else if ($_POST['edit'] == '1') { //edit
	if (!is_numeric($_POST['certificationid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' - certificationid not numeric';
		died(CLIENTROOT . '/error');
	}
	
	$_mysql->update('certification', $fields, $values, 'certificationid = ' . $_POST['certificationid']);
	if ($_POST['date_certified'] == '') {
		// set date certified to null if blank
		$_mysql->query('UPDATE certification SET date_certified = NULL WHERE certificationid = ' . $_POST['certificationid'], 'Custom');
	}
	$_SESSION['updated'] = 'Certification Updated';
}

died(CLIENTROOT . '/kids/details');
?>