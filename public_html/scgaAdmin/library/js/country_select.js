function countrySelect(countryVal, stateCont, provCont, stateField, provField, ccCont, ccField  ){
	if(countryVal == 'US'){//USA
		$(stateCont).style.display = 'block';
		$(stateField).addClassName('val_req');
		$(provCont).style.display = 'none';
		$(provField).value = '';
		$(provField).removeClassName('val_req');
		
		if(ccCont){
			$(ccCont).style.display = 'none';
			$(ccField).removeClassName('val_req');
		}
	}
	else{
		$(provCont).style.display = 'block';
		$(provField).addClassName('val_req');
		$(stateCont).style.display = 'none';
		$(stateField).removeClassName('val_req');
		$(stateField).value = '';
		
		if(ccCont){
			$(ccCont).style.display = 'block';
			$(ccField).addClassName('val_req');
		}
	}
}