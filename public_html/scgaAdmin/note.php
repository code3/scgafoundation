<?php

$rand = rand(0, 10000000);
if(isset($_GET['f5'])){
	$rand = $_GET['f5'];
}
if(!isset($_GET['f5'])){
	?><div id="note_container_<?= $rand ?>" class="note_container"><?
}

?>
<table class="listing">
	<tr>
		<th></th>
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
				<td><a onclick="confirm2(event, 'Delete Note?', 'deleteNote(\'<?= $note['noteid2'] ?>\',\'<?= $_GET['note_area'] ?>\',\'<?= $_GET['noteid'] ?>\',\'<?= $rand ?>\',\'<?=$_GET['noteInForm']?>\')')" class="customTitle" title="Delete"><img src="<?= CLIENTROOT ?>/images/icons/24-em-cross.png" alt="Delete" /></a></td>
					<td valign="top"><?= $note['time'] ?></td>
					<td valign="top"><?= $note['by'] ?></td>
					<td><?= str_replace('\"','"',str_replace("\'","'",$note['note'])) ?></td>
				</tr>
				<?
				$i++;
			}
		}
	?>
</table><br />

	<h1>Add Note: </h1>
	<div>
		<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('u', '<?= $rand ?>')" class="customTitle" title="Underline"><u>u</u></button>
		<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('em', '<?= $rand ?>')" class="customTitle" title="Italics"><em>i</em></button>
		<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('strong', '<?= $rand ?>')" class="customTitle" title="Bold"><strong>b</strong></button>
		<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('r', '<?= $rand ?>')" class="customTitle" title="Red font"><font color="red">r</font></button>
		<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('b', '<?= $rand ?>')" class="customTitle" title="Blue font"><font color="blue">b</font></button>
		<button type="button" style="border:1px solid #000;" onclick="noteAddHtml('g', '<?= $rand ?>')" class="customTitle" title="Green font"><font color="green">g</font></button>
		<button type="button" style="border:1px solid #000;" onclick="showAdvanceHtmlEditor('add_new_note_<?= $rand ?>')" class="customTitle" title="Advance HTML Editor">Editor</button>
	</div><br/>
	<?
	if($_GET['noteInForm'] != '1'){
	?>
		<form target="note_target_<?= $rand ?>" action="<?= CLIENTROOT ?>/action/add-note/" method="post">
	<?
	}
	?>
	<input type="hidden" <? if($_GET['noteInForm'] != '1'){ echo 'name="note_area"'; } ?> id="note_area_<?= $rand ?>" value="<?= $_GET['note_area'] ?>" />
	<input type="hidden" <? if($_GET['noteInForm'] != '1'){ echo 'name="note_areaid"'; } ?> id="note_areaid_<?= $rand ?>" value="<?= $_GET['note_areaid'] ?>" />
	<input type="hidden" <? if($_GET['noteInForm'] != '1'){ echo 'name="noteid"'; } ?> id="noteid_<?= $rand ?>" value="<?= $_GET['noteid'] ?>" />
	<input type="hidden" <? if($_GET['noteInForm'] != '1'){ echo 'name="note_index"'; } ?> id="note_index_<?= $rand ?>" value="<?= $rand ?>" />
	<textarea <? if($_GET['noteInForm'] != '1'){ echo 'name="note"'; } ?> id="add_new_note_<?= $rand ?>" style="width:300px; height:100px;"></textarea>
	
	
	<?
	if($_GET['noteInForm'] != '1'){
	?>
		<input type="submit" value="Add Note" class="add-note" />
		</form>
		<iframe src="#" style="display:none;" name="note_target_<?= $rand ?>"></iframe>
	<?
	}
	else{
		?>
		<input type="button" value="Add Note" onclick="noteInFormAdd('<?= $rand ?>')" class="add-note" />
		<?
	}
	
	if(!isset($_GET['f5'])){
		?></div><?
	}

?>
