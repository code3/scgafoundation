function sel(url, sameLayer){
	
	if(!sameLayer){
		curtain.load();	
	}
	
	new Ajax.Request(url, { method: 'get',  onSuccess: function(sel2) {
			if(sameLayer == true){
				curtain.content(sel2.responseText, true);
			}
			else{
				curtain.content(sel2.responseText);
			}
			rewritePgl("sel('%url%', true)");
			customTitle.init('curtain_contentLayer'+curtain.index);
		} 
	}); 	
}

function sel2(name, fieldID){
	$(fieldID).value = name;
	$(fieldID).focus(); //fake as if a user entered the value
	$(fieldID).blur();
	customTitle.hide();
	curtain.close();
}