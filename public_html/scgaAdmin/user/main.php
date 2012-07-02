<?
require ('parts/update_alert.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/z_my_processes/includes/external-scripts.php');

if($_isAdmin){
	$month = date('m');
	
	if($month == '01' || $month == '02' || $month == '03'){
		$newYear = date('Y');
	}
	else{
		$newYear = date('Y') + 1;
	}
	
	$_SESSION['return_to_admin'] = $urlLocatorObj->getEntireUrlAddress();
	
	?>
    <h1>Admin Functions</h1>
    <ul class="admin-options">
        <li class="option">
        
        
         <a onclick="confirm2(event, 'Add Certification Year?','addYear(\'<?= $newYear ?>\',\'1\')')"> 
            <!--   <a href="javascript: alert('This section is disabled and will be removed when testing is completed')">-->
            <span class="name">Reset Certification Statuses (enabled)</span> 
            <span class="description">If a child already has a certification for <?= $newYear ?>, this will have no effect,
	otherwise if no certification record currently exists for <?= $newYear ?>, this will duplicate <?= $newYear - 1 ?>
	certification status for <?= $newYear ?>. If no certification exists for <?= $newYear - 1 ?>, <?= $newYear ?> certification status will default to "Not certified".</span>
            </a>
            
            
        </li>
        <li class="option">
            <a href="<?= CLIENTROOT ?>/online_donation/main" >
            <span class="name">Donations</span>
            <span class="description" style="height:65px;">View online donations.</span>
            </a>
        </li>
        
    </ul>
    
    
    
   
    
    
    
    <ul class="admin-options">
        <li class="option">
            <a href="<?= CLIENTROOT ?>/kids/upload_csv">
            <span class="name">Upload CSV File</span>
            <span class="description" style="height:39px;">Import and update kids by uploading a .csv file.</span>
            </a>
        </li>
        
        
        <?php $currentYear = date('Y'); $nextYear = date('Y') + 1; ?>
         
        <li class="option">
        
        <!--
            <a href="/z_my_processes/reset-kids.php" onclick="javascript: return confirm('Are you sure you want to reset all kids?\n\nYou will be resetting certifications for the year <?php //echo $currentYear ?> and set kids to \'not certified\' for the year <?php echo $nextYear ?>')">
         -->
         <a href="#">   
            
            <span class="name">Reset Certification Statuses (Disabled)</span>
            <span class="description" style="height:39px;">This segment will delete former quiz results, place every kid in a 'not certified' status and require renewal payment during log-in<br />
            <!--
<form method="post" action="/z_my_processes/reset-kids.php" >
<input type="text" name="year" value="" />
<input type="submit" value="Reset Year" class="submit-button" />
</form>
-->
</span>
            </a>
            
        </li>
    
    
        
        
        
        
    </ul>
    
    
    
    
    
    
        
    <br />
	<h1>Users</h1>
    <input type="button" onclick="showAdd('user','')" value="Add User" />
	<br /><br />
	<form name="del_user_form" id="del_user_form" action="<?= CLIENTROOT ?>/action/user/delete-users/" method="post">
	<table class="listing">
		<tr>
			<th></th>
			<th></th>
			<th>Username</th>
			<th>Group</th>
		</tr>
		<?
		if($users){
			$rowCount = 0;
			foreach ($users as $user) {
				?>
				<tr<? if ($rowCount % 2 == 1) { ?> class="bg"<? } ?>>
					<td><input type="checkbox" id="checkBox_<?= $user['loginid'] ?>" value="<?= $user['loginid'] ?>" name="checked_user[]" /></td>
					<td><a onclick="confirm2(event, 'Are you sure you want to<br /> delete <?= $user['login'] ?>?', '$(\'checkBox_<?= $user['loginid'] ?>\').checked = true; $(\'del_user_form\').submit()')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a></td>
					<td><?= $user['login'] ?></td>
					<td><?= $user['name'] ?></td>
				</tr>
				<?
				$rowCount++;
			}
		}
		?>
	</table>
	<br />
	<input type="checkbox" id="checkAllBtn" onclick="checkAll('checked_user[]', this.checked);" />&nbsp;Check All
	<br />
	<a onclick="confirm2(event, 'Delete all checked users?', '$(\'del_user_form\').submit()')" class="customTitle" title="Delete Checked"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete Checked" /></a>
	</form>
    <?
}
else{
	?>
	<h1>Users</h1>
	<table class="listing">
		<tr>
			<th>Username</th>
			<th>Group</th>
		</tr>
		<?
		if($users){
			$rowCount = 0;
			foreach ($users as $user) {
				?>
				<tr<? if ($rowCount % 2 == 1) { ?> class="bg"<? } ?>>
					<td><?= $user['login'] ?></td>
					<td><?= $user['name'] ?></td>
				</tr>
				<?
				$rowCount++;
			}
		}
		?>
	</table>
	<?
}
?>