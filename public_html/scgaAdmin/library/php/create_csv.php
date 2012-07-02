<?

function exportCsv($list, $fileName, $file=''){
	
	// Put the name of all fields to $out.
	$cols = array(); 
	foreach($list[0] as $col=>$val) {
		array_push($cols, '"'.str_replace('"', '""', $col).'"');
	}
	$out = implode(',', $cols)."\r\n";
	
	// Add all values in the table to $out. 
	foreach($list as $row){
		$cols = array();
		foreach($row as $val) {
			array_push($cols, '"'.str_replace('"', '""', $val).'"');
		}
		$out .=  implode(',', $cols)."\r\n";
	}

	if($file != ''){
		$f = fopen ($file,'w') or die ("unable to open file");
		fputs($f, $out);
		fclose($f);
	}
	else{
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$fileName.'"');
		header("Pragma: public");// need for IE
		echo $out;
		die();
	}
}
?>