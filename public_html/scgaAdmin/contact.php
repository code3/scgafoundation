<?php
$rand = rand(0, 10000000);
if(isset($_GET['f5'])){
	$rand = $_GET['f5'];
}
if(!isset($_GET['f5'])){
	?><div id="contact_container_<?= $rand ?>" class="contact_container"><?
}
?>
<form id="contact_del_form" action="<?= CLIENTROOT ?>/action/delete-contacts/?section=<?=$_GET['contact_area']?>&amp;sectionid=<?= $_GET['contact_areaid'] ?>" method="post">
<table class="listing">
	<tr>
		<th></th>
		<th></th>
		<th>Name</th>
		<th>Position</th>
		<th>Work</th>
		<th>Cell</th>
		<th>Email</th>
		<th>Primary</th>
	</tr>
	<?
		if(!$_contacts){
			?>
			<tr>
				<td colspan="3">No Contacts Yet</td>
			</tr>
			<?
		}
		else{
			$i = 0;
			foreach($_contacts as $contact){
				?>
				<tr<? if ($i % 2 == 1) { echo ' class="bg"'; } ?>>
					<td><input type="checkbox" id="checkBox_<?= $contact['contactid2'] ?>" value="<?= $contact['contactid2'] ?>" name="checked_contact[]" /></td>
					<td><a href="javascript:showContact('<?= $contact['contactid2'] ?>', '<?=$_GET['contact_area']?>', '<?= $_GET['contact_areaid'] ?>')" class="customTitle" title="Edit"><img src="<?= CLIENTROOT ?>/images/icons/24-pencil.png" alt="Edit" /></a> <? 
					?> <a onclick="confirm2(event, 'Delete Contact?', '$(\'checkBox_<?= $contact['contactid2']  ?>\').checked = true; $(\'contact_del_form\').submit()')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a>
					</td>
					<? if ($contact['lname'] == '' || $contact['fname']==''){ ?>
					<td><?= $contact['fname'] ?><?= $contact['lname'] ?></td><? } else { ?>
					<td><?= $contact['lname'] ?>, <?= $contact['fname'] ?></td> <? } ?>
					<td><?= $contact['position'] ?></td>
					<td><?= $contact['work'] ?></td>
					<td><?= $contact['cell'] ?></td>
					<td><?= $contact['email'] ?></td>
					<td><? if($contact['primary']){?>Primary<? } ?></td>
				</tr>
				<?
				$i++;
			}
		}
	?>
</table>
<? if($_contacts) { ?>
<input type="checkbox" id="checkAllBtn" onclick="checkAll('checked_contact[]', this.checked);" />&nbsp;Check All
	<br />
	<a onclick="confirm2(event, 'Delete all checked contacts?', '$(\'contact_del_form\').submit()')" class="customTitle" title="Delete Checked"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete Checked" /></a>
	<? } ?>
	</form>


<br />
<h1>Add contact: </h1>

<form target="contact_target_<?= $rand ?>" action="<?= CLIENTROOT ?>/action/add-contact/" method="post">
	<input type="hidden" name="contact_area" id="contact_area_<?= $rand ?>" value="<?= $_GET['contact_area'] ?>" />
	<input type="hidden" name="contact_areaid" id="contact_areaid_<?= $rand ?>" value="<?= $_GET['contact_areaid'] ?>" />
	<input type="hidden" name="contactid" id="contactid_<?= $rand ?>" value="<?= $_GET['contactid'] ?>" />
	<input type="hidden" name="contact_index" id="contact_index_<?= $rand ?>" value="<?= $rand ?>" />
	<label for="contact_fname">First Name:</label>
	<input type="text" name="fname" id="contact_fname_<?= $rand ?>" class="text" />
	<br />
	<label for="contact_lname">Last Name:</label>
	<input type="text" name="lname" id="contact_lname_<?= $rand ?>" class="text" />
	<br />
	<label for="contact_position">Position:</label>
	<input type="text" name="position" id="contact_position_<?= $rand ?>" class="text" />
	<br />
	<label for="contact_work">Work Phone:</label>
	<input type="text" name="work" id="contact_work_<?= $rand ?>" class="text" />
	<br />
	<label for="contact_cell">Cell Phone:</label>
	<input type="text" name="cell" id="contact_cell_<?= $rand ?>" class="text" />
	<br />
	<label for="contact_email">Email:</label>
	<input type="text" name="email" id="contact_email_<?= $rand ?>" class="text" />
	<br /><br />
	<label>&nbsp;</label>
	<input type="checkbox" name="primary" id="contact_primary_<?= $rand ?>" value="1"/>
	<label for="contact_primary_<?= $rand ?>" class="inline">Primary Contact</label> <br />
	<label>&nbsp;</label>
	<input type="submit" class="submit-button" value="Add Contact"/>
</form>
<iframe src="#" style="display:none;" name="contact_target_<?= $rand ?>"></iframe>
<?
if(!isset($_GET['f5'])){
	?></div><?
}
?>
