<div class="pop_container">
<h1>Edit Contact</h1>
<form id="contact_form" action="<?= CLIENTROOT ?>/action/edit_contact/" method="post">
<input type="hidden" name="contact_area" value="<?= $_GET['section'] ?>" />
<input type="hidden" name="contact_areaid" value="<?= $_GET['sectionid'] ?>" />
<input type="hidden" name="contactid2" value="<?= $_GET['contactid2'] ?>" />
<label for="contact_fname">First Name:</label>
<input type="text" name="fname" value="<?=$_contact['fname']?>" />
<label for="contact_lname">Last Name:</label>
<input type="text" name="lname" value="<?=$_contact['lname']?>" /><br />
<label for="contact_position">Position:</label>
<input type="text" name="position" value="<?=$_contact['position']?>" />
<label for="contact_work">Work Phone:</label>
<input type="text" name="work" value="<?=$_contact['work']?>" /><br />
<label for="contact_cell">Cell Phone:</label>
<input type="text" name="cell" value="<?=$_contact['cell']?>" />
<label for="contact_email">Email:</label>
<input type="text" name="email" value="<?=$_contact['email']?>" /><br />
<br />
<label>&nbsp;</label>
<input type="checkbox" name="primary" id="contact_primary" <? if ($_contact['primary']){ ?> checked="checked" <? } ?> value="1" class="checkbox" />
<label for="contact_primary">&nbsp;&nbsp;Primary Contact</label> <br />

<input type="submit" value="Edit contact" />
</form>