<label for="address">Address:</label>
<input type="text" id="address" name="address" class="val_req" maxlength="<?= MAXLENA ?>" /><br />

<label for="address2"></label>
<input type="text" id="address2" name="address2" maxlength="<?= MAXLENA ?>" /><br />

<label for="city">City:</label>
<input type="text" id="city" name="city" class="val_req" maxlength="<?= MAXLENA ?>" /><br />

<label for="state">State:</label>
<? htmlSel($_states, 'id="state" name="state" class="val_req"','' , true, 'Please select...'); ?><br />

<label for="zip">Zip:</label><input name="zip" id="zip" maxlength="<?= MAXLENA ?>" class="val_req" type="text" />
<br />