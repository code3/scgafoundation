<script type="text/javascript">
	<!--
	var currentScgaIndex = 0;
	document.onkeydown = getKeyCode;
	function getKeyCode(e){
		var keycode;
		if (window.event) {
			keycode = window.event.keyCode;
		}
		else if (e) {
			keycode = e.which;
		}
		
		if (keycode == 9) { // tab
			goToNextScga(e);
		}
	}
	//-->
</script>

<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/library/js/select.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/export_csv.js"></script>
<script language="javascript" type="text/javascript" src="<?= CLIENTROOT ?>/js/add.js"></script>
<script type="text/javascript">
	<!--
	function addTrackingErrorHandler(error, value, row, edit){
		$('form_addTrackingSubmit').disabled = false; //val form disables it
		switch(error){
			case 0:
				if(edit){
					window.location = window.CLIENTROOT + '/tracking/main/';
				}
				else{
					window.location = window.CLIENTROOT + '/tracking/main/';
				}
				break;
			case 1:
				$('form_addTrackingError').innerHTML 		= 'Facility ' + value + ' does not exist on row ' + row;
				$('form_addTrackingError').style.display 	= 'block';
				break;
			case 2:
				$('form_addTrackingError').innerHTML 		= '<p class="error">SCGA ' + value + ' does not exist on row ' + row + '</p>';
				$('form_addTrackingError').style.display 	= 'block';
				break;
			case 3:
				$('form_addTrackingError').innerHTML 		= 'An entry already exists for ' + value + ' on row ' + row;
				$('form_addTrackingError').style.display 	= 'block';
				break;
			case 4:
				$('form_addTrackingError').innerHTML = 'A type is required for row '+row;
				$('form_addTrackingError').style.display = 'block';
				break;
			
		}
		
	}
	
	function check_all(section, numRecords, trueFalse){
		for(var i = 0; i < numRecords; i++){
			$(section + i).checked = trueFalse;
		}
	}
	
	function goToNextScga(e){
		if ($('select_tracking_form') != null) {
			if ($('scga' + currentScgaIndex) == null) {
				currentScgaIndex = 0;
			}
			
			$('scga' + currentScgaIndex).focus();
			currentScgaIndex += 1;
			
			if (window.event) {
				window.event.returnValue = false;
			}
			else if (e) {
				Event.stop(e);
			}
			
		}
	}
	
	function updateCurrentScgaIndex(current){
		currentScgaIndex = current + 1;
	}
	
	function setCurrentScgaIndex(current){
		currentScgaIndex = current;
	}
	
	function clearTrackingRow(row) {
		var trackingFields = new Array('date'
									   , 'scga'
									   , 'oldScga'
									   , 'trackingid'
									   , 'facility'
									   , 'oldFacilityName'
									   , 'range'
									   , 'course');
		var inputType = '';
		
		for (var i = 0; i < trackingFields.length; i++) {
			if ($(trackingFields[i] + row) != null) {
				inputType = $(trackingFields[i] + row).type.toLowerCase();
				if (inputType == 'checkbox' || inputType == 'radio') {
					$(trackingFields[i] + row).checked = false;
				}
				else {
					$(trackingFields[i] + row).value = '';
				}
			}
		}
	}
		
	//-->
</script>
