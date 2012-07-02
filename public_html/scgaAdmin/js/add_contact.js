function refreshContact(contactid, index, contactInForm){
	$('contact_fname_'+index).value =  '';
	$('contact_lname_'+index).value =  '';
	$('contact_position_'+index).value =  '';
	$('contact_work_'+index).value =  '';
	$('contact_cell_'+index).value =  '';
	$('contact_email_'+index).value =  '';
	
	var contactArea = $('contact_area_'+index).value;
	var contactAreaid = $('contact_areaid_'+index).value;
	var url = window.CLIENTROOT+"/ajax/contact/?k=" + Math.round(100000*Math.random())+"&f5="+index+'&contactid='+contactid+'&contact_area='+contactArea+'&contact_areaid='+contactAreaid+'&contactInForm='+contactInForm;
	new Ajax.Request(url, { method: 'get',  onSuccess: function(refreshContact2) {
			$('contact_container_'+index).innerHTML = refreshContact2.responseText;
		}
	});
	
}

function showContact(contactid2, section, sectionid){
	var url = window.CLIENTROOT+"/ajax/edit-contact/?k="+ Math.round(100000*Math.random()) +"&contactid2="+contactid2+"&section="+section+"&sectionid="+sectionid;
	curtain.load();
	new Ajax.Request(url, { method: 'get', onSuccess: function(showContact2) {
			curtain.content(showContact2.responseText);
			setTimeout("customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	//set input, css, js, events handling 
		} 
	}); 
}