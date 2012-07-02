<div class="pop_container">
<h1>Add GAME to <?= $_kids['fname'] ?></h1>
<form id="select_game_form" action="<?= CLIENTROOT ?>/action/kids/save-game" method="post">
<input type="hidden" name="scga" value="<?= $_GET['scga'] ?>" />	
		
<label for="date_certified">Date Earned</label>
<input type="text" id="date" name="date" value="" class="val_req val_len 10"/>
<a href="javascript:sel('<?= CLIENTROOT ?>/ajax/calendar/?fieldid=date')" class="customTitle" title="Calendar"><img src="<?= CLIENTROOT ?>/images/icons/24-columns.png" alt="Calendar" /></a>
<br />

<label for="amount">Amount of Points:</label>
<input type="text" id="amount" name="amount" class="val_req val_num val_money" maxlength="<?= MAXLENA ?>" />
<br />
<label for="description">Description:</label>
<textarea type="text" id="description" name="description" class="val_max <?= MAXLEND ?> val_req"></textarea>
<br />

<label for="vtype">VAULT Type:</label>
<? htmlSel(array('Volunteer','Academic','University/Field Trip','Leadership', 'Tutoring', 'Debit: Points Spent'), 'id="vtype" name="vtype" multiple="multiple" class="val_req"', $_status, false, ''); ?>
<br />


<label>&nbsp;</label>
<input type="submit" value="Submit" />
</form>