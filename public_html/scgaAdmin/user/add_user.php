<div class="pop_container" >
<h1>Add User</h1>
<p>&nbsp;</p>
<form id="select_user_form" action="<?= CLIENTROOT ?>/action/user/add-user/" method="post" onsubmit="checkUserExist();">
<div id="add_user_msg"></div>
<label for="login" >Username:</label><input id="login" type="text" name="login" autocomplete="off" class="val_req"/><br />
<label for="password">Password:</label><input id="password" type="password" name="password" autocomplete="off" class="val_req val_min 6"/><br />
<label for="password_retype">Re-enter Password:</label><input id="password_retype" type="password" name="password_retype" class="val_req val_same password" /><br />
<label for="login_groupid">Group:</label>
<?
htmlSel($_groupSelect,'id="login_groupid" name="login_groupid" class="val_req"','', true,"Please Select...");
?>
<br />
<input type="submit" id="add" name="add" value="Add" />
</form><br />


</div>