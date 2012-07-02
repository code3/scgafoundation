<?

require('php/quizzes.php');

$_kid = $_mysql->getSingle('SELECT kids.grade, kids.fname,kids.lname, quiz.lifeSkills FROM kids INNER JOIN quiz ON kids.scga= quiz.scga WHERE kids.scga = \''.$_GET['scga'].'\'');
$_answersArray = explode('*',$_kid['lifeSkills']);

if($_kid['grade'] < 9){
	$_min=0;
	$_max=6;
}
else if($_kid['grade'] >= 9 ){
	$_min=7;
	$_max=13;
}

?>