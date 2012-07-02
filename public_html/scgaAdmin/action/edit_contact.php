<?
$_mysql->makeInputsSafe();

$contactFields = array('fname'
					   , 'lname'
					   , 'position'
					   , 'work'
					   , 'cell'
					   , 'email'
					   , '`primary`'
					   );

if ($_POST['primary'] != '1') {
	$_POST['primary'] = '0';
}

$contactValues = array(trim($_POST['fname'])
					   , trim($_POST['lname'])
					   , trim($_POST['position'])
					   , trim($_POST['work'])
					   , trim($_POST['cell'])
					   , trim($_POST['email'])
					   , $_POST['primary']
					   );

if ($_POST['contact_area'] == 'facility' && !is_numeric($_POST['contact_areaid'])) {
	$_SESSION[PREFIX . 'error'] = $p . ' - action/edit_contact, contact_areaid not numeric';
	died(CLIENTROOT . '/error');
}
else if ($_POST['contact_area'] != 'facility' && !isset($_POST['contact_areaid'])) {
	$_SESSION[PREFIX . 'error'] = $p . ' - action/edit_contact, not set contact_areaid';
}

if (!is_numeric($_POST['contactid2'])) {
	$_SESSION[PREFIX . 'error'] = $p . ' - edit contact contactid2 not numeric';
	died(CLIENTROOT . '/error');
}

$_mysql->update('contact', $contactFields, $contactValues, 'contactid2 = ' . $_POST['contactid2']);

$_SESSION['updated'] = 'Contact Updated';

died(CLIENTROOT . '/' . $_POST['contact_area'] . '/details?' . $_POST['contact_area'] . 'id=' . $_POST['contact_areaid']);
?>