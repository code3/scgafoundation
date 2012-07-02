

function popUpA(URL) { //allow all features

day = new Date();

id = "aboutUS";

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=1,scrollbars=1,location=1,statusbar=1,menubar=1,resizable=1,width=900,height=400,left = 240,top = 212');");

}



function popUpB(URL) { // disable all features

day = new Date();

id = "aboutUS";

eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=300,height=300,left = 240,top = 212');");

}



function isset(obj){

	if(typeof obj == 'undefined'){

		return false;

	}

	else{

		return true;	

	}

}

function toggle(obj) {

	var el = document.getElementById(obj);

	el.style.display = (el.style.display != 'block' ? 'block' : 'none' );

}



function getMousePos(e) {

	var IE = document.all?true:false

	var scrollXY = getScrollXY();

	var mousePos = new Array();

	if (IE) { // grab the x-y pos.s if browser is IE

		tempX = e.x;

		tempY = e.y;

	} 

	else {  // grab the x-y pos.s if browser is NS

		tempX = e.clientX;

		tempY = e.clientY;

	}

	// catch possible negative values in NS4

	if (tempX < 0){tempX = 0}

	if (tempY < 0){tempY = 0}  

	mousePos['x'] = tempX + scrollXY[0];

	mousePos['y'] = tempY + scrollXY[1];

	return mousePos;

}





function getScrollXY() {

  var scrOfX = 0, scrOfY = 0;

  if( typeof( window.pageYOffset ) == 'number' ) {

    //Netscape compliant

    scrOfY = window.pageYOffset;

    scrOfX = window.pageXOffset;

  } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {

    //DOM compliant

    scrOfY = document.body.scrollTop;

    scrOfX = document.body.scrollLeft;

  } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {

    //IE6 standards compliant mode

    scrOfY = document.documentElement.scrollTop;

    scrOfX = document.documentElement.scrollLeft;

  }

  return [ scrOfX, scrOfY ];

}



function getPageDim(){

	if(document.all?true:false){ // IE

		if(document.body.clientHeight > document.body.scrollHeight){

			var height = document.body.clientHeight;

			var width = document.body.clientWidth;

		}

		else{

			var height = document.body.scrollHeight;

			var width = document.body.scrollWidth;

		}

	}

	else{

		var height = document.height;

		var width = document.weidth;

	}	

	return [ width, height ];

}



function alert2(text, dim, alertTime){ 

	

	var alert2 = document.createElement('div');

	alert2.id = 'alert2';

	alert2.style.visibility = 'hidden';

	document.body.appendChild(alert2);

	

	alert2 = $('alert2');

	alert2.addClassName('alert2');

	if(dim){

		width = dim[0];

		height = dim[1];

		alert2.style.width = width+'px';

		alert2.style.height = height+'px';

	}

	else{

		width = alert2.getWidth();

		height = alert2.getHeight();

	}

	if(isNaN(width) || isNaN(height)){

		alert('Alert2() error, width or height isNaN');	

	}

	

	var xy = getScrollXY(); 

	var topLeft = getTopLeft(width, height);

	alert2.style.top = topLeft[0]+'%';

	alert2.style.left = topLeft[1]+'%';

	alert2.innerHTML = text;

	alert2.style.visibility = 'visible';

	if(!alertTime){

		alertTime = 2000;	

	}

	setTimeout("document.body.removeChild(document.getElementById('alert2'))", alertTime);

}



//return the top left percentage for an absolute centered layer

