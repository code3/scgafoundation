<br />
<input type="hidden" id="csv_exportTypeHide" name="csv_exportTypeHide" value="win" />
<a href="javascript:toggle('export_fields');" class="toggle_title" onclick="this.blur();">Export fields:</a>
<div id="export_fields" class="toggle_field">
<?
$j=1;
foreach($_excel_cols as $field=>$header){
	?><input type="checkbox" name = 'csv_<?=$field?>' id='csv_<?=$field?>' onclick="if(this.checked){ var i = 1;} else{ var i = 0; } $('csv_<?= $field ?>').value = i; " checked="checked" /> <?= $header ?>&nbsp;&nbsp;<?
	if($j == 6 || $j==12 || $j==16){?>
		<br /><br /><?
	}
	$j++;
} 
	?>
<br />