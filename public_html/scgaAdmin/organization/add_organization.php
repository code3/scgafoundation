<div class="pop_container">
<h1>Add Organization</h1>
<form id="select_organization_form" action="<?= CLIENTROOT ?>/action/organization/save-organization/" method="post" onsubmit="checkOrganizationExist();">
<div id="add_organization_msg"></div>
<div id="select_organization_calPop" class="calendar_pop"></div>

<input type="hidden" id="organizationid" name="organizationid" value="<?= $_GET['organizationid'] ?>" />

<label for="new_organizationid">Organization ID:</label>
<input type="text" id="new_organizationid" name="new_organizationid" class="val_req" maxlength="12" /><br />
<label for="web">Web Address:</label>
<input type="text" id="web" name="web" maxlength="<?= MAXLENC ?>"/><br />
<label for="organization_name">Name:</label>
<input type="text" id="organization_name" name="name" class="val_req" maxlength="<?= MAXLENA ?>" /><br />

<label for="organization_legal_name">Legal Name:</label>
<input type="text" id="organization_legal_name" name="legal_name" class="val_req" maxlength="<?= MAXLENA ?>" /><br />

<? require 'parts/add_address.php';
?>
<label for="organization_phone">Phone:</label>
<input type="text" id="organization_phone" name="phone" class="val_req" maxlength="<?= MAXLENA ?>"/><br />

<label for="organization_fax">Fax:</label>
<input type="text" id="organization_fax" name="fax" class="val_req" maxlength="<?= MAXLENA ?>"/><br />

<label for="organization_scga_club">SCGA Club Name:</label>
<input type="text" id="organization_scga_club" name="scga_club" class="val_req" maxlength="<?= MAXLENA ?>" /><br />

<label for="organization_scga_club_code">SCGA Club Code:</label>
<input type="text" id="organization_scga_club_code" name="scga_club_code" class="val_req" maxlength="7" /><br />

<label for="organization_agreement_date">YOC Agreement Date:</label><input type="text" id="organization_agreement_date" name="yoc_agreement"  class="val_req val_len 10" />

<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=organization_agreement_date')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a><br />

<label for="handicap_chairman_date">Handicap Chairman Date:</label><input type="text" id="handicap_chairman_date" name="handicap_chairman"  class="val_req val_len 10" />

<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=handicap_chairman_date')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a><br />

<label>&nbsp;</label>
<input type="submit" value="Submit" />
</form>
