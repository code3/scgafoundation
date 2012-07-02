<div class="pop_container pop_center">
	<h3>How many <? if($_GET['section']=='tracking'){ ?>Records<? } else { echo ucfirst($_GET['section']); } ?>?</h3>
	<input id="number" name="number" type="text" maxlength="<?= MAXLENA ?>">
	<input type="button" onclick="showAddMultiple('<?=$_GET['section']?>')" value="Add <? if($_GET['section']=='tracking'){ ?>Records<? } else{ ?><?=ucfirst($_GET['section'])?> <? } ?>" />
</div>