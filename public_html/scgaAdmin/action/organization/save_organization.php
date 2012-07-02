<?php
$_mysql->makeInputsSafe();
$_POST['yoc_agreement'] 	= changeDateFormat($_POST['yoc_agreement']);
$_POST['handicap_chairman'] = changeDateFormat($_POST['handicap_chairman']);
$addressFields 				= array('address'
									, 'address2'
									, 'city'
									, 'state'
									, 'zip'
									);
$addressValues 				= array($_POST['address']
									, $_POST['address2']
									, $_POST['city']
									, $_POST['state']
									, $_POST['zip']
									);

if (isset($_POST['organizationid']) && $_POST['organizationid'] != '0') { //edit
	$organizationFields = array('name'
								, 'legal_name'
								, 'web'
								, 'phone'
								, 'fax'
								, 'yoc_agreement'
								, 'scga_club'
								, 'scga_club_code'
								, 'handicap_chairman'
								);
	
	$organizationValues = array(replaceWordChars($_POST['name'])
								, replaceWordChars($_POST['legal_name'])
								, replaceWordChars($_POST['web'])
								, $_POST['phone']
								, $_POST['fax']
								, $_POST['yoc_agreement']
								, replaceWordChars($_POST['scga_club'])
								, $_POST['scga_club_code']
								, $_POST['handicap_chairman']
								);

	$organId = $_mysql->getSingle('SELECT organizationid FROM organization WHERE organizationid = "' . $_POST['new_organizationid'] . '"');
	if ($organId) {
		if ($_POST['organizationid'] != $_POST['new_organizationid']) {
			$_SESSION['updated'] = 'Organization ID already exists';
			died(CLIENTROOT . '/organization/details');
		}
	}
	
	$addID = $_mysql->getSingle('SELECT addressid FROM organization WHERE organizationid = "' . $_POST['organizationid'] . '"');
	$_mysql->update('address', $addressFields, $addressValues, 'addressid = ' . $addID['addressid']);
	$_mysql->update('organization', $organizationFields, $organizationValues, 'organizationid = "' . $_POST['organizationid'] . '"');
	$_mysql->update('organization', array('organizationid'), array($_POST['new_organizationid']), 'organizationid = "' . $_POST['organizationid'] . '"');
	
	if ($_POST['organizationid'] != $_POST['new_organizationid']) {
		$_mysql->update('kids', array('organizationid'), array($_POST['new_organizationid']), 'organizationid = "' . $_POST['organizationid'] . '"');
		$_mysql->update('`grant`', array('organizationid'), array($_POST['new_organizationid']), 'organizationid = "' . $_POST['organizationid'] . '"');
		$_mysql->update('donation', array('organizationid'), array($_POST['new_organizationid']), 'organizationid = "' . $_POST['organizationid'] . '"');

	}
	
	$_SESSION['updated'] = 'Organization Updated';
	died(CLIENTROOT . '/organization/details?organizationid=' . $_POST['new_organizationid']);
}
else{ //add new
	$organizationFields = array('organizationid'
								, 'name'
								, 'legal_name'
								, 'web'
								, 'addressid'
								, 'phone'
								, 'fax'
								, 'yoc_agreement'
								, 'scga_club'
								, 'scga_club_code'
								, 'handicap_chairman'
								);
	
	$_mysql->insert('address', $addressFields, $addressValues);
	$addID = mysql_insert_id();
	
	$organizationValues = array($_POST['new_organizationid']
								, replaceWordChars($_POST['name'])
								, replaceWordChars($_POST['legal_name'])
								, $_POST['web']
								, $addID
								, $_POST['phone']
								, $_POST['fax']
								, $_POST['yoc_agreement']
								, replaceWordChars($_POST['scga_club'])
								, $_POST['scga_club_code']
								, $_POST['handicap_chairman']
								);
	
	$_mysql->insert('organization', $organizationFields, $organizationValues);
	
	$_SESSION['updated'] = 'Organization Added';
	died(CLIENTROOT . '/organization/main');
}
?>