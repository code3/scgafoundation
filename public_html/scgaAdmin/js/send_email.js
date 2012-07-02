function showEmailForm(section, numOfRecipiants, sameLayer){
	var url = window.CLIENTROOT+'/ajax/email_form?section='+section+ '&number='+numOfRecipiants;
	
	if(!sameLayer){
		curtain.load();
	}
		
	new Ajax.Request(url, { method: 'get', onSuccess: function(showEmailForm2) {
		curtain.content(showEmailForm2.responseText,sameLayer);
		setTimeout("valForm.init('email_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	
	} 
	}); 
}

function showEmailFormSingle(email, name){
	var url = window.CLIENTROOT+'/ajax/email_form?email='+email+'&name='+name;
	curtain.load();
	new Ajax.Request(url, { method: 'get', onSuccess: function(showEmailFormSingle2) {
		curtain.content(showEmailFormSingle2.responseText);
		setTimeout("valForm.init('email_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	
	} 
	}); 
}

function sendTempPasswordEmail(){
	valForm.stopSubmit=true;
	$('email_form').action = window.CLIENTROOT+'/action/send-temp-pass-email/';
	$('email_form').submit();
}


function sendEmail(){
	valForm.stopSubmit=true;
	var the_url = window.location.href;
	var searchValues = the_url.split('?');
	if(!(searchValues[1])){
		searchValues[1]='';
	}
	//alert(searchValues[1]);
	//var url = window.CLIENTROOT+'/action/manual-email/?'+searchValues[1];
	//alert(url);
	$('email_form').action = window.CLIENTROOT+'/action/manual-email/?'+searchValues[1];
	$('email_form').submit();
}

function sendTestEmail(section){
	if($('email_from_name').value.strip().length == 0){
		alert2('From is required.');
		return;
	}
	if($('email_from').value.strip().length == 0){
		alert2('From Email is required.');	
		return;
	}
	$('email_form').action = window.CLIENTROOT+'/action/send-test-email/';
	$('email_form').submit();
}