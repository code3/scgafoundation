<?

if(!is_numeric($_GET['noteid'])){
	$_SESSION[PREFIX.'error'] = $p.' - in data/note.php';
	died(CLIENTROOT.'/error/');
}

$_notes = $_mysql->get('SELECT * FROM note WHERE noteid = '.$_GET['noteid']);

if($_notes){
	foreach($_notes as $key => $note){
		$_notes[$key]['time'] = date('m/d/Y h:i:s a', strtotime($note['time']));
	}
}
?>