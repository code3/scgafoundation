<?
$_GET['trackingStr'] 	= trim($_GET['trackingStr'], "*");
$trackingStr 			= explode('*', $_GET['trackingStr']);
$edit 					= 1;
$numberOfTrackings 		= sizeof($trackingStr);
$trackingRecordList 	= array();
for($i = 0; $i < $numberOfTrackings; $i++){
	//$trackingRecordIDS = explode(',',$trackingStr[$i]);
	//$scga = $trackingRecordIDS[0];
	//$facilityid=$trackingRecordIDS[1];
	
	//$trackingRecord = $_mysql->getSingle('SELECT tracking.*, facility.name FROM tracking INNER JOIN facility ON tracking.facilityid = facility.facilityid WHERE tracking.scga=\''.$scga.'\' AND tracking.facilityid='.$facilityid);
	
	$trackingRecord = $_mysql->getSingle('SELECT tracking.*, facility.name FROM tracking INNER JOIN facility ON tracking.facilityid = facility.facilityid WHERE tracking.trackingid=' . $trackingStr[$i]);
	
	if(!$trackingRecord){
		$_SESSION[PREFIX . 'error'] = $_p . ':record does not exist';
		died(CLIENTROOT . '/error/');
	}
	
	array_push($trackingRecordList, $trackingRecord);
}
?>