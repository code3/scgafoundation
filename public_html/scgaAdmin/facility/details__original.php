<?
require ('parts/update_alert.php');
?>
<h1>Facility: <?=$_facility['name']?></h1>
<form id="select_facility_form" action="<?= CLIENTROOT ?>/action/facility/save-facility/" method="post" onsubmit="checkFacilityExist('1');">
	<div class="details-col">
	<div id="add_facility_msg"></div>
	<div id="select_facility_calPop" class="calendar_pop"></div>
	<input type="hidden" name="facilityid" id="facilityid" value="<?= $_GET['facilityid'] ?>" />
	<label for="facility_enroll_date">YOC Enrollment Date:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_enroll_date" name="yoc_enrollment" value="<?= $_facility['yoc_enrollment'] ?>" class="val_req val_len 10 text" /><a href="javascript: setupCalPopUp('select_facility_calPop', 'select_facility_cal_link', $('facility_enroll_date'));" id="select_facility_cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a><br />

	<label for="facility_name">Facility Name:</label>
	<input type="hidden" name="oldName" id="oldName" value="<?= $_facility['name'] ?>" />
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_name" name="name" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_facility['name'] ?>" />
	<br />
	<label for="web">Web Address:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="web" name="web" value="<?= $_facility['web'] ?>" class="text" />
	<br />
	
	<? if(!$_isAdmin){ ?>
	<label for="facility_region">Region:</label><? htmlSel($_regions, 'disabled="disabled" id="facility_region" name="region" class="val_req"',$_facility['region'], false, 'Region...'); ?><br /><?
	} else{ ?>
	<label for="facility_region">Region:</label><? htmlSel($_regions, 'id="facility_region" name="region" class="val_req"',$_facility['region'], false, 'Region...'); ?>
	<br />
	<? } ?>
	<label for="facility_address">Address:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_address" name="address" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_facility['address'] ?>" />
	<br />
	<label for="facility_address2"></label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_address2" name="address2" maxlength="<?= MAXLENA ?>" value="<?= $_facility['address2'] ?>" class="text" />
	<br />
	<label for="facility_city">City:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_city" name="city" class="val_req text" maxlength="<?= MAXLENA ?>" value="<?= $_facility['city'] ?>" />
	<br />
	<? if(!$_isAdmin){?>
	<label for="facility_state">State:</label>
	<? htmlSel($_states, 'disabled="disabled" id="facility_state" name="state" class="val_req"', $_facility['state'], true, 'State...'); ?>
	<br />
	<? } else{ ?>
	<label for="facility_state">State:</label>
	<? htmlSel($_states, 'id="facility_state" name="state" class="val_req"', $_facility['state'], true, 'State..'); ?>
	<br />
	<? } ?>
	
	
	<label for="facility_zip">Zip:</label><input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> name="zip" id="facility_zip" maxlength="<?= MAXLENA ?>" class="val_req text" value="<?= $_facility['zip'] ?>" type="text" />
	<br />
	<label for="facility_phone">Phone:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_phone" name="phone" class="val_req text" value="<?= $_facility['phone'] ?>" />
	<br />
	<label for="facility_fax">Fax:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_fax" name="fax" value="<?= $_facility['fax'] ?>" class="text" />
	<br />
	</div>
<div class="details-col">

	<label for="yoc_green_fee">YOC Green Fee:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="yoc_green_fee" name="yoc_green_fee" class="val_req val_num val_money text"  maxlength="<?= MAXLENA ?>" value="<?= $_facility['yoc_green_fee'] ?>" />
	<br />
	<label for="yoc_range_fee">YOC Range Fee:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="yoc_range_fee" name="yoc_range_fee" class="val_req val_num val_money text"  maxlength="<?= MAXLENA ?>" value="<?= $_facility['yoc_range_fee'] ?>" />
	<br />
	<label for="guest_green_fee">Guest Green Fee:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="guest_green_fee" name="guest_green_fee"  maxlength="<?= MAXLENA ?>" value="<?= $_facility['guest_green_fee'] ?>" class="text" />
	<br />
	<label for="guest_range_fee">Guest Range Fee:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="guest_range_fee" name="guest_range_fee"  maxlength="<?= MAXLENA ?>" value="<?= $_facility['guest_range_fee'] ?>" class="text" />
	<br />
	<label for="reimbursement_green_fee">Reimbursement Green Fee:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="reimbursement_green_fee" name="reimbursement_green_fee" class="val_req val_num val_money text"  maxlength="<?= MAXLENA ?>" value="<?= $_facility['reimbursement_green_fee'] ?>" />
	<br />
	<label for="reimbursement_range_fee">Reimbursement Range Fee:</label>
	<input <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="reimbursement_range_fee" name="reimbursement_range_fee" class="val_req val_num val_money text"  maxlength="<?= MAXLENA ?>" value="<?= $_facility['reimbursement_range_fee'] ?>" />
	<br />
	<label for="facility_agreement">Agreement Description:</label>
	<textarea <? if(!$_isAdmin){ ?>disabled="disabled"<? } ?> type="text" id="facility_agreement" name="agreement" class="val_req text"><?=$_facility['agreement']?></textarea>
	<br />
	</div>
	<br />
	<label>&nbsp;</label>
	<input type="button" onclick="javascript:history.back()" value="Back" class="button" />
	<input <? if(!$_isAdmin){ ?>style="display:none;" disabled="disabled"<? } ?> class="submit-button" type="submit" value="Update" />

</form>
<script type="text/javascript">
<!--
valForm.init($('select_facility_form'));
//-->
</script>
<br /><br />

<a name="contacts"></a>
<h1>Facility Contacts</h1>
<?
require('contact.php'); 
?>

<br /><br />

<a name="notes"></a>
<h1>Facility Notes</h1>
<? require('note.php'); ?>


