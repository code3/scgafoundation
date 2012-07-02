<?
require 'library/php/email.php';
if ($_POST['html_email']) {
	email($_POST['email_from_name'], $_POST['email_from'], '', $_POST['email_test'], $_POST['email_subject'], $_POST['email_body']);
}
else {
	$_POST['email_body']=str_replace('<br />', "\n", str_replace('<br/>', "\n", str_replace('</p>', "\n", str_replace('<p>', "\n", $_POST['email_body']))));
	email($_POST['email_from_name'], $_POST['email_from'], '', $_POST['email_test'], $_POST['email_subject'], '', $_POST['email_body']);
}
?>
<script type="text/javascript">
	<!--
	parent.alert2('Test Email has been sent to:<br /> <?= $_POST['email_test'] ?>', new Array(200, 35));
	//-->
</script>