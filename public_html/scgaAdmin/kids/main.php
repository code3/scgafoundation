<?
require ('parts/update_alert.php');
?>

<h1>Kids Panel</h1>
<form id="kids_search_form" name="kids_search_form" action="./" method="get">
	<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
	<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
	<input type="hidden" name="search" id="search" value="1"/>
	<label for="scga">SCGA Membership #:</label>
	<input type="text" name="scga" id="scga" value="<?= $_GET['scga'] ?>" class="text" />
	<br />
	<label for="enrolled_min">Enrolled Min:</label>
	<input type="text" name="enrolled_min" id="enrolled_min" value="<?= $_GET['enrolled_min'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('enrolled_min'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="enrolled_max">Enrolled Max:</label>
	<input type="text" name="enrolled_max" id="enrolled_max" value="<?= $_GET['enrolled_max'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('enrolled_max'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="fname">First Name:</label>
	<input type="text" name="fname" id="fname" value="<?= $_GET['fname'] ?>" class="text" />
	<br />
	<label for="lname">Last Name:</label>
	<input type="text" name="lname" id="lname" value="<?= $_GET['lname'] ?>" class="text" />
	<br />
	<div id="disUp_calPop" class="calendar_pop"></div>
	<label for="date_min">DOB Min:</label>
	<input type="text" name="date_min" id="date_min" value="<?= $_GET['date_min'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('date_min'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="date_max">DOB Max:</label>
	<input type="text" name="date_max" id="date_max" value="<?= $_GET['date_max'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('date_max'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="">Organization:</label>
	<input type="text" name="organization" id="organization" maxlength="<?= MAXLENB ?>" value="<?= $_GET['organization'] ?>" class="text" />
	<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/kids/organization-select/?fieldid=organization')" class="customTitle" title="Select an Organization."><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Select an Organization." /></a>
	<br />
    <label for="golf_certified">Golf Certified:</label>
	<? htmlSel(array('1' => 'Yes', '0' => 'No'), 'id="golf_certified" name="golf_certified"', $_GET['golf_certified'], true, 'Golf Certified...'); ?>
	<br />
    <label for="game_club">Game Club:</label>
	<? htmlSel(array('1' => 'Yes', '0' => 'No'), 'id="game_club" name="game_club"', $_GET['game_club'], true, 'Game Club...'); ?>
	<br />
	<label for="year">Certification Year:</label>
	<input type="text" id="year" name="year" maxlength="4" value="<?= $_GET['year'] ?>" class="text" /><br />
	<br />
	<label for="certification_status">Certification Status:</label>
	<? htmlSel(array('Certified by Program','Certified (Online)','Not certified','Online Quizzes Submitted'), 'id="certification_status" name="certification_status"',$_GET['certification_status'], false, 'Status...'); ?>
	<br />
	Or:
	<label for="certification_status2">Certification Status:</label>
	<? htmlSel(array('Certified by Program','Certified (Online)','Not certified','Online Quizzes Submitted'), 'id="certification_status2" name="certification_status2"',$_GET['certification_status2'], false, 'Status...'); ?>
	<br />
    <label for="date_certified_min">Date Certified Min:</label>
	<input type="text" name="date_certified_min" id="date_certified_min" value="<?= $_GET['date_certified_min'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link', $('date_certified_min'));" id="cal_link" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
	<label for="date_certified_max">Date Certified Max:</label>
	<input type="text" name="date_certified_max" id="date_certified_max" value="<?= $_GET['date_certified_max'] ?>" class="text" />
	<a href="javascript: setupCalPopUp('disUp_calPop', 'cal_link2', $('date_certified_max'));" id="cal_link2" class="customTitle" title="Open Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" /></a>
	<br />
    <label>&nbsp;</label>
    <input type="submit" value="Search" class="submit-button" />
	<? 
    if ($_isAdmin) { 
        ?>
        <input type="button" onclick="showAddNumber('kids')" value="Add Kid" class="submit-button" />
        <?
        }
    ?>
    <p class="clear-fields"><a href="javascript: clearForm('kids_search_form');" class="customTitle" title="Clear the search form fields">Clear Filters</a></p>
</form>
<br /><br />

<?
if ($_kids) {
	require 'parts/csv_fields.php';
	?>
		<input type="button" onclick="exportCsv(new Array('<?= implode(array_keys($_excel_cols), "', '")?>'), 'kids');" value="Download CSV File" />
		<br />
	</div>
	<br />
	<?
}

