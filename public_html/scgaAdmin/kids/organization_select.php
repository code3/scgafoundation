<div class="pop_container">
	<?php
	letter_output("javascript: sel('".CLIENTROOT."/ajax/kids/organization-select/?fieldid=".$_GET['fieldid']."&%letter%', true)");
	if(!is_array($_list)){
		die('<br /><br />None');
	}
	$_pl->show();
	?>
	<div class="align_left">
	<?
	foreach($_list as $each){
		$htmlName = htmlentities($each['name']);
		?>
		<img src="<?= CLIENTROOT ?>/images/icons/24-em-check.png" class="customTitle" title="Select this one" onclick="sel2('<?= jsClean($htmlName) ?>', '<?= $_GET['fieldid']; ?>' );" ><?= $htmlName; ?>
		<br />
		<?
	}
	?>
	</div>
	<br />
</div>