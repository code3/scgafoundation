/*  no longer needed, using iframe scheme now, kept here just in case
function addNewNote(index){
	var noteid = $('note_id_'+index).value;
	var note = $('add_new_note_'+index).value;
	var noteArea = $('note_area_'+index).value;
	var noteAreaid = $('note_areaid_'+index).value;
	var url = window.CLIENTROOT+"/action/add-note/?k="+ Math.round(100000*Math.random());
	new Ajax.Request(url, { method: 'post', parameters: 'noteid='+noteid+'&note='+urlencode(note)+'&note_area='+noteArea+'&note_areaid='+noteAreaid,  onSuccess: function(addNewNote2) {
			if(isNaN(addNewNote2.responseText)){
				alert2('Unable to add note contact site administrator please. Error:'+addNewNote2.responseText);	
			}
			else{
				refreshNote(addNewNote2.responseText, index);	
			}
		}
	}); 
}*/

function noteInFormAdd(index){
	$('note_area_in_form').value = $('note_area_'+index).value;
	$('note_areaid_in_form').value = $('note_areaid_'+index).value;
	$('noteid_in_form').value = $('noteid_'+index).value;
	$('note_index_in_form').value = $('note_index_'+index).value;
	$('add_new_note_in_form').value = $('add_new_note_'+index).value;
	$('note_in_form').submit();
}

function refreshNote(noteid, index, noteInForm){
	$('add_new_note_'+index).value =  '';
	var noteArea = $('note_area_'+index).value;
	var noteAreaid = $('note_areaid_'+index).value;
	var url = window.CLIENTROOT+"/ajax/note/?k=" + Math.round(100000*Math.random())+"&f5="+index+'&noteid='+noteid+'&note_area='+noteArea+'&note_areaid='+noteAreaid+'&noteInForm='+noteInForm;
	new Ajax.Request(url, { method: 'get',  onSuccess: function(refreshNote2) {
			$('note_container_'+index).innerHTML = refreshNote2.responseText;
		}
	}); 
}


function deleteNote(noteid2,section,noteid,note_index,note_inform){
	var url = window.CLIENTROOT+"/action/delete-note/?noteid2="+noteid2+"&section="+section+"&noteid="+noteid+"&note_index="+note_index+"&note_inform="+note_inform;
	new Ajax.Request(url, { method: 'get',  onSuccess: function(deleteNote2) {
			refreshNote(noteid, note_index,note_inform);
		}
	}); 
	
}

function noteAddHtml(tag, index){
	switch(tag){
		case 'u':
			$('add_new_note_'+index).value += '<u></u>';
		break;
		case 'strong':
			$('add_new_note_'+index).value += '<strong></strong>';
		break;
		case 'em':
			$('add_new_note_'+index).value += '<em></em>';
		break;
		case 'r':
			$('add_new_note_'+index).value += '<font color="red"></font>';
		break;
		case 'b':
			$('add_new_note_'+index).value += '<font color="blue"></font>';
		break;
		case 'g':
			$('add_new_note_'+index).value += '<font color="green"></font>';
		break;
	}
}
