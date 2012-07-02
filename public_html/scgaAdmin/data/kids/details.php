<?
require 'library/php/states.php';
userActionHistory(array('p', 'k'), 'kidsDetails');

if ($_login->groupID == 1) {
	$_isAdmin = true;
}
else {
	$disable = 'disabled="disabled"';
}

$_kid = $_mysql->getSingle('SELECT kids.*, address.*, organization.name, DATE_FORMAT(NOW(), "%Y") - DATE_FORMAT(kids.dob, "%Y") - (DATE_FORMAT(NOW(), "00-%m-%d") < DATE_FORMAT(kids.dob, "00-%m-%d")) AS kidAge FROM kids INNER JOIN address ON kids.addressid = address.addressid INNER JOIN organization ON kids.organizationid = organization.organizationid WHERE kids.scga = "' . $_GET['scga'] . '"');
if (!$_kid) {
	$_SESSION[PREFIX . 'error'] = $p . ' - data/kids/details-no record exists';
	died(CLIENTROOT . '/error/');
}

$_certifications = $_mysql->get('SELECT * FROM certification WHERE scga = "' . $_GET['scga'] . '" ORDER BY certificationid');
$_quizzes = $_mysql->getSingle('SELECT * FROM quiz WHERE scga = "' . $_GET['scga'] . '"');

$_GET['note_area'] = 'kids.noteid.scga';
$_GET['note_areaid'] = $_GET['scga'];
$_GET['noteid'] = $_kid['noteid'];

require('data/note.php');
?>