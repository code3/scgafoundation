<?php
	/* globals
	bool magicQuotesOff
	*/

	magicQuotesOff();
	
	function magicQuotesOff(){ //reverse affect of magic_quotes
		if(!get_magic_quotes_gpc()){ //already off
			return;
		}
		if(is_array($_POST)){
			foreach($_POST as $key=>$value){
				if(is_array($_POST[$key])){ // in case if an aray
					$len = count($_POST[$key]);
					for($i=0; $i<$len; $i++){
						$_POST[$key][$i] = stripslashes($_POST[$key][$i]);
					}
				}
				else{
					$_POST[$key] = stripslashes($value);
				}
			}
		}
		if(is_array($_GET)){
			foreach($_GET as $key=>$value){
				if(is_array($_GET[$key])){ // in case if an aray
					$len = count($_GET[$key]);
					for($i=0; $i<$len; $i++){
						$_GET[$key][$i] = stripslashes($_GET[$key][$i]);
					}
				}
				else{
					$_GET[$key] = stripslashes($value);
				}
			}
		}
		$GLOBALS['magicQuotesOff'] = true;
	}

	function htmlSel($list, $tagProp, $sel='', $useKey = false, $default = false){
		if(!is_array($list)){
			die('emgHtmlSel error: $list must be an array');
		}
		?>
		<select <?= $tagProp ?>>
		<?
		if($default){
      		?><option value=""><?= $default ?></option><?
		}
		foreach($list as $key=>$val){ 
			echo '<option ';
			if($useKey){
				echo ' value="'.$key.'"';
			}
			else{
				echo ' value="'.$val.'"';
			}
			if($sel != ''){
				if( ($useKey == true && $key == $sel) ||  ($useKey == false && $val == $sel) ){
					echo ' selected="selected" ';
				}
			}
			echo '>'. $val .'</option>';
		}
		?>
		</select>
		<?
	}
	
	function changeDateFormat($date){
		if($date == ''){
			return false;
		}
		if(strstr($date, '/')){
			$parts = explode('/', $date);
			return $parts[2].'-'.$parts[0].'-'.$parts[1];
		}
		if(strstr($date, '-')){
			$parts = explode('-', $date);
			return $parts[1].'/'.$parts[2].'/'.$parts[0];
		}
	}
	function dateFormat($date, $type = false, $time = false) {
		switch($type){
			case '-':
				$format = 'Y-m-d';
			break;
			case '/':
				$format = 'm/d/Y';
			break;
			default: //Wed Apr 01st
				$format = 'D M jS Y';
		}
		$format .= ($time ? ' g:ia' : '');
		
		$strtotime = strtotime($date);
		if($strtotime == ''){
			return;	
		}
		
		return date($format, $strtotime);
	}
	//gets a range of a string
	function strR($str, $start, $stop ){ 
		$ret = '';
		for($i=$start; $i<=$stop; $i++){
			$ret .= $str[$i];
		}
		return $ret;
	}
	
	function jsClean($str, $type="'"){
		return addcslashes($str, '\\'.$type);
	}
	
	function died($loc){
		die(header('location: '.$loc));
	}
	
	function cookie($name, $val, $time){
		setcookie($name, $val, time()+$time, '/', $_SERVER['SERVER_NAME']) or die("unable to set cookie");
	}
	
	function cookieUnset($name){
		setcookie($name, '', 0, '/', $_SERVER['SERVER_NAME']) or die("unable to set cookie");
	}
	
	function cleanUrl($url) {
		$pattern = array('/(\s*-\s*|\s|\/)/', '/(\'|\!|\&amp;)/');
		$replace = array('-', '');
		$url = preg_replace($pattern, $replace, $url);
		return strtolower(preg_replace('(-(-*))', '-', $url));
	}
	
	function httpsOn(){
		if (!isset($_SERVER['HTTPS'])) {
			header ('HTTP/1.1 301 Moved Permanently');
			died("https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']); 
		}  
	}
	
	function httpsOff(){
		if (isset($_SERVER['HTTPS'])) {
			header ('HTTP/1.1 301 Moved Permanently');
			died("http://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']); 
		} 
	}
	
	//saves user actions/history (get variables) into session
	function userActionHistory($omitList, $area){
		$len = count($omitList);
		$temp = array();
		for($i=0; $i<$len; $i++){
			if(!isset($_GET[$omitList[$i]])){
				continue;
			}
			$temp[$omitList[$i]] = $_GET[$omitList[$i]];
			unset($_GET[$omitList[$i]]);
		}
		if(count($_GET) == 0){ //no new action
			if(is_array($_SESSION[$area])){ //have saved actions
				$_GET = array_merge($_SESSION[$area], $temp); //load saved actions
				return;
			}
		}
		else{// new action
			$_SESSION[$area] = $_GET; // save new action
		}
		$_GET = array_merge($_GET, $temp);
	}
	
	function replaceWordChars($var, $nl2br = false){
		$chars = array(
			128 => '&#8364;',
			130 => '&#8218;',
			131 => '&#402;',
			132 => '&#8222;',
			133 => '&#8230;',
			134 => '&#8224;',
			135 => '&#8225;',
			136 => '&#710;',
			137 => '&#8240;',
			138 => '&#352;',
			139 => '&#8249;',
			140 => '&#338;',
			142 => '&#381;',
			145 => '&#8216;',
			146 => '&#8217;',
			147 => '&#8220;',
			148 => '&#8221;',
			149 => '&#8226;',
			150 => '&#8211;',
			151 => '&#8212;',
			152 => '&#732;',
			153 => '&#8482;',
			154 => '&#353;',
			155 => '&#8250;',
			156 => '&#339;',
			158 => '&#382;',
			159 => '&#376;');
		$var = str_replace(array_map('chr', array_keys($chars)), $chars, $var);
		if($nl2br){
			return nl2br($var);
		} else {
			return $var;
		}
	}
	
	//transpose an array
	function transpose($inArray){
		$outArray = array();
		//get col keys
		foreach($inArray as $row){
			$keys = array_keys($row);
			break;
		}
		foreach($keys as $key){
			$outArray[$key] = array();
		}
		foreach($inArray as $colKey => $row){
			foreach($row as $rowKey => $val){
				$outArray[$rowKey][$colKey] = $val;	
			}
		}	
		return $outArray;
	}
	
	function encrypt($key, $data){
		return mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));
	}
	
	function decrypt($key, $data){
		return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
	}
	
	function decode($encodedStr){
		parse_str($encodedStr, $decoded);
		$decoded = stripslashes_deep($decoded);
		return $decoded;
	}

	function stripslashes_deep($value){
		$value = is_array($value) ?
					array_map('stripslashes_deep', $value) :
					stripslashes($value);
		
		return $value;
	}

?>