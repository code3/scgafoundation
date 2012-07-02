function showAdvanceHtmlEditor(fieldid){
	var url = window.CLIENTROOT+'/ajax/html-editor/?fieldid='+fieldid;
	curtain.load();
	new Ajax.Request(url, { method: 'get', onSuccess: function(showAdvanceHtmlEditor2) {
			curtain.content(showAdvanceHtmlEditor2.responseText);
		} 
	}); 	
}

function transferAdvanceHtml(fieldid, advHtml){
	$(fieldid).value = advHtml;
	curtain.close();
}