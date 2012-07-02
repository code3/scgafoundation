<?
$_mysql->makeInputsSafe();
if (!isset($_POST['organizationid'])) {
	$_SESSION[PREFIX . 'error'] = $_p . ' - action/organization/save_grant';
	died(CLIENTROOT . '/error');
}

if ($_GET['subsection'] != 'grant' && $_GET['subsection'] != 'donation') {
	$_SESSION[PREFIX . 'error'] = $_p . ' - action/organization/save_grant_donation: ' . $_GET['subsection'];
	died(CLIENTROOT . '/error');
}

if ($_GET['subsection'] == 'grant') {
	$fields = array('organizationid', 'year', 'amount','note');
	$values = array($_POST['organizationid'], $_POST['year'], $_POST['amount'], replaceWordChars($_POST['note']));
}
else {
	$_POST['date'] 	= changeDateFormat($_POST['date']);
	$fields 		= array('organizationid', 'date', 'item', 'quantity', 'value','note');
	$values 		= array($_POST['organizationid'], $_POST['date'], replaceWordChars($_POST['item']), replaceWordChars($_POST['quantity']), replaceWordChars($_POST['value']), replaceWordChars($_POST['note']));
}
	
$_mysql->insert('`' . $_GET['subsection'] . '`', $fields, $values);

$_SESSION['updated'] = ucfirst($_GET['subsection']) . ' Added';
died(CLIENTROOT . '/organization/details');
?>
