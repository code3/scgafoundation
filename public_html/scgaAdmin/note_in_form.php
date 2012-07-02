<?
// this is to resolve the problem with having notes in a form tag
?>
<form style="display:none;" target="note_target_in_form" id="note_in_form" action="/icAdmin/action/add-note/" method="post">
<input type="hidden" name="note_area" id="note_area_in_form"/>
<input type="hidden" name="note_areaid" id="note_areaid_in_form"/>
<input type="hidden" name="noteid" id="noteid_in_form" />
<input type="hidden" name="note_index" id="note_index_in_form"/>
<textarea name="note" id="add_new_note_in_form" style="width:300px; height:100px;"></textarea>
<input type="hidden" name="note_inform" value="1" />
</form>
<iframe src="#" style="display:none;" name="note_target_in_form"></iframe>