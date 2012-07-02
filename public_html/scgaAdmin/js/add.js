function showAdd(section, sectionid){
	if(section== 'grant' || section=='donation'){
		var url = window.CLIENTROOT+"/ajax/organization/add-"+section+"/?k="+ Math.round(100000*Math.random()) +"&organizationid="+sectionid;
	}
	else if (section== 'certification'){
		var url = window.CLIENTROOT+"/ajax/kids/add-"+section+"/?k="+ Math.round(100000*Math.random()) +"&scga="+sectionid;
	}
	else if (section== 'certification2'){
		
		var url = window.CLIENTROOT+"/ajax/kids/add-certification/?k="+ Math.round(100000*Math.random()) +"&certificationid="+sectionid;
		
	}
	else if (section== 'game'){
		
		var url = window.CLIENTROOT+"/ajax/kids/add-game/?k="+ Math.round(100000*Math.random()) +"&scga="+sectionid;
		
	}
	else{
		var url = window.CLIENTROOT+"/ajax/"+section+"/add-"+section+"/?k="+ Math.round(100000*Math.random()) +"&"+section+"id="+sectionid;
	}
	curtain.load();
	new Ajax.Request(url, { method: 'get', onSuccess: function(showDetails2) {
		curtain.content(showDetails2.responseText);
		setTimeout("valForm.init('select_"+section+"_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	//set input, css, js, events handling 
		} 
	}); 
}

function showAddNumber(section){
	var url = window.CLIENTROOT+"/ajax/add_number/?k="+ Math.round(100000*Math.random()) + "&section="+section;
	curtain.load();
	new Ajax.Request(url, { method: 'get',  onSuccess: function(showAddNumber2) {
		curtain.content(showAddNumber2.responseText);
		}
	});
}

function showAddMultiple(section){
	if (section == 'tracking') {
		currentScgaIndex = 0;
	}
	
	var num = $('number').value;
	
	var url = window.CLIENTROOT+"/ajax/"+section+"/add-"+section+"/?number="+num+"&k="+ Math.round(100000*Math.random());
	curtain.load();
	new Ajax.Request(url, { method: 'get',  onSuccess: function(showAddMultiple2) {
		curtain.content(showAddMultiple2.responseText);
		setTimeout("valForm.init('select_"+section+"_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	
		
		}
	});
}
function showEditMultiple(section,number){
	var idStr='';
	var numChecked = 0;
	//make a string out of the id's
	for(var j = 0; j < number; j++){
		var checkbox = $('checkBox_'+j);
		if(checkbox.checked){
			idStr = idStr + checkbox.value;
			idStr = idStr + '*';
			numChecked++;
		}
	}
	if(idStr==''){
		window.location = window.CLIENTROOT+'/'+section+'/main/';
	}
	else{
		var url = window.CLIENTROOT+"/ajax/"+section+"/edit_"+section+"/?number="+numChecked+"&"+section+"Str="+idStr;//query string variable for specific kid
		//alert(url);
		curtain.load();
		new Ajax.Request(url, { method: 'get', onSuccess: function(showEditMultiple2) { //ajax gets info from db results in showEditMultiple2.responseText
			curtain.content(showEditMultiple2.responseText);
			setTimeout("valForm.init('select_"+section+"_form'); customTitle.init('curtain_contentLayer"+curtain.index+"')" , 100);	//set input, css, js, events handling 
			} 
		}); 
		
	}
}
function populate_all(section,numRecords){
	var num = numRecords;
	if ($('populate_all_'+section).checked) {
		for(var i=0; i<numRecords; i++){
			$(section+i).value = $('all_'+section).value;
		}
	}
	
}