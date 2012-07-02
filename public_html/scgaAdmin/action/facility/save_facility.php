<?php
$_mysql->makeInputsSafe();
$_POST['yoc_enrollment'] = changeDateFormat($_POST['yoc_enrollment']);
$addressFields = array('address'
					   , 'address2'
					   , 'city'
					   , 'state'
					   , 'zip'
					   );
$facilityFields = array('name'
						,'web'
						,'phone'
						, 'fax'
						, 'yoc_enrollment'
						, 'agreement'
						, 'yoc_green_fee'
						, 'yoc_range_fee'
						, 'guest_green_fee'
						, 'guest_range_fee'
						, 'reimbursement_green_fee'
						, 'reimbursement_range_fee'
						, 'region'
						);

$facilityValues = array(replaceWordChars($_POST['name'])
						, replaceWordChars($_POST['web'])
						, $_POST['phone']
						, $_POST['fax']
						, $_POST['yoc_enrollment']
						, replaceWordChars($_POST['agreement'])
						, $_POST['yoc_green_fee']
						, $_POST['yoc_range_fee']
						, $_POST['guest_green_fee']
						, $_POST['guest_range_fee']
						, $_POST['reimbursement_green_fee']
						, $_POST['reimbursement_range_fee']
						, $_POST['region']
						);

$addressValues = array($_POST['address']
					   , $_POST['address2']
					   , $_POST['city']
					   , $_POST['state']
					   , $_POST['zip']
					   );

if (is_numeric($_POST['facilityid']) && $_POST['facilityid'] != '0') { //edit
	$addID = $_mysql->getSingle('SELECT addressid FROM facility WHERE facilityid = ' . $_POST['facilityid']);
	$_mysql->update('address', $addressFields, $addressValues, 'addressid = ' . $addID['addressid']);
	$_mysql->update('facility', $facilityFields, $facilityValues, 'facilityid = ' . $_POST['facilityid']);
	
	$_SESSION['updated'] = 'Facility Updated';

	died(CLIENTROOT . '/facility/details');
}
else { //add new
	$_mysql->insert('address', $addressFields, $addressValues);
	$addID = mysql_insert_id();
	$_mysql->insert('facility', $facilityFields, $facilityValues);
	$facilityID = mysql_insert_id();
	$_mysql->update('facility', array('addressid'), array($addID), 'facilityid = ' . $facilityID);
	$_SESSION['updated'] = 'Facililty Added';
	died(CLIENTROOT . '/facility/main');
}
?>