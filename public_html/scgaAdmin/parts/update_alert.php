<?
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
}
if(isset($_SESSION['updated']) && $browser != 'IE'){?>
	<script type="text/javascript">
	<!--
		alert2('<?=$_SESSION['updated']?>');
	//-->
	</script><?
	unset($_SESSION['updated']);
}
else if(isset($_SESSION['updated']) && $browser == 'IE'){
	?>
    <p  style="padding: 0.8em 1.2em; margin: 0 0 1em;background: #cf9; color: #360; border: 1px solid #9c6;border-width: 1px 0;"><?= $_SESSION['updated'] ?></p>
    <?
	unset($_SESSION['updated']);
}
?>