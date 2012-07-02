<?php



function sendNotCertifiedEmail($kid){
	
	$from = 'SCGA Foundation';
	$fromEmail = 'foundation@scga.org';
	$subject = 'Your New SCGA Membership';
	$to = $kid['fname'].' '.$kid['lname'];
	$toEmail = $kid['email'];
	$htmlBody = 'Congratulations, '.$to.'! You are now a member of the Southern California Golf Association.
				<br /><br />
				Your SCGA Membership Number is: '.$kid['scga'].'<br />
				Your SCGA Club is: '.$kid['name'].'<br />
				<br />
				Through your membership, you can now earn the privilege of the SCGA Foundation\'s <em>Youth on Course program</em>, which provides $1-$5 green and range fees. To get started, login to the SCGA Foundation website to take the Youth on Course certification quizzes. You can login with your SCGA Membership number <a href="https://www.scgafoundation.org/youthPanel/login/index.php"><strong>here</strong></a> (https://www.scgafoundation.org/youthPanel/login/index.php). Your password is "password".
				<br /><br />
				Upon successful completion of the certification quizzes, your Youth on Course bag tag will be mailed directly to you.  The SCGA membership card will arrive with the January edition of FORE Magazine.  If you signed up for membership after December 30, your membership card will arrive with the bag tag.  You ALWAYS need BOTH the Youth on Course bag tag and SCGA membership card when accessing the facilities.  
				<br /><br />
				In addition to Youth on Course, you are eligible for all SCGA Member benefits.  For more information, please visit <a href="http://www.scga.org">http://www.scga.org</a>.
				<br /><br />
				If you have questions, please visit <a href="http://www.scga.org/foundation">www.scga.org/foundation</a> and visit the <em>Youth on Course</em> section.
				<br><br>
				Have fun on the course!<br />
				The SCGA Foundation';

	
	$textBody = "Congratulations, ".$to."! You are now a member of the Southern California Golf Association.";
	$textBody .= "\n\n";
	$textBody .= "Your SCGA Membership Number is: ".$kid['scga']."\n\n";
	$textBody .= "Your SCGA Club is: ".$kid['name']."\n\n";
	$textBody .= "Through your membership, you can now earn the privilege of the SCGA Foundation\'s Youth on Course program, which provides $1-$5 green and range fees. To get started, login to the SCGA Foundation website to take the Youth on Course certification quizzes. You can login with your SCGA Membership number at www.scgafoundation.org/youthPanel/login/index.php. Your password is \"password\".";
	$textBody .= "\n\n";
	$textBody .= "Upon successful completion of the certification quizzes, your Youth on Course bag tag will be mailed directly to you.  The SCGA membership card will arrive with the January edition of FORE Magazine.  If you signed up for membership after December 30, your membership card will arrive with the bag tag.  You ALWAYS need BOTH the Youth on Course bag tag and SCGA membership card when accessing the facilities.";
	$textBody .= "\n\n";
	$textBody .= "In addition to Youth on Course, you are eligible for all SCGA Member benefits.  For more information, please visit www.scga.org.";
	$textBody .= "\n\n";
	$textBody .= "If you have questions, please visit www.scga.org/foundation and visit the Youth on Course section.";
	$textBody .= "\n\n";
	$textBody .= "Have fun on the course!\n";
	$textBody .= "The SCGA Foundation";

	 //email($from, $fromEmail, $to, $toEmail, $subject, $htmlBody, $textBody);
	 $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

/*******Additional headers********/
     //$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
     $headers .= 'From: '.$from.' <'.$fromEmail.'>' . "\r\n";
     //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
     //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

	 
	 
	 
	if( !mail($toEmail, $subject, $htmlBody, $headers) ){
		
		echo 'error sending email';
		
		}
	
	
}



 ?>