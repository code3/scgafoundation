<div class="pop_container">
<? foreach($_onlineDonationFields as $field => $name){?>
<label for=" $field"><strong><?=$name?></strong></label>
<div class="value-2"><?=$_online_donation[ $field]?></div>
<br />
<? } ?>
</div>