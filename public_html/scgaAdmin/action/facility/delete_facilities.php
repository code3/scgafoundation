<?
if (!is_array($_POST['checked_facility'])) {
	died(CLIENTROOT . '/facility/main');
}

foreach ($_POST['checked_facility'] as $facilityid) {
	if (!is_numeric($facilityid)) {
		$_SESSION[PREFIX . 'error'] = $p . ' - delete facility';
		died(CLIENTROOT . '/error');
	}
	
	$ids = $_mysql->getSingle('SELECT addressid, contactid, noteid FROM facility WHERE facilityid = ' . $facilityid);
	$_mysql->delete('address' , 'addressid = ' . $ids['addressid']);
	$_mysql->delete('contact' , 'contactid = ' . $ids['contactid']);
	$_mysql->delete('note' , 'noteid = ' . $ids['noteid']);
	$_mysql->delete('facility' , 'facilityid = ' . $facilityid);
	
}
$_SESSION['updated'] = 'Facility Deleted';
died(CLIENTROOT . '/facility/main');
?>