/*01/15/08*/
/*
Copyright © 2008 Eckx Media Group, LLC. All rights reserved.
Eckx Media Group respects the intellectual property of others, and we ask our users to do the same.
*/
/*
note* make sure u initilize new elements
allow html element to have a customizable ALT/TITLE text affect.
usuage: set class to either customTitleClick and customTitle
	customTitleClick for onClick event
	customTitle for onmouseover event
*/

var customTitle = {
	titleList : new Array(),
	counter: 0,
	init: function(){
		Event.stopObserving(window, 'load', customTitle.init);
		
		var workingElement = document.body;
		if(arguments[1]){ //only set events for a certain object
			var element = $(arguments[1]);
			var mouseOverList = element.select('.customTitle'); 
			var clickList = element.select('.customTitleClick'); // get by class
		}
		else{//set event for all
			var mouseOverList = $$('.customTitle'); 
			var clickList = $$('.customTitleClick');
		}
		
		for(var i=0; i<mouseOverList.length; i++){
			if(mouseOverList[i].title == ''){
				continue;	
			}
			Event.observe(mouseOverList[i], 'mouseover', customTitle.show.bindAsEventListener(mouseOverList[i], customTitle.counter));
			Event.observe(mouseOverList[i], 'mouseout', customTitle.hide.bindAsEventListener());
			customTitle.titleList[customTitle.counter] = mouseOverList[i].title;
			mouseOverList[i].title = '';
			customTitle.counter++;
		}
		//click
		for(var i=0; i<clickList.length; i++){
			if(clickList[i].title == ''){
				continue;	
			}
			Event.observe(clickList[i], 'click', customTitle.show.bindAsEventListener(clickList[i], customTitle.counter));
			Event.observe(clickList[i], 'mouseout', customTitle.hide.bindAsEventListener());
			customTitle.titleList[customTitle.counter] = clickList[i].title;
			clickList[i].title = '';
			customTitle.counter++;
		}
		 
	},
	
	show: function(event) {
		var top = 10;
		var left = 10;
		//--
		var mousePos = getMousePos(event);
		
		var newPop = document.createElement('div');
		newPop.id = 'customTitle';
		newPop.visibility = 'hidden';
		document.body.appendChild(newPop);
		newPop = $('customTitle');
		newPop.addClassName('customTitlePop');
		newPop.style.top = mousePos['y'] + top+'px';
		newPop.style.left = mousePos['x'] + left+'px';
		newPop.innerHTML = customTitle.titleList[$A(arguments)[1]];
		newPop.visibility = 'visible';
		
	},
	
	hide: function(event) {
		if($('customTitle')){
			document.body.removeChild($('customTitle')); //causes problems if done quickly
		}
	}
	
	
};

Event.observe(window, 'load', customTitle.init); 