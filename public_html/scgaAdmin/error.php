<?
$fh = fopen("logs/errors.txt", 'a') or die("can't open error file");
fwrite($fh, date('m/d/y h:i:s A')."\n".$_SESSION[PREFIX.'error']."\n");
fclose($fh);
unset($_SESSION[PREFIX.'error']);
?><div class="content">The page you have requested could not be found.</div>