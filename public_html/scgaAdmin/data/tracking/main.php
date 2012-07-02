<?
if( $_login->groupID == 1){
	$_isAdmin = true;
}
if($_login->groupID == 2 ){
	$_isAssistant = true;
}

$_title = 'YOC Tracking';
//save users action into session

userActionHistory(array('p', 'k'), 'tracking');

//for exporting to excel
$_excel_cols = array(
	'fname' => 'Kid First Name',
	'lname' => 'Kid Last Name',
	'scga' => 'SCGA',
	'date' => 'Date',
	'type' => 'Type',
	'name' => 'Facility',
	'region' => 'Region',
	'organizationName' => 'Organization',
	);

$trackingTab 	= 'tracking';
$queryFlag 		= false;
$getStr 		= "$trackingTab.*, facility.name, kids.fname, kids.lname, kids.organizationid, organization.name AS organizationName";

$tableStr 		= $trackingTab . ' INNER JOIN facility ON ' . $trackingTab . '.facilityid = facility.facilityid INNER JOIN kids ON tracking.scga = kids.scga INNER JOIN organization ON kids.organizationid=organization.organizationid';
if(is_numeric($_GET['facilityid'])){// get single tracking
	$where 		= "$facilityTab.facilityid = " . $_GET['facilityid']; 
	$numOfItem 	= 1;
}

else if($_GET['search']){ // get tracking base on search
	
	$whereList 	= array(1);
	$onList 	= array();
	
	$scga 		= $_mysql->makeSafe(trim($_GET['scga']));
	$dateMin 	= $_mysql->makeSafe(trim($_GET['date_min']));
	$dateMax 	= $_mysql->makeSafe(trim($_GET['date_max']));
	$type 		= $_GET['type'];
	$facility 	= $_mysql->makeSafe(trim($_GET['facility']));
	//validate string lengths
	if(isset($scga[MAXLENB])){
		$_SESSION[PRFIX . 'error'] = $_p . ' -  1';
	}
	if(isset($_SESSION[PRFIX . 'error'])){
		died(CLIENTROOT . '/error/');
	}
	
	if($dateMin	!= ''){
		$dateMin = changeDateFormat($dateMin); 
		array_push($whereList, "$trackingTab.date >= '$dateMin'");
	} 
	
	if($dateMax != ''){
		$dateMax = changeDateFormat($dateMax); 
		array_push($whereList, "$trackingTab.date <= '$dateMax'");
	} 
	if($type != ''){
		array_push($whereList, "$trackingTab.type = '$type'");
	} 
	
	if($scga != ''){
		array_push($whereList, "$trackingTab.scga LIKE '%$scga%'");
	}
	if($facility != ''){
		array_push($whereList, "facility.name LIKE '%$facility%'");
	}
		
	unset($fieldList);
	
	if(isset($_SESSION[PRFIX . 'error'])){
		died(CLIENTROOT . '/error/');
	}
	
	if(count($onList) > 0){
		$tableStr .= ' ON ' . implode(' AND ', $onList);
	}
	if(isset($whereList[0])){
		$where = implode(' AND ', $whereList);
	}
	$countInfo = $_mysql->get("SELECT count($trackingTab.scga) AS trackingCnt FROM $tableStr WHERE $where");

	$numOfItem =  $countInfo[0]['trackingCnt'];
}	
else{
	$where 		= 1;
	$countInfo 	= $_mysql->get("SELECT count($trackingTab.scga) AS trackingCnt FROM $tableStr");
	$numOfItem 	=  $countInfo[0]['trackingCnt'];
}

$_pl 		= new pageLinks(10, $numOfItem);
$orderStr 	= 'ORDER BY tracking.date DESC, tracking.scga';
$descStr 	= '';
$sortList 	= array('kids.fname', 'kids.lname', 'tracking.scga', 'facility.name', 'tracking.type', 'tracking.date');
if(in_array($_GET['sort_field'], $sortList)){
	$orderStr = 'ORDER BY ' . $_GET['sort_field'];
}
if($_GET['sort_desc'] == 1){
	$descStr = ' DESC';
}

// querys for exporting
$_query = 'SELECT tracking.*, facility.name, facility.region, kids.fname, kids.lname,kids.organizationid, organization.name AS organizationName FROM tracking INNER JOIN facility ON tracking.facilityid = facility.facilityid INNER JOIN kids ON tracking.scga = kids.scga  INNER JOIN organization ON kids.organizationid=organization.organizationid WHERE ' . $where . ' ' . $orderStr . $descStr;

$_trackings = $_mysql->get("SELECT $getStr FROM $tableStr WHERE $where $orderStr" . $descStr . " LIMIT " . $_pl->limit);

unset($getStr, $tableStr, $where, $orderStr, $descStr);

?>