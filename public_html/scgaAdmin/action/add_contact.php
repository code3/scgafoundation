<?
$_mysql->makeInputsSafe();

if ($_POST['contactid'] == 0) { // need to create a contact id

	if ($_POST['contact_area'] == 'facility' && !is_numeric($_POST['contact_areaid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' not numeric contact_areaid';
	}
	else if ($_POST['contact_area'] != 'facility' && !isset($_POST['contact_areaid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' not set contact_areaid';
	}
	if (!is_numeric($_POST['contactid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' not numeric contact id';
	}
	if (isset($_SESSION[PREFIX . 'error'])) {
		died(CLIENTROOT . '/error');
	}
	
	$curContactid = $_mysql->getSingle('SELECT MAX(contactid) AS currrent_contactid FROM contact');
	if (!$curContactid) {
		$curContactid['currrent_contactid'] = 0;
	}
	$_POST['contactid'] = $curContactid['currrent_contactid'] + 1; //manual increment
	
	if (strstr($_POST['contact_area'], '.')) { // more custom parameter, table.contactidfield.primarykey
		$parts = explode('.', $_POST['contact_area']);
		$_mysql->update($parts[0], array($parts[1]), array($_POST['contactid']), $parts[2] . ' = ' . $_POST['contact_areaid']);
	}
	else { // quick parameter, contactid is used, contact_area is table name and is also used for primary key nameing scheme
		$_mysql->update($_POST['contact_area'], array('contactid'), array($_POST['contactid']), $_POST['contact_area'].'id = "' . $_POST['contact_areaid'] . '"');
	
	}
}

if ($_POST['primary'] != '1') {
	$_POST['primary'] = '0';
}
$_mysql ->insert('contact', 
				array('contactid'
					  , 'fname'
					  , 'lname'
					  , 'position'
					  , 'work'
					  , 'cell'
					  , 'email'
					  , 'primary'
					  ),
				array($_POST['contactid'],
					  trim($_POST['fname']),
					  trim($_POST['lname']),
					  trim($_POST['position']),
					  trim($_POST['work']),
					  trim($_POST['cell']),
					  trim($_POST['email']),
					  $_POST['primary']
					  )
				);
?>
<script type="text/javascript">
	<!--
	parent.refreshContact('<?= $_POST['contactid'] ?>', '<?= $_POST['contact_index'] ?>', '<?= $_POST['contact_inform'] ?>');
	//-->
</script>