function getTopLeft(width, height){

	var fakeDiv = document.createElement('div');

	fakeDiv.id = 'getTopLeft-fake-body';

	fakeDiv.style.visibility = 'hidden';

	fakeDiv.style.margin = '0';

	fakeDiv.style.padding = '0';

	fakeDiv.style.position = 'absolute';

	fakeDiv.style.top = '0';

	fakeDiv.style.bottom = '0';

	fakeDiv.style.left = '0';

	fakeDiv.style.right = '0';

	fakeDiv.style.width = '100%';

	fakeDiv.style.height = '100%';

	fakeDiv.style.zIndex = '-1';

	

	document.body.appendChild(fakeDiv);

	

	var fakeDiv = $('getTopLeft-fake-body');

	var windowHeight = fakeDiv.getHeight();

	var windowWidth = fakeDiv.getWidth();

	document.body.removeChild(fakeDiv);

	

	var ie = getIEVerNum();

	

	//compensate for scroll

	var xy = getScrollXY();

	

	//get %

	var top = (windowHeight/2 + xy[1] - (height/2)) / windowHeight;

	var left = (windowWidth/2 + xy[0] - (width/2)) / windowWidth;



	if(top < 0){

		top = 0;	

	}

	if(left <0){

		left = 0;	

	}

	

	//compensate for ie 6 usage of %, the entire document not just what u see is 100%

	if(ie == 6){ // ie 6

		var pxHeight = windowHeight * top; //get pixel height

		top = pxHeight/document.body.clientHeight; // get decimal height

	}

	

	top  = Math.round(top * 100); 

	left  = Math.round(left * 100);

			

	return [ top, left ];

}



function money(num){

	var formated = Math.round(num*100)/100;

	formated = formated.toString();

	if(formated.indexOf('.') == -1){

		formated += '.00';

	}

	else{

		var parts = formated.split('.');

		if(parts[1].length == 1){

			formated += '0';	

		}

	}

	return formated;

}



function urlencode(str) {

	str = escape(str);

	str = str.replace('+', '%2B');

	str = str.replace('%20', '+');

	str = str.replace('*', '%2A');

	str = str.replace('/', '%2F');

	str = str.replace('@', '%40');

	return str;

}



function urldecode(str) {

	str = str.replace('+', ' ');

	str = unescape(str);

	return str;

}



function htmlentities(html) {

	html = html.replace('<','&lt;');

	html = html.replace('>','&gt;');

	html = html.replace('"','&quot;');

	return html;

} 



function getJs(url){

	if(url.indexOf('?')==-1) {

		url += '?';	

	}

	var jsel = document.createElement('SCRIPT');

	jsel.type = 'text/javascript';

	jsel.src = url+'&klioe='+Math.random()*10000;

	document.body.appendChild(jsel);

}



//Get IE Version Number

function getIEVerNum() {

    var ua = navigator.userAgent;

    var MSIEOffset = ua.indexOf("MSIE ");

    

    if (MSIEOffset == -1) {

        return 0;

    } else {

        return parseFloat(ua.substring(MSIEOffset + 5, ua.indexOf(";", MSIEOffset)));

    }

}



function confirm2(e, title, yesEval, noEval){

	var delConfirm = document.createElement('div');

	delConfirm.id = 'confirm2';

	document.body.appendChild(delConfirm);

	

	delConfirm = $('confirm2');

	delConfirm.addClassName('confirm2');

	delConfirm.innerHTML = '<div>'+title+'</div><input type="button" id="confirm2_yes" value="Yes"/><br/><input type="button" id="confirm2_no" value="No" />';

	

	var mousePos = getMousePos(e);

	delConfirm.style.left=mousePos['x']+'px';

	delConfirm.style.top=mousePos['y']+'px';

	$('confirm2_yes').onclick= function(){ 

		document.body.removeChild($('confirm2'));

		eval(yesEval); 

	}

	$('confirm2_no').onclick= function(){ 

		document.body.removeChild($('confirm2'));

		eval(noEval); 

	}

}



function checkAll(name, trueFalse){

	var checkBoxes = document.getElementsByName(name);

	var len = checkBoxes.length;

	for(var i=0; i<len; i++){

		checkBoxes[i].checked = trueFalse;

	}

}

// Reset form fields
function clearForm(id) {
	var form = $(id);
	for (var i = 0; i < form.length; i++) {
		if(form[i].type == 'submit' || form[i].type == 'button' || form[i].type == 'hidden'){
			continue;
		}
		if(form[i].type == 'checkbox' || form[i].type == 'radio') {
			form[i].checked = false;	
		}
		if(form[i].options){ // drop downs
			form[i].selectedIndex = 0;
		}
		else {
			form[i].value = '';
		}
		
	}
}