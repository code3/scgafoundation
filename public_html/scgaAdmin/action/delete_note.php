<?
if (!is_numeric($_GET['noteid2'])) {
	died(CLIENTROOT . '/' . $_GET['section'] . '/details');
}

$_mysql->delete('note', 'noteid2 = ' . $_GET['noteid2']);
?>
