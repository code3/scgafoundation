<?php
$_mysql->safeInputs = true;

require 'library/php/email.php';
require 'library/php/pl_v2.php';
$_kid = $_mysql->getSingle('SELECT fname,lname,scga FROM kids WHERE scga = "' . $_POST['scga'] . '"');
$_mysql->update('kids', array('update_password'), array(0), 'scga = "' . $_kid['scga'] . '"');
$_mysql->update('login', array('password'), array(md5($_kid['scga'] . 'password')), 'login = "' . $_kid['scga'] . '"');

$uncleanPost = $_POST; //the require data will clean post variables

if ($uncleanPost['html_email']) {
	email($uncleanPost['email_from_name'], $uncleanPost['email_from'], $uncleanPost['to'], $uncleanPost['to_email'], $uncleanPost['email_subject'], $uncleanPost['email_body']);
}
else {
	$uncleanPost['email_body'] = str_replace('<br />', "\n", str_replace('<br/>', "\n", str_replace('</p>', "\n", str_replace('<p>', "\n", $uncleanPost['email_body']))));
	email($uncleanPost['email_from_name'], $uncleanPost['email_from'], $uncleanPost['to'], $uncleanPost['to_email'], $uncleanPost['email_subject'], '',$uncleanPost['email_body']);
}
?>
<script type="text/javascript">
	<!--
	parent.alert2('Temp Password has been sent');
	parent.curtain.close();
	//-->
</script>