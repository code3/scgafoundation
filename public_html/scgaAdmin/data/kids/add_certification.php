<?
if (!isset($_GET['scga']) && !is_numeric($_GET['certificationid'])) {
	$_SESSION[PREFIX . 'error'] = $p . ' - data/add_certification:' . $_GET['certificationid'];
	died(CLIENTROOT . '/error/');
}

if (is_numeric($_GET['certificationid'])) {
	$_cert = $_mysql->getSingle('SELECT certification.* FROM certification WHERE certificationid = ' . $_GET['certificationid']);
	$_year = $_cert['year'];
	$_status = $_cert['certification_status'];
	$_edit = '1';
	$_GET['scga'] = $_cert['scga'];
	$_extra = 2;
	$_title = "Edit certification for";
	if ($_cert['date_certified'] != '0000-00-00' && $_cert['date_certified'] != '') {
		$_certDate = date('m/d/Y', strtotime($_cert['date_certified']));
	}
	else {
		$_certDate = '';
	}
}
else {
	$_year = date('Y');
	$_status = 'Not certified';
	$_edit = '0';
	$_title = 'Add certification to';
	$_certDate = '';
}

$_kid = $_mysql->getSingle('SELECT fname FROM kids WHERE scga = "' . $_GET['scga'] . '"');
if (!$_kid) {
	$_SESSION[PREFIX.'error'] = $p . ' - data/add_certification';
	died(CLIENTROOT.'/error/');
}
?>