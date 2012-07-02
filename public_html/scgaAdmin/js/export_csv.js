function exportCsv(fields,section){
	
	var the_url = window.location.href;
	var searchValues = the_url.split('?');
	if(!(searchValues[1])){
		searchValues[1]='';
	}
	else{
		searchValues[1]+='&';
	}
	var list=new Array();
	for (var i =0; i < fields.length; i++){
		list[i]='csv_'+fields[i] +'=' +$('csv_'+fields[i]).value;
	}
	
	var newList=list.join("&");
	window.location = window.CLIENTROOT+'/action/export-csv/?section=' + section+ '&'+ searchValues[1] + newList;
	
	
}