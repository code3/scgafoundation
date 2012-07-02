<?
if ($_login->groupID != 1) { // only admins can upload files
	$_SESSION[PREFIX . 'error'] = $_p . ' no permission.';
	died(CLIENTROOT . '/error');
}

require 'library/php/email.php';
require 'php/formatted_emails.php';
require 'data/kids/upload_csv.php';

// validate file type
if (function_exists('finfo_open')) {
	$finfo = finfo_open(FILEINFO_MIME);
	$checkMime = finfo_file($finfo, $_FILES['filedata']['tmp_name']);
	finfo_close($finfo);
}
else if (function_exists('mime_content_type')) {
	$checkMime = mime_content_type($_FILES['filedata']['tmp_name']);
}
else {
	$checkMime = $_FILES['filedata']['type'];
}
if ($checkMime != 'text/plain') {
	$_SESSION[PREFIX]['error'] = 'File type is not supported';
	died(CLIENTROOT . '/kids/upload_csv');
}

if (empty($_FILES['filedata']['name'])) {
	trigger_error('No import file', E_USER_ERROR);
}
	
if (!is_uploaded_file($_FILES['filedata']['tmp_name'])) {
	trigger_error('Error uploading file: ' . $_FILES['filedata']['name'], E_USER_ERROR);
}

// SETUP
$certYear = $_POST['cert_year'];
$certStatus = $_POST['certification_status'];

if (!is_numeric($certYear)) {
	$_SESSION[PREFIX]['error'] = 'Please enter Certification Year';
	died(CLIENTROOT . '/kids/upload_csv');
}

if (!in_array($certStatus, $_certStatuses)) {
	$_SESSION[PREFIX]['error'] = 'Please enter Certification Status';
	died(CLIENTROOT . '/kids/upload_csv');
}
	
// validate file first
$handle = fopen($_FILES['filedata']['tmp_name'], "r");

$i = 0;
while (($data = fgetcsv($handle)) !== FALSE) {
	$kidBasicInfo = array();
	$addressInfo = array();
	
	list($kidBasicInfo['scga']
		,$kidBasicInfo['fname'] 
		,$kidBasicInfo['lname']
		,$kidBasicInfo['phone']
		,$kidBasicInfo['gender']
		,$kidBasicInfo['email']
		,$addressInfo['address']
		,$addressInfo['address2']
		,$addressInfo['city']
		,$addressInfo['state']
		,$addressInfo['zip']
		,$kidBasicInfo['dob']
		,$kidBasicInfo['handicap']
		,$kidBasicInfo['organizationid']
		 ) = $data;
	
	if ($i == 0) {
		// validate the columns
		$numColumnHeaders = count($_colummNames);
		$columnCount = 0;
		for ($columnCount = 0; $columnCount < $numColumnHeaders; $columnCount++) {
			$data[$columnCount] = prepColumnHeader($data[$columnCount]);
			if ($data[$columnCount] != $_colummNames[$columnCount]) {
				handleError('Column ' . $_letters[$columnCount] . ' should be "' . $_colummNames[$columnCount] . '" it is currently: ' . $data[$columnCount]);
			}
		}
		
		$i++;
		continue;
	}
	
	foreach ($kidBasicInfo as $field => $value) {
		$kidBasicInfo[$field] = trim($value);
	}
	
	if (empty($kidBasicInfo)) {
		$i++;
		continue;
	}
	
	// Kid basic info error checks
	if ($kidBasicInfo['scga'] == '') {
		handleError('Kid scga is missing');
	}
	
	if ($kidBasicInfo['organizationid'] == '') {
		handleError('Organization is missing');
	}
	else {
		$organization = $_mysql->getSingle('SELECT organizationid FROM organization WHERE organizationid = "' . $_mysql->makeSafe($kidBasicInfo['organizationid']) . '"');
		if (empty($organization)) {
			handleError('Organization: ' . $kidBasicInfo['organizationid'] . ' does not exist');
		}
	}
	
	if ($kidBasicInfo['gender'] != '') {
		if ($kidBasicInfo['gender'] != 'Male' && $kidBasicInfo['gender'] != 'Female') {
			handleError('Invalid gender: ' . $kidBasicInfo['gender']);
		}
	}
}
fclose($handle);

// start import
$handle = fopen($_FILES['filedata']['tmp_name'], "r");

