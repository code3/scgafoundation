<?

$scga = $_GET['scga'];
$_kid= $_mysql->getSingle('SELECT kids.* FROM kids WHERE scga = \''.$scga.'\'');
$_org= $_mysql->getSingle('SELECT organization.* FROM organization WHERE organizationid = \''.$_kid['organizationid'].'\'');
$contact = $_mysql->getSingle('SELECT * FROM contact WHERE contactid = '.$_org['contactid'].' ORDER BY `primary` DESC');
$_emailBody = 'We have received your life skills responses and after reviewing, your life skills status is now:'. $_GET['status'].'.';

if($_GET['status'] == 'Revise'){
	$_emailBody = "Great work ".$_kid['fname']." ".$_kid['lname']."! You have almost completed the Life Skills Section of the Youth on Course online quizzes.  We'd just like you to expand a little bit more on your answers.  Specifically, we are hoping that you could tell us ENTER INFO HERE.\n\nPlease log back into the website at www.scgafoundation.org/youthPanel/login/index.php to make these changes and to finish the quiz.  We're looking forward to seeing you on the course!\n\nThe SCGA Foundation";
}
else if ($_GET['status'] == 'Passed'){
	
	$_emailBody = "Congratulations ".$_kid['fname']." ".$_kid['lname']."! You have passed the Life Skills Section of the Youth on Course online quizzes.  If you have completed the Rules, Handicap, and Etiquette quizzes, you have completed your online certification. You are now eligible for Youth on Course and all of its privileges.  The SCGA Foundation will mail your 2012 Youth on Course Bag Tag by next Wednesday. You must also have your 2012 SCGA Membership Card to use the program.\n\nGreat work! Visit www.scga.org/yoc to see which courses are currently offering discounted access to Youth on Course participants.  See you on the course!\n\nThe SCGA Foundation\n\n";
}
else if ($_GET['status'] == 'Pending'){
	
	$_emailBody = $_kid['fname'].", the Life Skills Section is an introduction to the ways sportsmanship in the game of golf can help you throughout your life. The section gives examples and advice for common life situations that also apply to golf, then asks for short answers about similar situations in your own life. The questions are short answer, so they require a small amount of writing. You still need to pass the life skills section.\n\nPlease log back into the website at www.scgafoundation.org/youthPanel/login/index.php to start the course.  We're looking forward to seeing you on the course!\n\nThe SCGA Foundation";
}
else{
	$_emailBody = "We have received your life skills responses. Your life skills status is now:". $_GET['status'].".";
	$_emailBody .= "\nNo further action is required at this time.\n\nThe SCGA Foundation";
}

$_GET['name'] = $_kid['fname'].' '.$_kid['lname'];
$_GET['email'] = $_kid['email'];

$_subject = 'Youth on Course Quizzes';
$_emailFromName = 'SCGA Foundation';
$_emailFrom = 'foundation@scga.org';
$_ccEmail = $contact['email'];
?>