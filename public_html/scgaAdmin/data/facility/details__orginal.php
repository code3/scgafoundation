<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
else{
	$disable = 'disabled="disabled"';
}
require 'library/php/states.php';
userActionHistory(array('p', 'k'), 'facilityDetails');
$_title = 'Facility Details';
$_regions = array('Coachella Valley', 'Inland Empire', 'Central Coast', 'San Diego', 'Los Angeles', 'Orange County', 'Ventura/Oxnard', 'Kern County');

if(is_numeric($_GET['facilityid']) && $_GET['facilityid'] != '0'){
	$_facility = $_mysql->getSingle('SELECT facility.*, address.* FROM facility INNER JOIN address ON facility.addressid = address.addressid WHERE facilityid = '.$_GET['facilityid']);
	
	$_facility['yoc_enrollment'] = changeDateFormat($_facility['yoc_enrollment'] );
	
}
$_GET['note_area'] = 'facility';
$_GET['note_areaid'] = $_GET['facilityid'];
$_GET['noteid'] = $_facility['noteid'];


$_GET['contact_area'] = 'facility';
$_GET['contact_areaid'] = $_GET['facilityid'];
$_GET['contactid'] = $_facility['contactid'];
require('data/note.php');
require('data/contact.php');
?>