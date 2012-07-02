<?php

//simple data handler function
//$mysql v 6
//$table main table
//$list containing results
//pl page links v 2
function letter_data($mysql, $table, $nameField, &$list, &$pl, $linkTable = ''){
	
	//get user history actions
	if(isset($_GET['fieldID'])){ //select actions
		userActionHistory(array('p', 'fieldID', 'k'), $table.'2');
	}
	else{ // normal actions
		userActionHistory(array('p'), $table);
	}
	
	if(isset($_GET['search'])){ // handle search
		$whereStr = "$table.$nameField LIKE '%". $mysql->makeSafe($_GET['search']) ."%'" ;
	}
	else if(is_numeric($_GET['id'])){ // get by id
		$whereStr = "$table.$tableID = ".$_GET['id'] ;
	}
	else{
		$whereStr = $nameField.' '. letter_regExp($mysql->makeSafe($_GET['letter'])) ; //get reg expression for first letter
	}
	
	$countInfo = $mysql->getSingle('SELECT count('.$table.'ID) AS rowCnt FROM '.$table.' WHERE '.$whereStr); // number of entries
	
	if($countInfo){
		$sortList = array($nameField, 'itemCount');
		if(in_array($_GET['sortField'], $sortList)){
			$queryStr .= ' SORT BY '.$_GET['sortField'];
		}
		if($_GET['sortDesc'] == 1){
			$queryStr .= ' DESC';
		}
		$pl = new pageLinks(10, $countInfo['rowCnt']); //setup page links
		
		if($linkTable != ''){ // types with tag tables
			$selStr = 'SELECT '.$table.'.*, COUNT('.$linkTable.'.'.$table.'ID) as itemCount';
			$tableStr .= ' FROM '.$table.' LEFT JOIN '.$linkTable.' ON '.$linkTable.'.'.$table.'ID = '.$table.'.'.$table.'ID'; 
			$groupStr .= ' GROUP BY '.$table.'.'.$table.'ID';
			$list = $mysql->get($selStr.$tableStr.' WHERE '.$whereStr.$groupStr.' LIMIT '.$pl->limit);
		}
		else{
			$orderStr = ($table == 'facility') ? ' ORDER BY facility.name' : '';
			$list = $mysql->get('SELECT * FROM '.$table.' WHERE '.$whereStr.$orderStr.' LIMIT '.$pl->limit);
		}
	}
	else{
		$list = false;
	}
} 

function letter_regExp($letter){
	
	if($letter == 'All' || $letter == '' ){
		return "REGEXP '.*'";
	}
	elseif($letter == 'Others'){
		return "NOT REGEXP '^[a-z]|[0-9]'";
	} 
	else if($letter == '0-9'){
		return "REGEXP '^[0-9].*'";
	}
	else {
		return "REGEXP '^$letter.*'";
	}

}

//$url contains the href of the anchor, must include %letter% where the function will attach variables to 
function letter_output($url){
	$alpha = array();
	array_push($alpha, '0-9');
	for($i=65; $i<91; $i++){
		array_push($alpha, chr($i));
	}
	array_push($alpha, 'Others');
	array_push($alpha, 'All');
	
	?><div><?
	foreach($alpha as $letter){
		?><a href="<?= str_replace('%letter%', 'letter='.$letter, $url) ?>"><?
	
		if($_GET['letter'] == $letter){
			?><strong><?= $letter ?> </strong><?
		}
		else{
			echo $letter . ' ';
		}
		?></a><?
	}
	
	?></div><?
}
?>