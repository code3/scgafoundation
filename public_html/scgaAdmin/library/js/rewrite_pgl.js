//rewrite pl_v2.php links so that it will work with curtain
//functStr is the function being used to invoke the curtain, must contain %url% whitch will be replace with the url for the ajax
function rewritePgl(functStr){
	var popUp = $('curtain_popUp'+curtain.index);
	var pageLinks = popUp.select('.pgl');
	for(var i=0; i<pageLinks.length; i++){
		pageLinks[i].href = "javascript: "+functStr.replace('%url%', pageLinks[i].href);
	}
	
	//number per page form
	if(popUp.select('.pgl_numPerPageGo')[0] != null ){
		popUp.select('.pgl_numPerPageGo')[0].onclick = function(){
			//check value
			var pglNumPerPage =  popUp.select('.pgl_numPerPage')[0];
			if(isNaN(pglNumPerPage.value)){
				alert('Please enter a number.');
				pglNumPerPage.focus();
			}
			else{
				if(pglNumPerPage.value<=0){
					alert('Please enter a number greater than 0.');
					pglNumPerPage.focus();
				}
				else{
					eval(functStr.replace('%url%', popUp.select('.pgl_url')[0].value+"&pgl_numPerPage="+pglNumPerPage.value));
				}
			}
		}
	}
}