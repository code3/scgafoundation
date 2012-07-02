<?
if (!is_array($_POST['checked_tracking'])) {
	died(CLIENTROOT . '/tracking/main');
}

foreach($_POST['checked_tracking'] as $trackingid){
	$_mysql->delete('tracking', 'trackingid = ' . $trackingid);
}

$_SESSION['updated'] = 'Tracking Record Deleted';
died(CLIENTROOT . '/tracking/main');
?>