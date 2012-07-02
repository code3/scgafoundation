<?
$scga = $_GET['scga'];
$_kid= $_mysql->getSingle('SELECT kids.* FROM kids WHERE scga = \''.$scga.'\'');
$_emailBody = $_kid['fname'].",\n\n";
$_emailBody .= "Your temporary password is: 'password'\n\nOnce you log in, you will be required to update your password.";
$_emailBody .= "\n\nThe SCGA Foundation";
$_GET['name'] = $_kid['fname'].' '.$_kid['lname'];
$_GET['email'] = $_kid['email'];
$_subject = 'Your password has been reset';
$_emailFromName = 'SCGA Foundation';
$_emailFrom = 'no-reply@scgafoundation.org';

?>