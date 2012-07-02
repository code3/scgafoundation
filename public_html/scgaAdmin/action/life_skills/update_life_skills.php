<?
$_mysql->makeInputsSafe();
if (!is_array($_POST['scga']) || !is_array($_POST['lifeSkillsStatus'])) {
	died(CLIENTROOT . '/life-skills/main');
}
$i = 0;
foreach ($_POST['scga'] as $scga) {
	$_mysql->update('quiz', array('lifeSkillsStatus'), array($_POST['lifeSkillsStatus'][$i]), 'scga = "' . $scga . '"');
	
	$quizGrades = $_mysql->getSingle('SELECT etiquettePercent, rulesPercent, lifeSkillsStatus FROM quiz WHERE scga = "' . $scga . '"');
	if ($quizGrades['etiquettePercent'] == '100' 
			&& $quizGrades['rulesPercent'] >= '80' 
			&& $quizGrades['lifeSkillsStatus'] == 'Passed') {
		$_mysql->update('certification', array('certification_status', 'date_certified'), array('Certified (Online)', date('Y-m-d')), 'year = ' . $_GET['year'] . ' AND scga = "' . $scga . '"');
	}
	
	$i++;
}


$_SESSION['updated'] = 'Statuses Updated';
died(CLIENTROOT . '/life-skills/main');
?>