<?
if ($_login->groupID != 1) {
	died(CLIENTROOT . '/error');
}

$_mysql->makeInputsSafe();

if (!is_numeric($_GET['year'])) {
	died(CLIENTROOT . '/error');
}

$year = $_GET['year'] - 1; //2009
$newYear = $_GET['year']; //2010 (new year)
$date = date('Y-m-d');

/* if they already have a certification for this year, then don't override it, just leave it, 
	otherwise if no certification record currently exists for this year for this student, duplicate 
	the previous years status. If no certification exists for the previous year, default to "Not certified" */

require_once($_SERVER['DOCUMENT_ROOT'] . '/z_my_processes/includes/external-scripts.php');
 
 /***********SQL DUMPS - WORING*****************/
 $dumpPath = $_SERVER['DOCUMENT_ROOT'] . '/z_my_processes/sql-dumps/original-reset/';
backUpDBTable($host=MYSQLHOST,$user=MYSQLUSER,$pass=MYSQLPASS,$database=MYSQLDB, $tableName='certification', $dumpPath);
backUpDBTable($host=MYSQLHOST,$user=MYSQLUSER,$pass=MYSQLPASS,$database=MYSQLDB, $tableName='quiz', $dumpPath);
backUpDBTable($host=MYSQLHOST,$user=MYSQLUSER,$pass=MYSQLPASS,$database=MYSQLDB, $tableName='kids', $dumpPath);

//exit;
/*************
want the years to remain). It appears that all of the years (2008, 2009, 2010, 2011)
were converted to 2012. We instead want anyone that had a 2011 status to have their
answers deleted and have a 2012 not certified entry created/added. We did not want anyone
prior to 2011 to have a 2012 entry and we wanted to retain all years/certifications.
**************/


$kids = $_mysql->get('SELECT kids.scga FROM kids');

foreach ($kids as $kid) {
	
	
$scga = is_numeric($kid['scga']) ? $kid['scga'] : '';

 	 
	if(!empty($scga)){

/**************************************************************************/	
/******UPDATE KIDS TABLE TO INACTIVE***************************************/
/**************************************************************************/
$tableStr = 'kids';
$fieldList= array('status', 'participant_pledge');
$valueList = array('inactive', 0); 
$whereStr = 'scga = "' . $_mysql->makeSafe($kid['scga'])  . '"';
 
 	 
$updateKidStatus = $_mysql->update( $tableStr, $fieldList, $valueList, $whereStr ); 

	
	
	///////////////////////////
	
	$prevYearCertExist = $_mysql->getSingle('SELECT certification.scga, certification.certification_status FROM certification WHERE scga = "' . $_mysql->makeSafe($kid['scga']) . '" AND year = "' . $year . '"');
	
	if ($prevYearCertExist) {
		$newStatus = 'Not certified'; //because all new inserts have to be not certified regardless of previous year cert status
		//$newStatus = $prevYearCertExist['certification_status'];
	}
	else {
		$newStatus = 'Not certified';
	}
	
	//query to see if new certification record with new year
    $newYearCertExist = $_mysql->getSingle('SELECT certification.scga, certification.certification_status FROM certification WHERE scga = "' . $_mysql->makeSafe($kid['scga']) . '" AND year = "' . $newYear . '"');
	
	//if new certification status with new year does not exist add it
	if (!$newYearCertExist) {
		$_mysql->insert('certification', array('scga', 'certification_status', 'year','date_certified'), array($_mysql->makeSafe($kid['scga']), $_mysql->makeSafe($newStatus), $newYear, $date));
		
	}
	
	// if the child does not have a quiz, create it
	$quiz = $_mysql->getSingle('SELECT scga FROM quiz WHERE scga = "' . $_mysql->makeSafe($kid['scga']) . '"');
	if (!$quiz) {
		$_mysql->insert('quiz', array('scga'), array($_mysql->makeSafe($kid['scga'])));
	
	
	}else
	
	
		/**************************************************************************/	
/******UPDATE QUIZ TABLE***************************************************/
/**************************************************************************/
		 
	{
		 
		 
	$fieldList= array('etiquette', 'handicap', 'rules', 'lifeSkills', 'etiquettePercent', 'handicapPercent', 'rulesPercent', 'lifeSkillsStatus');
	
	$valueList = array('', '', '', '', '', '', '', 'Pending');
		  
	$tableStr = 'quiz';
	//$whereStr = "scga = " . $prevYearCertExist['scga'] . " and year = " . $currentYear; //update those with current year
	$whereStr = "scga = " . $_mysql->makeSafe($kid['scga']); //update all regardless of year
	
	


		 $_mysql->update( $tableStr, $fieldList, $valueList, $whereStr );
		 
		 
		 }
		 
		 
		 }
		 
}

$_SESSION['updated'] = 'Certification Year Added';
died(CLIENTROOT . '/user/main');
?>