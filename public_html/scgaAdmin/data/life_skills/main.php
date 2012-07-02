<?
if( $_login->groupID==1){
	$_isAdmin=true;
}
 
if(!is_numeric($_GET['year'])){
	$_GET['search'] = NULL;
}
else{
	$where = 'certification.year = '.$_GET['year'].' ';
}
if ($_GET['status'] != 'Pending' && $_GET['status'] != 'Under Review' && $_GET['status'] != 'Passed' && $_GET['status'] != 'Revise'){
}
else{
	$where .= 'AND lifeSkillsStatus = "'.$_GET['status'].'" ';
}
//userActionHistory(array('p'), 'lifeSkills');
if($_GET['search']){ 
	$orderStr = 'ORDER BY scga,certification.certification_status';
	$descStr = '';
	
	$sortList = array('kids.scga','kids.fname', 'kids.lname', 'kids.grade', 'year','certification.certification_status','organization.name');
	if(in_array($_GET['sort_field'], $sortList)){
		$orderStr = 'ORDER BY '.$_GET['sort_field'];
	}
	if($_GET['sort_desc'] == 1){
		$descStr = ' DESC';
	}
	//$where = 'lifeSkillsStatus = "'.$_GET['status'].'" AND certification.year = '.$_GET['year'].' ';
	$_kids = $_mysql->get('SELECT kids.*, quiz.lifeSkillsStatus, quiz.lifeSkills,certification.year, certification.certification_status, organization.name FROM kids INNER JOIN quiz ON kids.scga = quiz.scga INNER JOIN certification ON kids.scga = certification.scga INNER JOIN organization ON kids.organizationid=organization.organizationid WHERE '.$where. $orderStr.$descStr);
}

if($_GET['year'] == '' && $_GET['status'] == '' ){
	// $_GET['year'] = date('Y');
  $_GET['year'] = '2012';
	$_GET['status'] = 'Under Review';
	$where = 'certification.year = '.$_GET['year'].' ';
	$where .= 'AND lifeSkillsStatus = "'.$_GET['status'].'" ';
	$_kids = $_mysql->get('SELECT kids.*, quiz.lifeSkillsStatus, quiz.lifeSkills,certification.year, certification.certification_status, organization.name FROM kids INNER JOIN quiz ON kids.scga = quiz.scga INNER JOIN certification ON kids.scga = certification.scga INNER JOIN organization ON kids.organizationid=organization.organizationid WHERE '.$where. $orderStr.$descStr);
}


?>