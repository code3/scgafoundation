<?
	session_start();
	require "../config/define.php";
	require "../library/php/emg.php";
	
	httpsOn();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?= CLIENTROOT ?>/css/login.css" />
</head>

<body>

<div id="logo"></div>
<form action="<?= CLIENTROOT ?>/action/reset-login/ " method="post" id="login_box">
	<?
if($_SESSION[PREFIX.'resetLogin'] == true){
	?>Your login has been reseted an email containing your new login will be sent to you shortly. 
	<br/><a href="<?= CLIENTROOT ?>/login/index.php">Login Page</a><?
	
}
else{
	if(isset($_SESSION[PREFIX.'resetLogin'] )){
		?>The email you provided was incorrect. <?
	}
	?>
	<label for="email">Administrator Email:</label>
	<br />
	<input type="text" name="email" />
	<input type="submit" value="Submit" />
	<div id="links">
		<a href="<?= CLIENTROOT ?>/login/index.php">Back to login</a>
	</div>
	<br />
	<?
}
?>
	
	
</form>
</body>
</html>
<?
unset($_SESSION[PREFIX.'resetLogin']);
?>
