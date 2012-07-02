<?php
require 'library/php/email.php';
require 'library/php/pl_v2.php';

$uncleanPost = $_POST; //the require data will clean post variables

$ccEmail = 	$uncleanPost['cc_email'] != '' ? $uncleanPost['cc_email'] : '';

if ($uncleanPost['to_email'] != '') { //single email
	
	if ($uncleanPost['html_email']) {
		email($uncleanPost['email_from_name'], $uncleanPost['email_from'], $uncleanPost['to'], $uncleanPost['to_email'], $uncleanPost['email_subject'], $uncleanPost['email_body'], '', $ccEmail);
	}
	else {
		$uncleanPost['email_body'] = str_replace('<br />', "\n", str_replace('<br/>', "\n", str_replace('</p>', "\n", str_replace('<p>', "\n", $uncleanPost['email_body']))));
		email($uncleanPost['email_from_name'], $uncleanPost['email_from'], $uncleanPost['to'], $uncleanPost['to_email'], $uncleanPost['email_subject'], '', $uncleanPost['email_body'], $ccEmail);
	}
	
}
else { //batch
	switch ($uncleanPost['section']) {
		case 'schoolStudent':
			require 'data/school/student.php';
			break;
		case 'sessionStudent':
			require 'data/session/student.php';
			break;
		case 'adminHome':
			require 'data/home.php';
			break;
		default: 
			$_SESSION[PREFIX . 'error'] = $_p . ' section does not exist';
			died(CLIENTROOT . '/error');
	}
	
	$datas = $_mysql->get($_query);
	
	$i = 0;
	foreach ($datas as $data) {
		if ($uncleanPost['html_email']) {
			email($uncleanPost['email_from_name'], $uncleanPost['email_from'], $data['fname'].' '.$data['lname'], $data['email'], $uncleanPost['email_subject'], $uncleanPost['email_body'], '', $ccEmail);
		}
		else {
			$uncleanPost['email_body'] = str_replace('<br />', "\n", str_replace('<br/>', "\n", str_replace('</p>', "\n", str_replace('<p>', "\n", $uncleanPost['email_body']))));
			email($uncleanPost['email_from_name'], $uncleanPost['email_from'], $data['fname'].' '.$data['lname'], $data['email'], $uncleanPost['email_subject'], '', $uncleanPost['email_body'], $ccEmail);
		}
		if ($data['email'] != '') {
			$i++;
		}
	}
}
?>
<script type="text/javascript">
	<!--
	parent.alert2('<?= $i ?> Email(s) has been sent');
	parent.curtain.close();
	//-->
</script>