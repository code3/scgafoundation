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

<div id="login_logo"></div>
<form action="<?= CLIENTROOT ?>/action/login/" method="post" id="login_box">
	<label for="login">Login:</label>
	<?
	if(isset($_SESSION[PREFIX.'loginFailed'])){
		?><div id="login_msg"><?
			if($_SESSION[PREFIX.'loginFailed'] != 1){?>
				<?=$_SESSION[PREFIX.'loginFailed']?><?
			}else{?>
		
		Login Failed</div><? }
		unset($_SESSION[PREFIX.'loginFailed']);
	}
	?>
	<input type="text" name="login" class="text" />
	<label for="password">Password:</label>
	<input type="password" name="password" class="text" />
	<input type="submit" value="Login" class="button" />
</form>
</body>
</html>
