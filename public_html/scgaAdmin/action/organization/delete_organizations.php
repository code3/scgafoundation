<?
if (!is_array($_POST['checked_organization'])) {
	died(CLIENTROOT . '/organization/main');
}

foreach ($_POST['checked_organization'] as $organizationid) {
	if ($organizationid == '') {
		$_SESSION[PREFIX . 'error'] = $_p . ' - delete organization';
		died(CLIENTROOT . '/error');
	}
	
	$id = $_mysql->getSingle('SELECT addressid, noteid, contactid FROM organization WHERE organizationid = "' . $organizationid . '"');
	$_mysql->delete('address' , 'addressid = ' . $id['addressid']);
	$_mysql->delete('contact' , 'contactid = ' . $id['contactid']);
	$_mysql->delete('note' , 'noteid = ' . $id['noteid']);
	$_mysql->delete('`grant`' , 'organizationid = "' . $organizationid . '"');
	$_mysql->delete('donation' , 'organizationid = "' . $organizationid . '"');
	$_mysql->delete('organization' , 'organizationid = "' . $organizationid . '"');

}
unset($id, $grants, $donations);
$_SESSION['updated'] = 'Organization Deleted';
died(CLIENTROOT . '/organization/main');
?>