if ($_kids) {
	$_pl->show();
	if ($_isAdmin) {//start delete form
		?>
		<form id="kids_del_form" action="<?= CLIENTROOT ?>/action/kids/delete-kids/" method="post">
		<?
	}
	?>
	<table class="listing">
	<?
	$_headerClasses = array();
	
	if ($_isAdmin) {
		
		$_sortFields = array(''
							 ,''
							 , ''
							 , 'kids.scga'
							 , 'kids.fname'
							 , 'kids.lname'
							 , 'kidAge'
							 , 'organization.name'
							 , 'kids.yoc_classification'
							 , 'kids.golf_certified'
							 , 'kids.game_club'
							 , 'certification.certification_status'
							 , ''
							 , 'certification.date_certified'
							 );
		
		$_sortTitles = array(''
							 , ''
							 , '#'
							 , 'SCGA #'
							 , 'First'
							 , 'Last'
							 , 'Age'
							 , 'Organization'
							 , 'Classification'
							 , 'Golf Certified'
							 , 'Game Club'
							 , 'Cert Status'
							 , 'Cert Year'
							 , 'Date Certified'
							 );
	}
	else {
		$_sortFields = array(''
							 , 'kids.scga'
							 , 'kids.fname'
							 , 'kids.lname'
							 , 'kidAge'
							 , 'organization.name'
							 , 'kids.yoc_classification'
							 , 'kids.golf_certified'
							 , 'kids.game_club'
							 , 'certification.certification_status'
							 , ''
							 , 'certification.date_certified'
							 );
		
		$_sortTitles = array('#'
							 , 'SCGA #'
							 , 'First'
							 , 'Last'
							 , 'Age'
							 , 'Organization'
							 , 'Classification'
							 , 'Golf Certified'
							 , 'Game Club'
							 , 'Cert Status'
							 , 'Cert Year'
							 , 'Date Certified'
							 );
	}
	$_sortForm = 'kids_search_form';
	require 'parts/sort_header.php';
	$i = 0;
	$rowCount = 1;
	
	foreach ($_kids as $kid) {
		?>
        <tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
			<?
            if ($_isAdmin) { //add delete checkboxes, edit, and delete button
                ?>
                <td><input type="checkbox" id="checkBox_<?= $i ?>" value="<?= $kid['scga']?>" name="checked_kids[]" /></td>
                <td>
                <a href="javascript:$('checkBox_<?= $i?>').checked = true; showEditMultiple('kids','<?=sizeof($_kids)?>');" class="customTitle" title="Edit">
                <img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Edit" />
                </a>
                <a onclick="confirm2(event, 'Delete Kid?', '$(\'checkBox_<?= $i?>\').checked = true; $(\'kids_del_form\').submit()')" class="customTitle" title="Delete">
                <img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" />
                </a>
                </td>
                <?
            }
            ?>
            <td><?=$_pl->offset + $rowCount?></td>
            <td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $kid['scga'] ?>" class="customTitle" title="View Kid"><?= $kid['scga'] ?></a></td>
            <td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $kid['scga'] ?>" class="customTitle" title="View Kid"><?= $kid['fname'] ?></a></td>
            <td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $kid['scga'] ?>" class="customTitle" title="View Kid"><?= $kid['lname'] ?></a></td>
            <td><? if ($kid['dob'] != '0000-00-00'){ ?><?=$kid['kidAge']?><? } ?></td>
            <td><a href="<?= CLIENTROOT ?>/organization/details/?organizationid=<?= $kid['organizationid'] ?>" class="customTitle" title="View Organization"><?= $kid['name'] ?></a></td>
            <td><?= $kid['yoc_classification'] ?></td>
            <td><?= $kid['golf_certified_formatted'] ?></td>
            <td><?= $kid['game_club_formatted'] ?></td>
            <td><?= $kid['certification_status'] ?></td>	
            <td><?= $kid['year'] ?></td>	
            <td><?= $kid['date_certified'] != '' ? date('m/d/Y', strtotime($kid['date_certified'])) : '' ?></td>		
        </tr>
		<?
		$i++;
		$rowCount++;
	}
	?>
	
    </table>
	<br />
	<?
    if ($_isAdmin) {//add check all, delete all and edit button
		?>
        <input type="checkbox" id="checkAllBtn" onclick="checkAll('checked_kids[]', this.checked);" class="checkbox" />
    	<label for="checkAllBtn">Check All</label>
		<br />
		<a onclick="confirm2(event, 'Delete all checked kids?', '$(\'kids_del_form\').submit()')" class="customTitle" title="Delete Checked"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete Checked" /></a>
        
        
		<a href="javascript:showEditMultiple('kids','<?=sizeof($_kids)?>')" class="customTitle" title="Edit Checked"><img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Edit Checked" /></a>
		</form>
		<?
	} //end the form
	
}
else{
	?>
    No Kids Found
	<?
}

?>