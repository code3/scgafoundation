<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
$_title = 'Facility';
$_regions = array('Coachella Valley', 'Inland Empire', 'Central Coast', 'San Diego', 'Los Angeles', 'Orange County', 'Ventura/Oxnard', 'Kern County');

//save users action into session

userActionHistory(array('p', 'k'), 'facility');

//for exporting to excel
$_excel_cols = array(
	'name'=>'Name',
	'region'=>'Region',
	'address'=>'Address',
	'address2'=>'Address 2',
	'city'=>'City',
	'state'=>'State',
	'zip'=>'Zip',
	'country'=>'Country',
	'phone'=> 'Phone',
	'fax'=>'Fax',
	'yoc_enrollment'=>'YOC Enrollment Date',
	'yoc_green_fee'=>'YOC Green Fee',
	'yoc_range_fee'=>'YOC Range Fee',
	'guest_green_fee'=>'Guest Green Fee',
	'guest_range_fee'=>'Guest Range Fee',
	'reimbursement_green_fee'=>'Reimbursement Green Fee',
	'reimbursement_range_fee'=>'Reimbursement Range Fee',
	'contacts' => 'Contacts'
	);



$facilityTab = 'facility';

$queryFlag = false;
$getStr = "$facilityTab.facilityid, $facilityTab.name, $facilityTab.region, $facilityTab.yoc_enrollment, $facilityTab.phone";

$tableStr = $facilityTab;
if(is_numeric($_GET['facilityid'])){// get single facility
	$where = "$facilityTab.facilityid = ".$_GET['facilityid']; 
	$numOfItem = 1;
}

else if($_GET['search']){ // get facilities base on search
	
	$whereList = array(1);
	$onList = array();
	
	$facilityName = $_mysql->makeSafe(trim($_GET['name']));
	$dateMin = $_mysql->makeSafe(trim($_GET['enrolled_min']));
	$dateMax = $_mysql->makeSafe(trim($_GET['enrolled_max']));
	$region = $_mysql->makeSafe(trim($_GET['region']));
	
	//validate string lengths
	if(isset($facilityName[MAXLENB])){
		$_SESSION[PRFIX.'error'] = $p.' -  1';
	}
	if(isset($_SESSION[PRFIX.'error'])){
		died(CLIENTROOT.'/error/');
	}
	
	if($dateMin!= ''){
		$dateMin = changeDateFormat($dateMin); 
		array_push($whereList, "$facilityTab.yoc_enrollment >= '$dateMin'");
	} 
	
	if($dateMax!= ''){
		$dateMax = changeDateFormat($dateMax); 
		array_push($whereList, "$facilityTab.yoc_enrollment <= '$dateMax'");
	} 
	if($region!= ''){
		array_push($whereList, "$facilityTab.region = '$region'");
	} 
	
	if($facilityName != ''){
		array_push($whereList, "$facilityTab.name LIKE '%$facilityName%'");
	}
	
		
	unset($fieldList);
	
	if(isset($_SESSION[PRFIX.'error'])){
		died(CLIENTROOT.'/error/');
	}
	
	if(count($onList)>0){
		$tableStr .= ' ON '. implode(' AND ', $onList);
	}
	if(isset($whereList[0])){
		$where = implode(' AND ', $whereList);
	}
	$countInfo = $_mysql->get("SELECT count($facilityTab.facilityid) AS facilityCnt FROM  $tableStr WHERE $where");

	$numOfItem =  $countInfo[0]['facilityCnt'];
}	
else{
	$where = 1;
	$countInfo = $_mysql->get("SELECT count($facilityTab.facilityid) AS facilityCnt FROM  $tableStr");
	$numOfItem =  $countInfo[0]['facilityCnt'];
}

$_pl = new pageLinks(10, $numOfItem);

//$orderStr = 'ORDER BY facilityid';
$orderStr = 'ORDER BY facility.name';
$descStr = '';

$sortList = array('facility.facilityid','facility.name', 'facility.region', 'facility.yoc_enrollment', 'facility.phone');
if(in_array($_GET['sort_field'], $sortList)){
	$orderStr = 'ORDER BY '.$_GET['sort_field'];
}
if($_GET['sort_desc'] == 1){
	$descStr = ' DESC';
}

// querys for exporting
$_query = 'SELECT facility.*, address.* FROM facility INNER JOIN address ON facility.addressid = address.addressid WHERE '.$where.' '.$orderStr.$descStr;

$_facilities = $_mysql->get("SELECT $getStr FROM $tableStr WHERE $where $orderStr".$descStr." LIMIT ".$_pl->limit);

unset($getStr, $tableStr, $where, $orderStr, $descStr);

?>