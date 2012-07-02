<?
$_mysql->makeInputsSafe();
if (!isset($_POST['scga'])) {
	$_SESSION[PREFIX . 'error'] = $_p . ' scga not set';
	died(CLIENTROOT . '/error');
}

$_POST['date'] 	= changeDateFormat($_POST['date']);
$fields = array('gameid', 'scga', 'date', 'amount', 'description', 'vtype');
$values = array(null, $_POST['scga'], $_POST['date'], $_POST['amount'], $_POST['description'], $_POST['vtype']);

$_mysql->insert('game', $fields, $values);
$_SESSION['updated'] = 'GAME Points Added';

died(CLIENTROOT . '/kids/details');
?>