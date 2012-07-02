<?
//save users action into session
userActionHistory(array('p', 'k', 'organizationid'), 'kids');

if ($_login->groupID == 1) {
	$_isAdmin = true;
}

$year = date('Y');
$_newYear = $year + 1;
$_title = 'Kids';

// print_r($_GET);

//for exporting to excel
$_excel_cols = array('scga' => 'SCGA'
					 , 'fname' => 'First Name'
					 , 'lname' => 'Last Name'
					 , 'gender' => 'Gender'
					 , 'email' => 'Email'
					 , 'address' => 'Address'
					 , 'address2' => 'Address2'
					 , 'city' => 'City'
					 , 'state' => 'State'
					 , 'zip' => 'Zip'
					 , 'dob' => 'Birth Date'
					 , 'enrolled' => 'Enrollment Date'
					 , 'ethnicity' => 'Ethnicity'
					 , 'handicap' => 'Handicap'
					 , 'name' => 'Organization'
					 , 'scga_club' => 'Club'
					 , 'golf_certified_formatted' => 'Golf Certified'
					 , 'game_club_formatted' => 'Game Club'
					 , 'certification' => 'Certification Years'
					 , 'yoc_classification' => 'YOC Classification'
					 );

$kidsTab = 'kids';
$queryFlag = false;
$getStr = "DISTINCT $kidsTab.*, IF(kids.golf_certified = 1, \"Yes\", \"No\") AS golf_certified_formatted, IF(kids.game_club = 1, \"Yes\", \"No\") AS game_club_formatted, DATE_FORMAT(NOW(), \"%Y\") - DATE_FORMAT(kids.dob, \"%Y\") - (DATE_FORMAT(NOW(), \"00-%m-%d\") < DATE_FORMAT(kids.dob, \"00-%m-%d\")) AS kidAge, organization.name, organization.scga_club, organization.organizationid,address.*, certification.year, certification.certification_status, CASE certification.date_certified WHEN NULL THEN \"\" WHEN \"0000-00-00\" THEN \"\" ELSE certification.date_certified END AS date_certified ";

