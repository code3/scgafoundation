<?
$_mysql->makeInputsSafe();

if ($_POST['noteid'] == 0) { // need to create a note id

	if ($_POST['note_area'] == 'facility' && !is_numeric($_POST['note_areaid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' not numeric note_areaid';
	}
	else if ($_POST['note_area'] != 'facility' && !isset($_POST['note_areaid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' not set note_areaid';
	}
	
	if (!is_numeric($_POST['noteid'])) {
		$_SESSION[PREFIX . 'error'] = $_p . ' noteid is not numeric';
	}
	
	if (isset($_SESSION[PREFIX . 'error'])) {
		died(CLIENTROOT . '/error');
	}
	
	$curNoteid = $_mysql->getSingle('SELECT MAX(noteid) AS currrent_noteid FROM note');
	if (!$curNoteid) {
		$curNoteid['currrent_noteid'] = 0;
	}
	
	$_POST['noteid'] = $curNoteid['currrent_noteid'] + 1; //manual increment
	
	if (strstr($_POST['note_area'], '.')) { // more custom parameter, table.noteidfield.primarykey
		$parts = explode('.', $_POST['note_area']);
		$_mysql->update($parts[0], array($parts[1]), array($_POST['noteid']), $parts[2] . ' = "'.$_POST['note_areaid'] . '"');
	}
	else { // quick parameter, noteid is used, note_area is table name and is also used for primary key nameing scheme
		$_mysql->update($_POST['note_area'], array('noteid'), array($_POST['noteid']), $_POST['note_area'] . 'id = "' . $_POST['note_areaid'] . '"');
	}
}

$_mysql ->insert('note', 
				array('noteid'
					  , 'time'
					  , 'by'
					  , 'note'
					  ),
				array($_POST['noteid']
					  , date('Y-m-d H:i:s')
					  , $_mysql->makeSafe($_login->login)
					  , $_mysql->makeSafe(str_replace('\r\n', "<br />", $_POST['note']))
					  )  
				);
?>
<script type="text/javascript">
	<!--
	parent.refreshNote('<?= $_POST['noteid'] ?>', '<?= $_POST['note_index'] ?>', '<?= $_POST['note_inform'] ?>');
	//-->
</script>