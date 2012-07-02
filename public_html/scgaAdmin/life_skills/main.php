<?
require ('parts/update_alert.php');
?>
<h1>Life Skills Under Review</h1>

<form id="life_skills_search_form" name="life_skills_search_form" action="./" method="get">
<input type="hidden" name="sort_field" id="sort_field" value="<?= $_GET['sort_field'] ?>" />
<input type="hidden" name="sort_desc" id="sort_desc" value="<?= $_GET['sort_desc'] ?>"/>
<input type="hidden" name="search" id="search" value="1"/>
	<label for="year">Year:</label>
	<? htmlSel(array('2008', '2009','2010','2011', '2012'), 'id="year" name="year"',$_GET['year'], false, 'Year...'); ?>
	<br />
	<label for="year">Life Skills Status:</label>
	<? htmlSel(array('Pending', 'Under Review','Passed','Revise'), 'id="status" name="status"',$_GET['status'], false, 'Status...'); ?>
	<br />
	<label for=""></label>
<input type="submit" value="Search" class="submit-button" />
</form>
<br />
<?
if($_kids){
//	$_pl->show();
	?> 
	<form id="update_life_skills" action="<?= CLIENTROOT ?>/action/life-skills/update-life-skills/?year=<?=$_GET['year']?>" method="post">
	<table class="listing">
	<?
	
	$_headerClasses = array();
	
	$_sortFields = array('','kids.fname', 'kids.lname', 'kids.grade', 'organization.name', 'quiz.lifeSkillsStatus','','','');
	$_sortTitles = array('#','First', 'Last', 'Grade', 'Organization', 'Life Skills Status','View','Pass', 'Revise');
	
	$_sortForm = 'life_skills_search_form';
	require 'parts/sort_header.php';
	$i=0;
	$rowCount = 1;
	
	foreach($_kids as $kid){
		?><tr <? if ($i % 2 == 1) { ?> class="bg"<? } ?>>
			
		<td><?=$rowCount?></td>
		<td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $kid['scga'] ?>" class="customTitle" title="View Kid"><?= $kid['fname'] ?></a></td>
		<td><a href="<?= CLIENTROOT ?>/kids/details/?scga=<?= $kid['scga'] ?>" class="customTitle" title="View Kid"><?= $kid['lname'] ?></a></td>
		<td><?= $kid['grade'] ?></td>
		
		<td><a href="<?= CLIENTROOT ?>/organization/details/?organizationid=<?= $kid['organizationid'] ?>" class="customTitle" title="View Organization"><?= $kid['name'] ?></a></td>
		
		<td><input type="hidden" name="scga[]" value="<?=$kid['scga']?>" />
		<? htmlSel(array('Pending', 'Under Review','Passed','Revise'), 'id="lifeSkillsStatus'.$kid['scga'].'" name="lifeSkillsStatus[]"',$kid['lifeSkillsStatus'], false, 'Status...'); ?>
	<br /></td>
		<td><a onclick="javascript:showLifeSkills('<?=$kid['scga']?>');" class="customTitle" title="View Answers"><img src="<?= CLIENTROOT ?>/images/icons/24-zoom.png" alt="View Answers" /></a></td>
		<td><a onclick="javascript:emailLifeSkillsStatus('<?=$kid['scga']?>', 'Passed');" class="customTitle" title="Pass Life Skills Email"><img src="<?= CLIENTROOT ?>/images/icons/24-em-check.png" alt="Pass Life Skills Email" /></a></td>
		<td><a onclick="javascript:emailLifeSkillsStatus('<?=$kid['scga']?>', 'Revise');" class="customTitle" title="Revise Life Skills Email"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Revise Life Skills Email" /></a></td>
		</tr><?
	$i++;
	$rowCount++;
	}
	?></table>
	<br />
	<input type="submit" value="Update" class="submit-button" />
	</form>
<?
}
else{
	?>No Kids Found<?
}
?>