$tableStr = $kidsTab . ' LEFT JOIN organization ON ' . $kidsTab . '.organizationid = organization.organizationid LEFT JOIN address ON kids.addressid=address.addressid';
if (isset($_GET['organizationid'])) {// get all kids in an organization
	$where = "$kidsTab.organizationid = '" . $_GET['organizationid'] . "'"; 
	// $tableStr .= ' LEFT JOIN certification ON (kids.scga = certification.scga AND certification.year = "' . $_newYear . '")';
  $tableStr .= ' LEFT JOIN certification ON (kids.scga = certification.scga)';
	$countInfo = $_mysql->get("SELECT count($kidsTab.scga) AS kidsCnt FROM $tableStr WHERE $where");
	$numOfItem =  $countInfo[0]['kidsCnt'];
}
else if ($_GET['search']) { // get tracking base on search
	$whereList = array(1);
	$onList = array();
	
	$scga = $_mysql->makeSafe(trim($_GET['scga']));
	$dateMin = $_mysql->makeSafe(trim($_GET['date_min']));
	$dateMax = $_mysql->makeSafe(trim($_GET['date_max']));
	$enrolledMin = $_mysql->makeSafe(trim($_GET['enrolled_min']));
	$enrolledMax = $_mysql->makeSafe(trim($_GET['enrolled_max']));
	$fname = $_mysql->makeSafe(trim($_GET['fname']));
	$lname = $_mysql->makeSafe(trim($_GET['lname']));
	$organization = $_mysql->makeSafe(trim($_GET['organization']));
	$golfCertified = $_mysql->makeSafe(trim($_GET['golf_certified']));
	$gameClub = $_mysql->makeSafe(trim($_GET['game_club']));
	
	$certificationYear=$_mysql->makeSafe(trim($_GET['year']));
	$certificationStatus=$_mysql->makeSafe(trim($_GET['certification_status']));
	$certificationStatus2=$_mysql->makeSafe(trim($_GET['certification_status2']));
	$dateCertifiedMin = $_mysql->makeSafe(trim($_GET['date_certified_min']));
	$dateCertifiedMax = $_mysql->makeSafe(trim($_GET['date_certified_max']));
	
	//validate string lengths
	if (isset($scga[MAXLENB])) {
		$_SESSION[PRFIX.'error'] = $_p . ' -  SCGA is too long';
	}
	
	if (isset($organization[MAXLENB])) {
		$_SESSION[PRFIX.'error'] = $_p . ' -  organization name is too long';
	}
	
	if (isset($fname[MAXLENB])) {
		$_SESSION[PRFIX.'error'] = $_p . ' -  first name is too long';
	}
	
	if (isset($lname[MAXLENB])) {
		$_SESSION[PRFIX.'error'] = $_p . ' -  last name is too long';
	}
	
	if (isset($_SESSION[PRFIX.'error'])) {
		died(CLIENTROOT.'/error/');
	}
	
	if ($dateMin != '') {
		$dateMin = changeDateFormat($dateMin); 
		array_push($whereList, "$kidsTab.dob >= '$dateMin'");
	} 
	
	if ($dateMax != '') {
		$dateMax = changeDateFormat($dateMax); 
		array_push($whereList, "$kidsTab.dob <= '$dateMax'");
	}
	
	if ($enrolledMin != '') {
		$enrolledMin = changeDateFormat($enrolledMin); 
		array_push($whereList, "$kidsTab.enrolled >= '$enrolledMin'");
	} 
	
	if ($enrolledMax != '') {
		$enrolledMax = changeDateFormat($enrolledMax); 
		array_push($whereList, "$kidsTab.enrolled <= '$enrolledMax'");
	} 
	
	if ($fname != '') {
		array_push($whereList, "$kidsTab.fname LIKE '%$fname%'");
	}
	
	if ($lname != '') {
		array_push($whereList, "$kidsTab.lname LIKE '%$lname%'");
	} 
	
	if ($scga != '') {
		array_push($whereList, "$kidsTab.scga LIKE '%$scga%'");
	}

	if ($organization != '') {
		array_push($whereList, "organization.name LIKE '%$organization%'");
	}
	
	if ($golfCertified != '') {
		array_push($whereList, "$kidsTab.golf_certified = '$golfCertified'");
	}
	
	if ($gameClub != '') {
		array_push($whereList, "$kidsTab.game_club = '$gameClub'");
	}
	
	if ($certificationYear != '') {
		array_push($whereList, "certification.year = '$certificationYear'");
	}
	
	
	if ($dateCertifiedMin != '') {
		$dateCertifiedMin = changeDateFormat($dateCertifiedMin); 
		array_push($whereList, "(certification.date_certified IS NOT NULL AND certification.date_certified >= '$dateCertifiedMin')");
	} 
	
	if ($dateCertifiedMax != '') {
		$dateCertifiedMax = changeDateFormat($dateCertifiedMax); 
		array_push($whereList, "(certification.date_certified IS NULL OR certification.date_certified <= '$dateCertifiedMax')");
	} 
	
	
	if ($certificationStatus != '' && $certificationStatus2 == '') {
		array_push($whereList, "certification.certification_status = '$certificationStatus'");
	}
	else if ($certificationStatus == '' && $certificationStatus2 != '') {
		array_push($whereList, "certification.certification_status = '$certificationStatus2'");
	}
	else if ($certificationStatus != '' && $certificationStatus2 != '') {
		array_push($whereList, "(certification.certification_status = '$certificationStatus' OR certification.certification_status  = '$certificationStatus2')");
	}
	
	if ($certificationYear != '' || $certificationStatus != '' || $certificationStatus2 != '' || $dateCertifiedMin != '' || $dateCertifiedMax != '') {
	/*if ($certificationYear != '' || $certificationStatus != '' || $certificationStatus2 != '' ) {*/
		$tableStr .= ' INNER JOIN certification ON kids.scga = certification.scga';
	}
	else {
		$tableStr .= ' LEFT JOIN certification ON (kids.scga = certification.scga)';
	}
		
	unset($fieldList);
	
	if (isset($_SESSION[PRFIX.'error'])) {
		died(CLIENTROOT.'/error/');
	}
	
	if (count($onList) > 0) {
		$tableStr .= ' ON '. implode(' AND ', $onList);
	}
	
	if (isset($whereList[0])) {
		$where = implode(' AND ', $whereList);
	}
		
	$countInfo = $_mysql->get("SELECT count($kidsTab.scga) AS kidsCnt FROM $tableStr WHERE $where");
}	
else {
	$where = 1;
	$tableStr .= ' LEFT JOIN certification ON (kids.scga = certification.scga)';
	$countInfo = $_mysql->get("SELECT count($kidsTab.scga) AS kidsCnt FROM $tableStr");
	$numOfItem =  $countInfo[0]['kidsCnt'];
}
$orderStr = 'ORDER BY certification.year DESC';
$descStr = '';

$sortList = array('kids.scga'
				  , 'kids.fname'
				  , 'kids.lname'
				  , 'kidAge'
				  , 'organization.name'
				  , 'kids.yoc_classification'
				  , 'kids.golf_certified'
				  , 'kids.game_club'
				  , 'certification.certification_status'
				  , 'certification.date_certified'
				  );

if (in_array($_GET['sort_field'], $sortList)) {
	$orderStr = 'ORDER BY '.$_GET['sort_field'];
}
if ($_GET['sort_desc'] == 1) {
	$descStr = ' DESC';
}

// querys for exporting
$_query = 'SELECT ' . $getStr . ' FROM ' . $tableStr . ' WHERE ' . $where . ' ' . $orderStr . $descStr;


$countInfo = $_mysql->get("SELECT COUNT(*) AS count FROM $tableStr WHERE $where $orderStr" . $descStr);
if ($countInfo) {
	$numOfItem = $countInfo[0]['count'];
	$_pl = new pageLinks(10, $numOfItem);
}
else {
	$numOfItem =  0;
	$_pl = new pageLinks(10, $numOfItem);
}

$_kids = $_mysql->get("SELECT $getStr FROM $tableStr WHERE $where $orderStr" . $descStr . " LIMIT " . $_pl->limit);

unset($getStr, $tableStr, $where, $orderStr, $descStr);

?>