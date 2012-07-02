<?
if($_login->groupID == 1){
	$_isAdmin = true;
}
$_title 	= 'Organization';
$_regions 	= array('Coachella Valley', 'Inland Empire', 'Central Coast', 'San Diego', 'Los Angeles', 'Orange County', 'Ventura/Oxnard');

//save users action into session
userActionHistory(array('p', 'k'), 'organization');

//for exporting to excel
$_excel_cols = array(
	'name'=>'Name',
	'legal_name'=>'Legal Name',
	'web'=>'Web Address',
	'address'=>'Address',
	'address2'=>'Address 2',
	'city'=>'City',
	'state'=>'State',
	'zip'=>'Zip',
	'country'=>'Country',
	'phone'=> 'Phone',
	'fax'=> 'Fax',
	'yoc_agreement' => 'YOC Agreement Date',
	'scga_club' => 'SCGA Club Name',
	'scga_club_code'=>'SCGA Club Code',
	'handicap_chairman' => 'Handicap Chairman Date',
	'contacts' => 'Contacts',
	'grants' => 'Grants',
	'donations' => 'Donations'
	
	);

$organizationTab 	= 'organization';
$queryFlag 			= false;
$getStr 			= "$organizationTab.organizationid, $organizationTab.name, $organizationTab.phone";
$tableStr 			= $organizationTab;
if(isset($_GET['organizationid'])){ // get single organization
	$where 		= "$organizationTab.organizationid = '" . $_GET['organizationid'] . "'"; 
	$numOfItem 	= 1;
}

else if($_GET['search']){ // get facilities base on search
	
	$whereList 				= array(1);
	$onList 				= array();
	$organizationName 		= $_mysql->makeSafe(trim($_GET['name']));
	$organizationLegalName 	= $_mysql->makeSafe(trim($_GET['legal_name']));
	$agreementDateMin 		= $_mysql->makeSafe(trim($_GET['yoc_agreement_min']));
	$agreementDateMax 		= $_mysql->makeSafe(trim($_GET['yoc_agreement_max']));
		
	//validate string lengths
	if(isset($organizationName[MAXLENB])){
		$_SESSION[PREFIX . 'error'] = $_p . ' organiztion name is too long';
	}
	if(isset($organizationLegalName[MAXLENB])){
		$_SESSION[PREFIX . 'error'] = $_p . ' -  organiztion legal name is too long';
	}
	
	if(isset($_SESSION[PREFIX . 'error'])){
		died(CLIENTROOT . '/error/');
	}
	
	if($agreementDateMin != ''){
		$agreementDateMin = changeDateFormat($agreementDateMin); 
		array_push($whereList, "$organizationTab.yoc_agreement >= '$agreementDateMin'");
	} 
	
	if($agreementDateMax != ''){
		$agreementDateMax = changeDateFormat($agreementDateMax); 
		array_push($whereList, "$organizationTab.yoc_agreement <= '$agreementDateMax'");
	} 
	
	if($organizationName != ''){
		array_push($whereList, "$organizationTab.name LIKE '%$organizationName%'");
	}
	if($organizationLegalName != ''){
		array_push($whereList, "$organizationTab.legal_name LIKE '%$organizationLegalName%'");
	}
	
	unset($fieldList);
	
	if(isset($_SESSION[PREFIX . 'error'])){
		died(CLIENTROOT . '/error/');
	}
	
	if(count($onList) > 0){
		$tableStr .= ' ON ' . implode(' AND ', $onList);
	}
	if(isset($whereList[0])){
		$where = implode(' AND ', $whereList);
	}
	$countInfo = $_mysql->get("SELECT count($organizationTab.organizationid) AS organizationCnt FROM  $tableStr WHERE $where");

	$numOfItem =  $countInfo[0]['organizationCnt'];
}	
else{
	$where 		= 1;
	$countInfo 	= $_mysql->get("SELECT count($organizationTab.organizationid) AS organizationCnt FROM  $tableStr");
	$numOfItem 	=  $countInfo[0]['organizationCnt'];
}

$_pl = new pageLinks(10, $numOfItem);

$orderStr 	= 'ORDER BY organizationid';
$descStr 	= '';
$sortList 	= array('organization.organizationid','organization.name', 'organization.phone');
if(in_array($_GET['sort_field'], $sortList)){
	$orderStr = 'ORDER BY ' . $_GET['sort_field'];
}
if($_GET['sort_desc'] == 1){
	$descStr = ' DESC';
}

// querys for exporting
$_query 		= 'SELECT organization.*, address.* FROM organization INNER JOIN address ON organization.addressid = address.addressid WHERE ' . $where . ' ' . $orderStr . $descStr;

$_organizations = $_mysql->get("SELECT $getStr FROM $tableStr WHERE $where $orderStr" . $descStr . " LIMIT " . $_pl->limit);
//to find the number of kids in each organization
$_kids 			= array();
if($_organizations){
	foreach($_organizations as $organization){
		$numKids = $_mysql->get('SELECT scga FROM kids WHERE kids.organizationid = \'' . $organization['organizationid'] . '\'');
		if(!$numKids){
			array_push($_kids, 0);
		}
		else{
			array_push($_kids, count($numKids));
		}
	}
}
unset($getStr, $tableStr, $where, $orderStr, $descStr);
?>