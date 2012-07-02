<div class="pop_container">
<h1>Add Donation to <?= $_organization['name'] ?></h1>
<form id="select_donation_form" action="<?= CLIENTROOT ?>/action/organization/save-grant-donation/?subsection=donation" method="post">
<input type="hidden" name="organizationid" value="<?= $_GET['organizationid'] ?>" />
<label for="donation_date">Date:</label>
<input type="text" id="donation_date" name="date" class="val_req val_len 10" />
<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=donation_date')" class="customTitle" title="Calendar">
<img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
<br />
<label for="donation_item">Donation Item:</label>
<textarea type="text" id="donation_item" name="item" class="val_req val_max <?= MAXLEND ?>"></textarea>
<br />
<label for="donation_quantity">Donation Quantity:</label>
<input type="text" id="donation_quantity" name="quantity" class="val_req val_num" maxlength="<?= MAXLENA ?>"/>
<br />
<label for="donation_value">Donation Value:</label>
<input type="text" id="donation_value" name="value" class="val_req" maxlength="<?= MAXLENA ?>"/>
<br />
<label for="donation_note">Note:</label>
<textarea type="text" id="donation_note" name="note" class="val_max <?= MAXLEND ?>"></textarea>
<br />

<label>&nbsp;</label>
<input type="submit" value="Submit" />
</form>