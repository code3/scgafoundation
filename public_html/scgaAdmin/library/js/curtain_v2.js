 /*01/15/08*/
/*
Copyright © 2008 Eckx Media Group, LLC. All rights reserved.
Eckx Media Group respects the intellectual property of others, and we ask our users to do the same.
*/

 var curtain = { index: -1, expandView: false, hideSelects: new Array(), init: function(){
 curtain.index = -1; var blinds = document.createElement('div'); blinds.id = 'curtain_blinds'; document.body.appendChild(blinds);
 Event.stopObserving(window, 'load', curtain.init); }, load: function(){ curtain.openBlinds(); var V78dd1de0 = document.createElement('div');
V78dd1de0.id = 'curtain_load'; document.body.appendChild(V78dd1de0); V78dd1de0 = $('curtain_load');
V78dd1de0.addClassName('curtain_load'); V79ad18f7 = getTopLeft(V78dd1de0.getWidth(), V78dd1de0.getHeight());
V78dd1de0.style.top = V79ad18f7[0]+'%'; V78dd1de0.style.left = V79ad18f7[1]+'%'; V78dd1de0.style.zIndex = curtain.index + 1;
V78dd1de0.innerHTML = 'Loading...'; }, content: function(html, sameLayer, width, height){ if(sameLayer == true){ 
 if(!$('curtain_popUp'+curtain.index)){ alert('curtain error: samelayer is set, but theres no curtain layer yet'); 
 } document.body.removeChild($('curtain_popUp'+curtain.index)); curtain.content(html, false, width, height);
return; } if($('curtain_load')){ document.body.removeChild($('curtain_load')); } 
 var Vf9039d90 = document.createElement('div');
var Ve6e48e35 = document.createElement('div'); var V3c559b6d = document.createElement('div'); Vf9039d90.id = 'curtain_popUp'+curtain.index;
Ve6e48e35.id = 'curtain_closeLayer'+curtain.index; V3c559b6d.id = 'curtain_contentLayer'+curtain.index;

 Vf9039d90.appendChild(Ve6e48e35); Vf9039d90.appendChild(V3c559b6d); document.body.appendChild(Vf9039d90);

 Vf9039d90 = $('curtain_popUp'+curtain.index); Ve6e48e35 = $('curtain_closeLayer'+curtain.index);
V3c559b6d = $('curtain_contentLayer'+curtain.index); Vf9039d90.style.visibility = 'hidden'; Vf9039d90.addClassName('curtain_popUp');
Ve6e48e35.addClassName('curtain_close'); 
 closeLayerHtml = '<a class="expand" href="javascript:curtain.expand()" id="curtain_expand'+curtain.index+'"></a>';
closeLayerHtml += '<a class="close" href="javascript:curtain.close()"></a><br style="clear: both;"/>';
Ve6e48e35.innerHTML = closeLayerHtml; V3c559b6d.innerHTML = html; V3c559b6d.addClassName('curtain_content');
 if(curtain.expandView){ curtain.expand(); } else if(isNaN(width) || isNaN(height)){ curtain.autoSize();
} else{ curtain.resizeContent(width, height); } Vf9039d90.style.zIndex = curtain.index + 1; Vf9039d90.style.visibility = 'visible';
}, autoSize: function(){ 
 var Vf9039d90 = $('curtain_popUp'+curtain.index); var V3c559b6d = $('curtain_contentLayer'+curtain.index);
var contentInner = V3c559b6d.firstDescendant(); var Ve6e48e35 = $('curtain_closeLayer'+curtain.index);
width = contentInner.getWidth(); height = contentInner.getHeight(); 
 var V76d05b51 = curtain.maxDim();
maxW = V76d05b51[0]; maxH = V76d05b51[1]; if(height >= (maxH - 25)){ height = maxH - 50; } if(width >= (maxW - 25)){
 width = maxW - 25; } V3c559b6d.style.height = height+'px'; height += Ve6e48e35.getHeight(); width += 18; 
 var V79ad18f7 = getTopLeft(width, height); Vf9039d90.style.width = width+'px'; Vf9039d90.style.height = height+'px';
Vf9039d90.style.top = V79ad18f7[0]+'%'; Vf9039d90.style.left = V79ad18f7[1]+'%'; }, resizeContent: function(width, height){
 var Vf9039d90 = $('curtain_popUp'+curtain.index); var V3c559b6d = $('curtain_contentLayer'+curtain.index);
var Ve6e48e35 = $('curtain_closeLayer'+curtain.index); var V79ad18f7 = getTopLeft(width, height); Vf9039d90.style.width = width+'px';
Vf9039d90.style.height = height+'px'; Vf9039d90.style.top = V79ad18f7[0]+'%'; Vf9039d90.style.left = V79ad18f7[1]+'%';
V3c559b6d.style.height = (height - Ve6e48e35.getHeight())+'px'; }, maxDim: function(){ var V25400724 = getIEVerNum();
if(V25400724 == 6){ var maxH = document.documentElement.clientHeight; var maxW = document.documentElement.clientWidth;
} else{ var maxH = document.body.clientHeight; var maxW = document.body.clientWidth; } return [maxW, maxH];
}, close: function(){ document.body.removeChild($('curtain_popUp'+curtain.index)); curtain.closeBlinds();
}, resize: function(){ var Va77aa483 = $('curtain_blinds'); var V1b808491 = getPageDim(); Va77aa483.style.width = V1b808491[0] + 'px';
Va77aa483.style.height = V1b808491[1] + 'px'; }, expand: function(){ curtain.expandView = true; var V76d05b51 = curtain.maxDim();
width = V76d05b51[0] - 25; height = V76d05b51[1] - 50; curtain.resizeContent(width, height); $('curtain_expand'+curtain.index).href = 'javascript:curtain.shrink()';
 }, shrink: function(){ curtain.expandView = false; $('curtain_expand'+curtain.index).href = 'javascript:curtain.expand()';
curtain.autoSize(); }, openBlinds: function(){ if( getIEVerNum() == 6){ curtain.hideSelects(); }
var Va77aa483 = $('curtain_blinds'); curtain.index +=2; Va77aa483.style.zIndex = curtain.index; Va77aa483.style.display='block';
var V1b808491 = getPageDim(); Va77aa483.style.width = V1b808491[0] + 'px'; Va77aa483.style.height = V1b808491[1] + 'px';
Event.observe(window, 'resize', curtain.resize); }, closeBlinds: function(){ var Va77aa483 = $('curtain_blinds');
curtain.index-=2; Va77aa483.style.zIndex = curtain.index; if(curtain.index == -1){ Va77aa483.style.display='none';
Event.stopObserving(window, 'resize', curtain.resize); } if( getIEVerNum() == 6){ curtain.showSelects(); 
 } }, hideSelects: function(){ curtain.hideSelects[curtain.index] = new Array(); if(curtain.index != -1){ 
 var allSel = $('curtain_popUp'+curtain.index).select('select'); } else{ var allSel = $$('select');
} for(var i=0; i < allSel.length; i++){ if(allSel[i].style.visibility != 'hidden'){ allSel[i].style.visibility = 'hidden';
curtain.hideSelects[curtain.index][i] = allSel[i]; } } }, showSelects: function(){ var V6861a8a7 = curtain.hideSelects[curtain.index];
for(var i=0; i < V6861a8a7.length; i++){ V6861a8a7[i].style.visibility = 'visible'; } } }; Event.observe(window, 'load', curtain.init); 