$insertCount = 0;
$updateCount = 0;
$i = 0;
while (($data = fgetcsv($handle)) !== FALSE) {
	$kidBasicInfo = array();
	$addressInfo = array();
	
	list($kidBasicInfo['scga']
		,$kidBasicInfo['fname'] 
		,$kidBasicInfo['lname']
		,$kidBasicInfo['phone']
		,$kidBasicInfo['gender']
		,$kidBasicInfo['email']
		,$addressInfo['address']
		,$addressInfo['address2']
		,$addressInfo['city']
		,$addressInfo['state']
		,$addressInfo['zip']
		,$kidBasicInfo['dob']
		,$kidBasicInfo['handicap']
		,$kidBasicInfo['organizationid']
		 ) = $data;
	
	if ($i == 0) {
		// validate the columns
		$numColumnHeaders = count($_colummNames);
		$columnCount = 0;
		for ($columnCount = 0; $columnCount < $numColumnHeaders; $columnCount++) {
			$data[$columnCount] = prepColumnHeader($data[$columnCount]);
			if ($data[$columnCount] != $_colummNames[$columnCount]) {
				handleError('Column ' . $_letters[$columnCount] . ' should be "' . $_colummNames[$columnCount] . '" it is currently: ' . $data[$columnCount]);
			}
		}
		
		$i++;
		continue;
	}
	
	foreach ($kidBasicInfo as $field => $value) {
		$kidBasicInfo[$field] = trim($value);
	}
	
	foreach ($addressInfo as $field => $value) {
		$addressInfo[$field] = trim($value);
	}
	
	if (empty($kidBasicInfo)) {
		$i++;
		continue;
	}
	
	// Kid basic info error checks
	if ($kidBasicInfo['scga'] == '') {
		handleError('Kid scga is missing');
	}
	
	if ($kidBasicInfo['organizationid'] == '') {
		handleError('Organization is missing');
	}
	else {
		$organization = $_mysql->getSingle('SELECT organizationid FROM organization WHERE organizationid = "' . $_mysql->makeSafe($kidBasicInfo['organizationid']) . '"');
		if (empty($organization)) {
			handleError('Organization: ' . $kidBasicInfo['organizationid'] . ' does not exist');
		}
	}
	
	if ($kidBasicInfo['dob'] != '') {
		$kidBasicInfo['dob'] = date('Y-m-d', strtotime($kidBasicInfo['dob']));
	}
	
	if ($kidBasicInfo['gender'] != '') {
		if ($kidBasicInfo['gender'] != 'Male' && $kidBasicInfo['gender'] != 'Female') {
			handleError('Invalid gender: ' . $kidBasicInfo['gender']);
		}
		$kidBasicInfo['gender'] = strtoupper($kidBasicInfo['gender'][0]);
	}
	
	$addressValues = array_values($addressInfo);
	$_mysql->makeItSafe($addressValues);
	
	$kidExists = $_mysql->getSingle('SELECT scga, addressid FROM kids WHERE scga = "' . $_mysql->makeSafe($kidBasicInfo['scga']) . '"');
	if (!empty($kidExists)) { // updating
		// do NOT change the current field to the empty field
		$fields = array();
		$values = array();
		foreach ($kidBasicInfo as $field => $value) {
			if(trim($value) != ''){
				array_push($fields, $field);
				array_push($values, $value);
			}
		}
		
		if (!empty($fields)) {
			$_mysql->makeItSafe($values);
			$_mysql->update('kids', $fields, $values, 'scga = "' . $_mysql->makeSafe($kidBasicInfo['scga']) . '"');
		}
		
		// do NOT change the current field to the empty field
		$fields = array();
		$values = array();
		foreach ($addressInfo as $field => $value) {
			if(trim($value) != ''){
				array_push($fields, $field);
				array_push($values, $value);
			}
		}
		if (!empty($fields)) {
			$_mysql->makeItSafe($values);
			$_mysql->update('address', $fields, $values, 'addressid = "' . $kidExists['addressid'] . '"');
		}
		$updateCount++;
	}
	else { // adding new
		$kidBasicInfo['enrolled'] = date('Y-m-d');
		$kidBasicInfo['yoc_classification'] = 'Supervised';
		
		$insertValues = array_values($kidBasicInfo);
		$_mysql->makeItSafe($insertValues);
		
		// create login
		$loginID = $_login->createLogin($kidBasicInfo['scga'], 'password', 4);
		
		// insert kid
		$_mysql->insert('kids', array_keys($kidBasicInfo), $insertValues);
		
		// insert address
		$_mysql->insert('address', array_keys($addressInfo), $addressValues);
		$addID = mysql_insert_id();
		$_mysql->update('kids', array('loginid', 'addressid'), array($loginID, $addID), 'scga = "' . $_mysql->makeSafe($kidBasicInfo['scga']) . '"');
		
		// insert certification, do not set date certified
		$_mysql->insert('certification', array('scga', 'year', 'certification_status'), array($_mysql->makeSafe($kidBasicInfo['scga']), $certYear, $certStatus));
		
		// add entry in quiz table
		$_mysql->insert('quiz', array('scga'), array($_mysql->makeSafe($kidBasicInfo['scga'])));
		
		$newKid = $_mysql->getSingle('SELECT kids.scga, kids.fname, kids.lname, kids.email, organization.name, organization.scga_club FROM kids INNER JOIN organization ON kids.organizationid = organization.organizationid WHERE kids.scga = "' . $_mysql->makeSafe($kidBasicInfo['scga']) . '"');
		if(!empty($newKid)){
			if($certStatus == 'Certified by Program'){
				// disable for now
				sendCertifiedByProgramEmail($newKid);
			}
			else if($certStatus == 'Not certified'){
				// disable for now
				sendNotCertifiedEmail($newKid);
			}
		}
		
		$insertCount++;
	}
	
	if($kidBasicInfo['dob'] == ''){
		$_mysql->query('UPDATE kids SET dob = NULL WHERE scga = "' . $_mysql->makeSafe($kidBasicInfo['scga']) . '"', 'Custom');
	}
	
	$i++;
}
fclose($handle);

function handleError($error) {
	global $i;
	$error = $error . ' (on line ' . ($i + 1) . ')';
	$_SESSION[PREFIX]['error'] = $error;
	died(CLIENTROOT . '/kids/upload_csv');
}

function prepColumnHeader($colName) {
	$colName = trim($colName);
	$colName = preg_replace('/\s\s+/', ' ', $colName);
	return $colName;
}

$_SESSION[PREFIX]['success'] = $insertCount . ' kids added, ' . $updateCount . ' kids updated';
died(CLIENTROOT . '/kids/upload_csv');
?>