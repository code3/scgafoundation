<?
if( $_login->groupID==1){
	$_isAdmin=true;https://box208.bluehost.com:2083/frontend/bluehost/filemanager/editit.html?file=details.php&fileop=&dir=%2Fhome1%2Fscgafoun%2Fpublic_html%2FscgaAdmin%2Fdata%2Ffacility&dirop=&charset=&file_charset=_DETECT_&baseurl=&basedir=&codeedit=1
}
else{
	$disable = 'disabled="disabled"';https://box208.bluehost.com:2083/frontend/bluehost/filemanager/editit.html?file=details.php&fileop=&dir=%2Fhome1%2Fscgafoun%2Fpublic_html%2FscgaAdmin%2Fdata%2Ffacility&dirop=&charset=&file_charset=_DETECT_&baseurl=&basedir=&codeedit=1
}
require 'library/php/states.php';https://box208.bluehost.com:2083/frontend/bluehost/filemanager/editit.html?file=details.php&fileop=&dir=%2Fhome1%2Fscgafoun%2Fpublic_html%2FscgaAdmin%2Fdata%2Ffacility&dirop=&charset=&file_charset=_DETECT_&baseurl=&basedir=&codeedit=1

userActionHistory(array('p', 'k'), 'facilityDetails');
$_title = 'Facility Details';
$_regions = array('Kern', 'Los Angeles', 'Orange', 'Riverside', 'San Bernadino', 'San Diego',  'San Luis Obispo', 'Santa Barbara', 'Ventura', 'Imperial');

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