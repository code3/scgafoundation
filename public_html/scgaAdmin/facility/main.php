<?
require ('parts/update_alert.php');
?>
<h1>Facility Panel</h1>
<form id="facility_search_form" name="facility_search_form" action="./" method="get">
	<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
	<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
	<input type="hidden" name="search" id="search" value="1"/>
	<label for="facility_name">Name:</label>
	<input type="text" name="name" id="facility_name" value="<?= $_GET['name'] ?>" class="text" />
	<br />
	<div id="disUp_calPop" class="calendar_pop"></div>
	
	<label for="yoc_enrolled_min">YOC Date Min:</label>
	<input type="text" name="enrolled_min" id="yoc_enrolled_min" value="<?= $_GET['enrolled_min'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('yoc_enrolled_min'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="yoc_enrolled_max">YOC Date Max:</label>
	<input type="text" name="enrolled_max" id="yoc_enrolled_max" value="<?= $_GET['enrolled_max'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('yoc_enrolled_max'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="facility_region">Region:</label><? htmlSel($_regions, 'id="facility_region" name="region"',$_GET['region'], false, 'Region...'); ?>
	<br />
	<label>&nbsp;</label>
	<input type="submit" value="Search" class="submit-button" /><? if($_isAdmin){ ?><input type="button" onclick="showAdd('facility','0')" value="Add Facility" class="submit-button" /><? } ?>
</form>

<?

if ($_facilities) {
		?>
		<? require 'parts/csv_fields.php';?>
			<input type="button" onclick="exportCsv(new Array('<?= implode(array_keys($_excel_cols), "', '")?>'), 'facility');" value="Download CSV File" />
			<br />
		</div> <?
}
if($_facilities){
	$_pl->show();
	?><? if($_isAdmin){//start delete form?>
	<form id="facility_del_form" action="<?= CLIENTROOT ?>/action/facility/delete-facilities/" method="post"><? } ?>
	<table class="listing">
	<?
	
	$_headerClasses = array();
	if($_isAdmin){
		$_sortFields = array('','','','facility.name', 'facility.region', 'facility.yoc_enrollment', 'facility.phone');
		$_sortTitles = array('', '', '#','Name', 'Region', 'Date Enrolled', 'Phone');
	}
	else{
		$_sortFields = array('','facility.name', 'facility.region', 'facility.yoc_enrollment', 'facility.phone');
		$_sortTitles = array('#','Name', 'Region', 'Date Enrolled', 'Phone');
	}
	$_sortForm = 'facility_search_form';
	require 'parts/sort_header.php';
	$i=0;
	$rowCount = 1;
	foreach($_facilities as $facility){
		?><tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
		<? if($_isAdmin){//add delete checkboxes, edit, and delete button?>
		<td><input type="checkbox" id="checkBox_<?= $facility['facilityid'] ?>" value="<?= $facility['facilityid'] ?>" name="checked_facility[]" /></td>
		<td><a onclick="confirm2(event, 'Delete Facility?', '$(\'checkBox_<?= $facility['facilityid']  ?>\').checked = true; $(\'facility_del_form\').submit()')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a>
		</td><? } ?>
		<td><?=$_pl->offset + $i + 1?></td>
		<td><a href="<?= CLIENTROOT ?>/facility/details/?facilityid=<?= $facility['facilityid'] ?>" class="customTitle" title="View Facility Details"><?= $facility['name'] ?></a></td>
		<td><?= $facility['region'] ?></td>
		<td><?=date("m/d/Y",strtotime($facility['yoc_enrollment'])) ?></td>
		<td><?= $facility['phone'] ?></td>
	</tr><?
	$i++;
	$rowCount++;
	}
	?></table>
	<br />
	<? if($_isAdmin){//add check all, delete all and edit button?><input type="checkbox" id="checkAllBtn" onclick="checkAll('checked_facility[]', this.checked);" />&nbsp;Check All
	<br />
	<a onclick="confirm2(event, 'Delete all checked facilities?', '$(\'facility_del_form\').submit()')" class="customTitle" title="Delete Checked"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete Checked" /></a>
	</form><? }//end the form ?>
<?
}
else{
	?>No Facilities Found<?
}
?>

