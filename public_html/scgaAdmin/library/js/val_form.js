 /*02/11/08*/

/*

Copyright © 2008 Eckx Media Group, LLC. All rights reserved.

Eckx Media Group respects the intellectual property of others, and we ask our users to do the same.

*/



 

 var valForm = { 

 errorTag: 'div', errorClass: 'val_error',

 

 classList: new Array('val_req', 'val_min', 'val_max', 'val_maxNum', 'val_minNum', 'val_alpha', 'val_alpha_num', 'val_alpha_num_sym', 'val_alpha_space', 'val_alpha_num_space', 'val_num', 'val_int', 'val_email', 'val_len', 'val_same', 'val_notSame', 'val_url', 'val_ajax', 'val_money', 'val_func'),

 

 dependents: new Array('val_len', 'val_min', 'val_max', 'val_maxNum', 'val_minNum', 'val_same', 'val_notSame', 'val_ajax', 'val_func'), 

 failed: true, form: null, formObsFunc: null, submitBtn: null, ajaxRunning: new Object(), alertErrorsFlag: false, 

 hideErrorsFlag: false, errors: new Object(), errorFocusedFlag: false, inputs: null, inputObsFuncs: null, 

 originalSubmit: null, stopSubmit: false,

 init: function(){ if(arguments[1]){ if(arguments[1].include('ae')){

 valForm.alertErrorsFlag = true; } if(arguments[1].include('he')){ valForm.hideErrorsFlag = true; }

} 

 valForm.failed = true; 
 valForm.stopSubmit = false; 
 valForm.ajaxRunning = new Object(); 
 
 if(valForm.inputs){  
 
 for(var i=0; i<valForm.inputs.length; i++){

 Event.stopObserving(valForm.inputs[i], 'blur', valForm.inputObsFuncs[i]); 
 
 } 
 
 Event.stopObserving(valForm.form, 'submit', valForm.formObsFunc); 
 

 } 
 
 valForm.inputs = new Array(); valForm.inputObsFuncs = new Array(); valForm.form = $(arguments[0]);

 if(!valForm.form){ alert('setupFormVal, form id dosnt exist'); return false; } 

 var Vf9b843c0 = valForm.form.select('input[type="submit"]');

if(Vf9b843c0.length == 0){ alert('valForm init error: no submit button'); } else{ valForm.submitBtn = Vf9b843c0[0];

} 

 var Vccaee621 = valForm.form.select('input[type="text"]'); 
 var Vc836810e = valForm.form.select('input[type="password"]');

var Vb954ef8a = valForm.form.select('input[type="file"]'); 
var V31b9feb5 = valForm.form.select('select');  var Vkeilmdiowd2 = valForm.form.select('textarea');

 valForm.inputs = Vccaee621.concat(Vc836810e.concat(V31b9feb5.concat(Vb954ef8a.concat(Vkeilmdiowd2))));

 for(var i=0; i<valForm.inputs.length; i++){

 if(valForm.inputs[i].disabled){ continue; } valForm.inputObsFuncs[i] = valForm.fieldCheck.bindAsEventListener(valForm.inputs[i]); 

 Event.observe(valForm.inputs[i], 'blur', valForm.inputObsFuncs[i]); if($w(valForm.inputs[i].className).indexOf('val_ajax') != -1 ){

 valForm.ajaxRunning[valForm.inputs[i].id] = false; } } 

 valForm.originalSubmit = valForm.form.readAttribute('onsubmit'); 

 valForm.form.onsubmit = null; valForm.formObsFunc = valForm.submitCheck.bindAsEventListener(valForm.form); 

 Event.observe(valForm.form, 'submit', valForm.formObsFunc); }, submitCheck: function(event){ valForm.errorFocusedFlag = false; 

 valForm.submitBtn.disabled = true; valForm.errors = new Object(); valForm.failed = false; for(var fieldID in valForm.ajaxRunning){

 valForm.ajaxRunning[fieldID] = true; } for(var i=0; i<valForm.inputs.length; i++){ valForm.fieldCheckSubmit(valForm.inputs[i]);

if(valForm.errors[valForm.inputs[i].id] && !valForm.errorFocusedFlag){ valForm.inputs[i].focus();

valForm.errorFocusedFlag = true; } } setTimeout('valForm.submitAjaxChk()', 1); Event.stop(event); 

 return false; }, 

 submitAjaxChk: function(){ var Vc5417c1e = false; for(var fieldID in valForm.ajaxRunning){

 if(valForm.ajaxRunning[fieldID]){ Vc5417c1e = true; } else{ if(valForm.errors[fieldID] && !valForm.errorFocusedFlag){ 

 $(fieldID).focus(); valForm.errorFocusedFlag = true; } } } if(Vc5417c1e){ setTimeout('valForm.submitAjaxChk()', 100);

} else if(!valForm.failed){ eval(valForm.originalSubmit); if(!valForm.stopSubmit){valForm.form.submit();}else{valForm.submitBtn.disabled = false;} } else{ if(valForm.alertErrorsFlag){

 var Vcefb778c = ''; for(var fieldID in valForm.errors){ Vcefb778c += valForm.errors[fieldID] + "\n";

} alert(Vcefb778c); } valForm.submitBtn.disabled = false; } }, fieldCheck: function(){ var classes = $w(this.className);

 

 var index = classes.indexOf('val_combo'); if(index != -1){ if(index+1 == classes.length){ alert('val_combo id required');

return; } var Vb05d28e4 = classes[index + 1]; if($(valForm.Vb05d28e4+'_error')){ $(valForm.Vb05d28e4+'_error').remove();

} if(valForm.errors[Vb05d28e4]){ valForm.errors[Vb05d28e4] = false; } var V65bf3fd3 = valForm.form.select('.' + Vb05d28e4); 

 for(var i=0; i<V65bf3fd3.length; i++){ valForm.validate(V65bf3fd3[i], Vb05d28e4); if(valForm.errors[Vb05d28e4]){

 return; } } return; } valForm.validate(this); return; }, fieldCheckSubmit: function(field){ var classes = $w(field.className);

 

 var index = classes.indexOf('val_combo'); if(index != -1){ if(index+1 == classes.length){ alert('val_combo id required');

return; } var Vb05d28e4 = classes[index + 1]; if($(valForm.Vb05d28e4+'_error')){ $(valForm.Vb05d28e4+'_error').remove();

} if(valForm.errors[Vb05d28e4]){ valForm.errors[Vb05d28e4] = false; } var V65bf3fd3 = valForm.form.select('.' + Vb05d28e4); 

 for(var i=0; i<V65bf3fd3.length; i++){ valForm.validate(V65bf3fd3[i], Vb05d28e4); if(valForm.errors[Vb05d28e4]){

 return; } } return; } valForm.validate(field); return; }, validate: function(field, Vb05d28e4){ 

 var classes = $w(field.className); 

 var locate = classes.indexOf('val_skipifis'); if(locate != -1 && locate != (classes.length - 1)){ 

 var V8a5b6bc8 = $(classes[locate + 1]); if( V8a5b6bc8.value != '' && field.value.strip() == V8a5b6bc8.value){

 if(classes.indexOf('val_ajax') !=-1 ){ valForm.ajaxRunning[field.id] = false; } valForm.errorHandler(field, false)

 return; } } for(var i=0; i<classes.length; i++){ if(valForm.classList.indexOf(classes[i]) == -1){ 

 continue; } if(valForm.dependents.indexOf(classes[i]) == -1){ var Va53108f7 = 'var error = valForm.'+classes[i]+'(field);';

} else{ if(i+1 == classes.length){ alert('valForm dependent required'); return false; } var Va53108f7 = 'var error = valForm.'+classes[i]+'(field, "'+classes[i+1]+'");';

} eval(Va53108f7); if(classes[i] == 'val_ajax'){ continue; } var errorField = field; if(Vb05d28e4){ 

 errorField = $(Vb05d28e4); } if(valForm.errorHandler(errorField, error)){ break; } } }, errorHandler: function(field, error){ 

 if($(field.id+'_error')){ $(field.id+'_error').remove(); } if(!error){ return false; } valForm.failed = true;



 if(valForm.ajaxRunning[field.id]){ valForm.ajaxRunning[field.id] = false; } if(field.name.indexOf('[') != -1 ){ 

 var V943db850 = valForm.form.select('[name="'+field.name+'"]')[0].id; } else{ var V943db850 = field.id;

} var label = valForm.form.select('label[for=' + V943db850 + ']'); var errorMsg = label[0].innerHTML.replace(':', '')+' '+error;

 if(!valForm.hideErrorsFlag){

 var classNames = $w(field.className); var findKeyword = classNames.indexOf('val_errorAfter');

if( findKeyword != -1){ if(findKeyword == (classNames.length - 1)){ alert('val_form: val_errorAfter is missing an id');

} else{ new Insertion.After($(classNames[findKeyword+1]), '<'+valForm.errorTag+' id="'+field.id+'_error" class="'+valForm.errorClass+'">'+errorMsg+'</span>'); 

 } } else{ new Insertion.After(field, '<'+valForm.errorTag+' id="'+field.id+'_error" class="'+valForm.errorClass+'">'+errorMsg+'</span>');

} } valForm.errors[field.id] = errorMsg; return true; }, 

 val_num : function(field) { if(field.value.match(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/) || field.value == '') {

 return false; } else { return 'needs to be a number.'; } }, val_req : function(field) { if(field.value.strip().length != 0) {

 return false; } else { return 'is required.'; } }, val_min : function(field, minLen) { if(field.value.length < parseFloat(minLen) && field.value != ''){

 return 'must be at least '+minLen+' characters long.'; } else{ return false; } }, val_max : function(field, maxLen) {

 if(field.value.length > parseFloat(maxLen) && field.value != ''){ return 'must be at most '+maxLen+' characters long.';

} else{ return false; } }, val_maxNum : function(field, maxNum){ if( !isNaN(field.value) && field.value > parseFloat(maxNum)){ 

 return 'must be '+maxNum+' or less.'; } else{ return false; } }, val_minNum : function(field, minNum){

 if(!isNaN(field.value) && (field.value < parseFloat(minNum))){ return 'must be '+minNum+' or greater.';

} else{ return false; } }, val_len : function(field, len) { if(field.value.length != parseFloat(len) && field.value != ''){

 return 'must be '+len+' characters long.'; } else{ return false; } }, val_same : function(field, field2){

 var field2Obj = $(field2); if(!field2Obj){ alert('val_same: '+field2+' is not defined'); return true;

} if(field.value != field2Obj.value && field2Obj.value != ''){ var label = valForm.form.select('label[for=' + field2Obj.id + ']');

return 'does not match '+label[0].innerHTML.replace(':', '')+'.'; } return false; }, val_notSame : function(field, field2){

 if(!$(field2)){ alert('val_notSame: '+field2+' is not defined'); return 'error'; } if(field.value.strip().length == 0){ 

 return false; } var checkFields = $(field2).value.split(' '); for(var i=0; i<checkFields.length; i++){

 if(checkFields[i] == field.id){ continue; } if(!$(checkFields[i])){ alert('val_notSame: '+checkFields[i]+' is not defined');

return 'error'; } if(field.value == $(checkFields[i]).value){ return ' has already been entered.'; 

 } } return false; }, val_email : function(field){ if(field.value.match(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/) || field.value == '') {

 return false; } else { return 'is not a valid email address.'; } }, val_alpha : function(field) {

 if(field.value.match(/^[a-zA-Z]+$/) || field.value == '') { return false; } else { return 'should contain only letters.';

} }, val_alpha_space : function(field) { if(field.value.match(/^[a-zA-Z\s]*$/) || field.value == '') {

 return false; } else { return 'should contain only letters and spaces.'; } }, val_alpha_num : function(field) {

 if(field.value.match(/^[a-zA-Z0-9]*$/) || field.value == '') { return false; } else { return 'should contain only letters and numbers.';

} }, val_alpha_num_space : function(field) { if(field.value.match(/^[a-zA-Z0-9\s]*$/) || field.value == '') {

 return false; } else { return 'value should contain only letters, numbers, and spaces.'; } }, val_alpha_num_sym : function(field) {

 if(field.value.match(/^[a-zA-Z0-9_\-.]*$/) || field.value == '') { return false; } else { return 'should contain only letters, numbers, and "-", "_", or ".".';

} }, val_int : function(field) { if(field.value.match(/(^-?\d\d*$)/) || field.value == '') { return false;

} else { return 'needs to be a whole number.'; } }, val_url : function(field) { if(field.value.match(/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i) || field.value == '') {

 return false; } else { return 'needs to be a valid url.'; } }, val_ajax: function(field, func){

 eval(func + "('"+field.id+"')"); return true; }, val_func: function(field, func){ eval('var valForm_error = '+func + "('"+field.id+"')");

if(valForm_error){ return valForm_error; } else{ return false; } }, 

 val_money : function(field){

 if(isNaN(field.value)){ formated = '0.00'; } else{ var formated = Math.round(field.value*100)/100;

formated = formated.toString(); if(formated.indexOf('.') == -1){ formated += '.00'; } else{ var parts = formated.split('.');

if(parts[1].length == 1){ formated += '0'; } } } field.value = formated; } };