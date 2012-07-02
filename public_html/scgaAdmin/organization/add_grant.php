<div class="pop_container">
<h1>Add Grant to <?= $_organization['name'] ?></h1>
<form id="select_grant_form" action="<?= CLIENTROOT ?>/action/organization/save-grant-donation/?subsection=grant" method="post">
<input type="hidden" name="organizationid" value="<?= $_GET['organizationid'] ?>" />
<label for="grant_year">Year:</label>
<input type="text" id="grant_year" name="year" class="val_req val_numeric" maxlength="4" value="<?= date('Y') ?>"/>
<br />
<label for="grant_amount">Amount:</label>
<input type="text" id="grant_amount" name="amount" class="val_req val_num val_money" maxlength="<?= MAXLENA ?>" />
<br />
<label for="grant_note">Note:</label>
<textarea type="text" id="grant_note" name="note" class="val_max <?= MAXLEND ?>"></textarea>
<br />
<label>&nbsp;</label>
<input type="submit" value="Submit" />
</form>