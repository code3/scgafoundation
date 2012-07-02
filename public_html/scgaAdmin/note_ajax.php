<?php
$rand = rand(0, 10000000);
if(isset($_GET['f5'])){
	$rand = $_GET['f5'];
}
if(!isset($_GET['f5'])){
	?><div id="note_container_<?= $rand ?>" class="pop_container"><?
}
?>
<table class="listing">
	<tr>
		<th>Date / Time</th>
		<th>By</th>
		<th>Note</th>
	</tr>
	<?
		if(!$_notes){
			?>
			<tr>
				<td colspan="3">No Notes Yet</td>
			</tr>
			<?
		}
		else{
			$i = 0;
			foreach($_notes as $note){
				?>
				<tr<? if ($i % 2 == 1) { echo ' class="bg"'; } ?>>
					<td valign="top"><?= $note['time'] ?></td>
					<td valign="top"><?= $note['by'] ?></td>
					<td><?= $note['note'] ?></td>
				</tr>
				<?
				$i++;
			}
		}
	?>
</table>
Add Note: <br /><br />
<div>
	<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('u', '<?= $rand ?>')" class="customTitle" title="Underline" /><u>u</u></button>
	<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('em', '<?= $rand ?>')" class="customTitle" title="Italics" /><em>i</em></button>
	<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('strong', '<?= $rand ?>')" class="customTitle" title="Bold" /><strong>b</strong></button>
	<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('r', '<?= $rand ?>')" class="customTitle" title="Red font" /><font color="red">r</font></button>
	<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('b', '<?= $rand ?>')" class="customTitle" title="Blue font" /><font color="blue">b</font></button>
	<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('g', '<?= $rand ?>')" class="customTitle" title="Green font" /><font color="green">g</font></button>
	<button type="button" style="border:1px solid #000;" onclick="showAdvanceHtmlEditor('add_new_note_<?= $rand ?>')" class="customTitle" title="Advance HTML Editor" />Editor</button>
</div><br/>
<textarea id="add_new_note_<?= $rand ?>" style="width:300px; height:100px;"></textarea>
<input type="hidden" id="note_area_<?= $rand ?>" value="<?= $_GET['note_area'] ?>" />
<input type="hidden" id="note_areaid_<?= $rand ?>" value="<?= $_GET['note_areaid'] ?>" />
<input type="button" onclick="addNewNote('<?= $rand ?>')" value="Add Note">
<input type="hidden" id="note_id_<?= $rand ?>" value="<?= $_GET['noteid'] ?>" />
<?
if(!isset($_GET['f5'])){
	?></div><?
}
?>
