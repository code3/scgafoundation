<?
if ($_SESSION[PREFIX]['success']) {
	?>
	<p class="success"><?= $_SESSION[PREFIX]['success'] ?></p>
	<?
	unset($_SESSION[PREFIX]['success']);
}
else if ($_SESSION[PREFIX]['error']) {
	?>
	<p class="error"><?= $_SESSION[PREFIX]['error'] ?></p>
	<?
	unset($_SESSION[PREFIX]['error']);
}
?>
