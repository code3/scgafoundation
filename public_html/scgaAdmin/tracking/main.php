<?
require ('parts/update_alert.php');
?>

<h1>YOC Tracking Panel</h1>
<form id="tracking_search_form" name="tracking_search_form" action="./" method="get">
	<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
	<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
	<input type="hidden" name="search" id="search" value="1"/>
	<label for="scga">SCGA Membership #:</label>
	<input type="text" name="scga" id="scga" value="<?= $_GET['scga'] ?>" class="text" />
	<br />
	<div id="disUp_calPop" class="calendar_pop"></div>
	
	<label for="date_min">Date Min:</label>
	<input type="text" name="date_min" id="date_min" value="<?= $_GET['date_min'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('date_min'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="date_max">Date Max:</label>
	<input type="text" name="date_max" id="date_max" value="<?= $_GET['date_max'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('date_max'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="type">Type:</label><? htmlSel(array('Range', 'Course'), 'id="type" name="type"', $_GET['type'], false, 'Type...'); ?>
	<br />
	
	<label for="">Facility:</label>
	<input type="text" name="facility" id="facility" maxlength="<?= MAXLENB ?>" value="<?= $_GET['facility'] ?>" class="text" />
	<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/tracking/facility-select/?fieldid=facility')" class="customTitle" title="Select a Facility."><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Select a Facility." /></a>
	<br />
	<label>&nbsp;</label>
	<input type="submit" value="Search" class="submit-button" />
	<?
    if($_isAdmin || $_isAssistant){
		?>
        <input type="button" onclick="showAddNumber('tracking')" value="Add YOC Tracking Record" class="submit-button" />
        
		<?
    }
	?>
    <p class="clear-fields"><a href="javascript: clearForm('tracking_search_form');" class="customTitle" title="Clear the search form fields">Clear Filters</a></p>
</form>

<?

if ($_trackings) {
	require 'parts/csv_fields.php';
	?>
    <input type="button" onclick="exportCsv(new Array('<?= implode(array_keys($_excel_cols), "', '") ?>'), 'tracking');" value="Download CSV File" />
    <br />
	</div>
    <?
}
if($_trackings){
	$_pl->show();
    if($_isAdmin || $_isAssistant){//start delete form
		?>
		<form id="tracking_del_form" action="<?= CLIENTROOT ?>/action/tracking/delete-trackings/" method="post">
		<?
    }
	?>
	<table class="listing">
	<?
	
	$_headerClasses = array();
	if($_isAdmin || $_isAssistant){
		$_sortFields = array('', '', '', 'kids.fname', 'kids.lname', 'tracking.scga', 'facility.name', '', 'tracking.type', 'tracking.date');
		$_sortTitles = array('', '', '#', 'First', 'Last', 'SCGA', 'Facility Name', 'Organization', 'Type', 'Date');
	}
	else{
		$_sortFields = array('', 'kids.fname', 'kids.lname', 'tracking.scga', 'facility.name', '', 'tracking.type', 'tracking.date');
		$_sortTitles = array('#', 'First', 'Last', 'SCGA', 'Facility Name', 'Organization', 'Type', 'Date');
	}

	$_sortForm 	= 'tracking_search_form';
	require 'parts/sort_header.php';
	$i 			= 0;
	$rowCount 	= 1;
	foreach($_trackings as $tracking){
		?>
        <tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
			<?
            if($_isAdmin || $_isAssistant){//add delete checkboxes, edit, and delete button
                ?>
                <td><input type="checkbox" id="checkBox_<?= $i?>" value="<?= $tracking['trackingid']?>" name="checked_tracking[]" /></td>
                <td><a href="javascript:$('checkBox_<?= $i?>').checked = true; showEditMultiple('tracking','<?=sizeof($_trackings)?>');" class="customTitle" title="Edit"><img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Edit" /></a><a onclick="confirm2(event, 'Delete Tracking Record?', '$(\'checkBox_<?= $i?>\').checked = true; $(\'tracking_del_form\').submit()')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a>
                </td>
                <?
            }
            ?>
            <td><?= $_pl->offset + $i + 1 ?></td>
            <td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $tracking['scga'] ?>" class="customTitle" title="View Kid"><?= $tracking['fname'] ?></a></td>
            <td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $tracking['scga'] ?>" class="customTitle" title="View Kid"><?= $tracking['lname'] ?></a></td>
            <td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $tracking['scga'] ?>" class="customTitle" title="View Kid"><?= $tracking['scga'] ?></a></td>
            <td><a href="<?= CLIENTROOT ?>/facility/details/?facilityid=<?= $tracking['facilityid'] ?>" class="customTitle" title="View Facility Details"><?= $tracking['name'] ?></a></td>
            <td><a href="<?= CLIENTROOT ?>/organization/details/?organizationid=<?= $tracking['organizationid'] ?>" class="customTitle" title="View Facility Details"><?= $tracking['organizationName'] ?></a></td>
            <td><?= $tracking['type'] ?></td>
            <td><?= date("m/d/Y", strtotime($tracking['date'])) ?></td>
		</tr>
		<?
		$i++;
		$rowCount++;
	}
	?>
    </table>
	<br />
	<?
    if($_isAdmin || $_isAssistant){//add check all, delete all and edit button
		?>
        <input type="checkbox" id="checkAllBtn" onclick="checkAll('checked_tracking[]', this.checked);" />&nbsp;Check All
		<br />
		<a onclick="confirm2(event, 'Delete all checked tracking records?', '$(\'tracking_del_form\').submit()')" class="customTitle" title="Delete Checked">
        <img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete Checked" /></a>
		<a href="javascript:showEditMultiple('tracking','<?= sizeof($_trackings) ?>')" class="customTitle" title="Edit Checked">
        <img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Edit Checked" /></a>
		</form>
		<?
    }//end the form
}
else{
	?>
    <br />No Records Found
	<?
}
?>