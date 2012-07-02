<?
if($_login->groupID == 1){
	$_isAdmin = true;
	$disable = '';
}
else{
	$disable = 'disabled="disabled"';
}
require 'library/php/states.php';
userActionHistory(array('p', 'k'), 'organizationDetails');
$_title = 'Organization Details';

if(isset($_GET['organizationid']) && $_GET['organizationid'] != '0'){
	$_organization 						= $_mysql->getSingle('SELECT organization.*, address.* FROM organization INNER JOIN address ON organization.addressid = address.addressid WHERE organizationid = \'' . $_GET['organizationid'] . '\'');
	$_organization['yoc_agreement'] 	= changeDateFormat($_organization['yoc_agreement'] );
	$_organization['handicap_chairman'] = changeDateFormat($_organization['handicap_chairman']);
	$_grants 							= $_mysql->get('SELECT * FROM `grant` WHERE organizationid = \'' . $_GET['organizationid'] . '\' ORDER BY grantid');
	$_donations 						= $_mysql->get('SELECT * FROM donation WHERE organizationid = \'' . $_GET['organizationid'] . '\' ORDER BY donationid');
}
$_GET['note_area'] 		= 'organization';
$_GET['note_areaid'] 	= $_GET['organizationid'];
$_GET['noteid'] 		= $_organization['noteid'];
$_GET['contact_area'] 	= 'organization';
$_GET['contact_areaid'] = $_GET['organizationid'];
$_GET['contactid'] 		= $_organization['contactid'];
require('data/note.php');
require('data/contact.php');
?>