<?php
$_mysql->makeInputsSafe();

$trackingFields = array('scga', 'facilityid', 'date', 'type');
$number 		= sizeof($_POST['scga']);
$error 			= '0';

for ($i = 0; $i < $number; $i++) {
	if ($_POST['date'][$i] == '') {
		continue;
	}
	$scga 		= $_mysql->getSingle('SELECT scga FROM kids WHERE scga = "' . $_POST['scga'][$i] . '"'); // check if scga is valid
	if (!$scga) {
		$error 	= '2';
		$value 	= $_POST['scga'][$i];
		$row 	= $i + 1;
		continue;
	}
	$facility 	= $_mysql->getSingle('SELECT facilityid,name FROM facility WHERE name = "' . $_POST['facility'][$i] . '"'); //  check if facility is valid
	if (!$facility) {
		$error 	= '1';
		$value 	= $_POST['facility'][$i];
		$row 	= $i + 1;
		continue;
	}
	if ($_POST['range' . $i] == '' && $_POST['course' . $i] == '' && $_POST['edit'] != '1') {
		$error 	= '4';
		$row 	= $i + 1;
		continue;
	}
	else if($_POST['type' . $i] == '' && $_POST['edit'] == '1'){
		$error 	= '4';
		$row 	= $i + 1;
		continue;
	}
	
}

if ($error == '0') {
	$numAdded = 0;
	for ($i = 0; $i < $number; $i++) {
		if ($_POST['date'][$i] == '') {
			continue;
		}
		$_POST['date'][$i] 	= dateFormat($_POST['date'][$i], '-');
		$facility 			= $_mysql->getSingle('SELECT facilityid FROM facility WHERE name = "' . $_POST['facility'][$i] . '"');
		$trackingValues 	= array($_POST['scga'][$i], $facility['facilityid'], $_POST['date'][$i]);
		if ($_POST['edit'] 	== '1') {
			if (!is_numeric($_POST['trackingid'][$i])) {
				$_SESSION[PREFIX . 'error'] = $_p . ': - trackingid not numeric';
				died(CLIENTROOT . '/error');
			}
			
			$_mysql->update('tracking', $trackingFields, array_merge($trackingValues, array($_POST['type' . $i])), 'trackingid=' . $_POST['trackingid'][$i]);
			$numAdded++;
			
		}
		else {
			if ($_POST['range'.$i] == '1') {
				$_mysql->insert('tracking', $trackingFields, array_merge($trackingValues, array('Range')));
				$numAdded++;
			}
			if ($_POST['course' . $i] == '1') {
				$_mysql->insert('tracking', $trackingFields, array_merge($trackingValues, array('Course')));
				$numAdded++;
			}
		}
	}
	
	$_SESSION['updated'] 	= ($_POST['edit'] == '1') ? $numAdded . ' Tracking Records Updated' : $numAdded . ' Tracking Records Added';
	
}
?>
<script type="text/javascript">
	<!--
	parent.addTrackingErrorHandler(<?= $error ?>, '<?= $value ?>', '<?= $row ?>', 'false');
	//-->
</script>