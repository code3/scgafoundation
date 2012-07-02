<div class="pop_container">
<h1>Add Facility</h1>
<form id="select_facility_form" action="<?= CLIENTROOT ?>/action/facility/save-facility/" method="post" onsubmit="checkFacilityExist();">
<div id="add_facility_msg"></div>
<div id="select_facility_calPop" class="calendar_pop"></div>
<input type="hidden" name="facilityid" value="<?= $_GET['facilityid'] ?>" />
<label for="facility_enroll_date">YOC Enrollment Date:</label><input type="text" id="facility_enroll_date" name="yoc_enrollment" class="val_req val_len 10" /><a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=facility_enroll_date')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a><br />

<label for="name">Facility Name:</label>
<input type="text" id="name" name="name" class="val_req" maxlength="<?= MAXLENA ?>" /><br />
<label for="web">Web Address:</label>
<input type="text" id="web" name="web"/><br />
<label for="facility_region">Region:</label><? htmlSel($_regions, 'id="facility_region" name="region" class="val_req"','', false, 'Please select...'); ?><br />

<? require 'parts/add_address.php';
?>
<label for="facility_phone">Phone:</label>
<input type="text" id="facility_phone" name="phone" class="val_req" /><br />
<label for="facility_fax">Fax:</label>
<input type="text" id="facility_fax" name="fax" /><br />
<label for="yoc_green_fee">YOC Green Fee:</label>
<input type="text" id="yoc_green_fee" name="yoc_green_fee" class="val_req val_num val_money"  maxlength="<?= MAXLENA ?>" /><br />

<label for="yoc_range_fee">YOC Range Fee:</label>
<input type="text" id="yoc_range_fee" name="yoc_range_fee" class="val_req val_num val_money"  maxlength="<?= MAXLENA ?>" /><br />

<label for="guest_green_fee">Guest Green Fee:</label>
<input type="text" id="guest_green_fee" name="guest_green_fee" maxlength="<?= MAXLENA ?>" /><br />

<label for="guest_range_fee">Guest Range Fee:</label>
<input type="text" id="guest_range_fee" name="guest_range_fee"  maxlength="<?= MAXLENA ?>" /><br />

<label for="reimbursement_green_fee">Reimbursement Green Fee:</label>
<input type="text" id="reimbursement_green_fee" name="reimbursement_green_fee" class="val_req val_num val_money"  maxlength="<?= MAXLENA ?>" /><br />

<label for="reimbursement_range_fee">Reimbursement Range Fee:</label>
<input type="text" id="reimbursement_range_fee" name="reimbursement_range_fee" class="val_req val_num val_money"  maxlength="<?= MAXLENA ?>" /><br />

<label for="facility_agreement">Agreement Description:</label>
<textarea type="text" id="facility_agreement" name="agreement" class="val_req"></textarea><br />

<label>&nbsp;</label>
<input type="submit" value="Submit" />
</form>