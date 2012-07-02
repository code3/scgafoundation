<?
require ('parts/update_alert.php');
?>

<h1>Organization Panel</h1>
<form id="organization_search_form" name="organization_search_form" action="./" method="get">
	<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
	<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
	<input type="hidden" name="search" id="search" value="1"/>
	<label for="organization_name">Name:</label>
	<input type="text" name="name" id="organization_name" value="<?= $_GET['name'] ?>" class="text" />
	<br />
	<label for="organization_legal_name">Legal Name:</label>
	<input type="text" name="legal_name" id="organization_legal_name" value="<?= $_GET['legal_name'] ?>" class="text" />
	<br />
	<div id="disUp_calPop" class="calendar_pop"></div>
	<label for="yoc_agreement_min">YOC Date Min:</label>
	<input type="text" name="yoc_agreement_min" id="yoc_agreement_min" value="<?= $_GET['yoc_agreement_min'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('yoc_agreement_min'));" id="cal_link" class="customTitle" title="Open Calendar">
    <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="yoc_agreement_max">YOC Date Max:</label>
	<input type="text" name="yoc_agreement_max" id="yoc_agreement_max" value="<?= $_GET['yoc_agreement_max'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('yoc_agreement_max'));" id="cal_link2" class="customTitle" title="Open Calendar">
    <img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label>&nbsp;</label>
	<input type="submit" value="Search" class="submit-button" /><? if($_isAdmin){ ?><input type="button" onclick="showAdd('organization','0')" value="Add Organization" class="submit-button" /><? } ?>
</form>

<?

if ($_organizations) {
	?>
	<? require 'parts/csv_fields.php';?>
	<input type="button" onclick="exportCsv(new Array('<?= implode(array_keys($_excel_cols), "', '")?>'), 'organization');" value="Download CSV File" />
	<br />
	</div>
	<?
}
if($_organizations){
	$_pl->show();
	?>
	<? 
	if($_isAdmin){ //start delete form
		?>
		<form id="organization_del_form" action="<?= CLIENTROOT ?>/action/organization/delete-organizations/" method="post">
		<? 
	}
	?>
	<table class="listing">
	<?
	$_headerClasses = array();
	if($_isAdmin){
		$_sortFields = array('', '', '', 'organization.organizationid', 'organization.name', 'organization.phone', '');
		$_sortTitles = array('', '', '#', 'ID', 'Name', 'Phone', 'View Kids');
	}
	else{
		$_sortFields = array('', 'organization.organizationid', 'organization.name', 'organization.phone', '');
		$_sortTitles = array('#', 'ID', 'Name', 'Phone','View Kids');
	}
	$_sortForm = 'organization_search_form';
	require 'parts/sort_header.php';
	$i 			= 0;
	$rowCount 	= 1;
	foreach($_organizations as $organization){
		?>
        <tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
			<?
            if($_isAdmin){ //add delete checkboxes, edit, and delete button
                ?>
                <td><input type="checkbox" id="checkBox_<?= $organization['organizationid'] ?>" value="<?= $organization['organizationid'] ?>" name="checked_organization[]" /></td>
                <td><a onclick="confirm2(event, 'Delete Organization?', '$(\'checkBox_<?= $organization['organizationid']  ?>\').checked = true; $(\'organization_del_form\').submit()')" class="customTitle" title="Delete">
                <img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a></td>
                <?
            }
            ?>
            <td><?= $_pl->offset + $i + 1 ?></td>
            <td><?= $organization['organizationid'] ?></td>
            <td><a href="<?= CLIENTROOT ?>/organization/details/?organizationid=<?= $organization['organizationid'] ?>" class="customTitle" title="View Organization Details"><?= $organization['name'] ?></a></td>
            <td><?= $organization['phone'] ?></td>
            <td><a href="<?= CLIENTROOT ?>/kids/main/?organizationid=<?= $organization['organizationid'] ?>" class="customTitle" title="View Kids"><?= $_kids[$i] ?></a></td>
		</tr>
		<?
		$i++;
		$rowCount++;
	}
	?>
    </table>
	<br />
	<?
    if($_isAdmin){ //add check all, delete all and edit button
		?>
        <input type="checkbox" id="checkAllBtn" onclick="checkAll('checked_organization[]', this.checked);" />&nbsp;Check All
		<br />
		<a onclick="confirm2(event, 'Delete all checked organizations?', '$(\'organization_del_form\').submit()')" class="customTitle" title="Delete Checked">
        <img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete Checked" /></a>
		</form>
		<?
    } //end the form
	?>
	<?
}
else{
	?>
    No Organizations Found
	<?
}
?>