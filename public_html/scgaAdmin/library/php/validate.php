<?php
//01/07/08
//email, alpha, alphaSpace, alphaNum, int, num, url, num 
//min, max, len,
		
function validate($values, &$error = NULL){
		if(!is_array($values)){
			die('validate: error, first argument must be an array');
		}
		foreach($values as $index => $value){
			foreach($value as $key=>$val){
				$checks = explode(' ', $key);
				$len = count($checks);
				for($i=0; $i<$len; $i++){
					switch($checks[$i]){ 
						case 'email': $check = isEmail($val); break;
						case 'alpha': $check = isAlpha($val); break;
						case 'alphaSpace': $check = isAlphaSpace($val); break;
						case 'alphaNum': $check = isAlphaNum($val); break;
						case 'alphaNumSym': $check = isAlphaNumSym($val); break;
						case 'int': $check = isInt($val); break;
						case 'min': $check = isMin($val, $checks[$i+1]); break;
						case 'max': $check = isMax($val, $checks[$i+1]); break;
						case 'len': $check = isLen($val, $checks[$i+1]); break;
						case 'num': $check = is_numeric($val); break;
					}
					if(!$check){
						//if(isset($error)){
							$error = 'index: '.$index.' / check: '.$checks[$i];
						//}
						return false;
					}
				}
			}
		}
		return true;
	}
//----- Validators
function isAlphaNum($str){
	if (!eregi("^[a-z0-9]+$", $str) && $str != ''){
		return false;
	}
	return true;
}

function isAlphaNumSym($str){
	if (!eregi("^[a-z0-9_.\-]+$", $str)  && $str != ''){
		return false;
	}
	return true;
}

function isAlpha($str){
	if (!eregi("^[a-z]+$", $str)  && $str != ''){
		return false;
	}
	return true;
}

function isAlphaSpace($str){
	if (!eregi("^[a-z]+$", $str)  && $str != ''){
		return false;
	}
	return true;
}

function isEmail($str){
	return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $str);
}

function isMax($str, $max){
	if(isset($str[$max])){
		return false;
	}
	return true;
}

function isMin($str, $min){
	if(isset($str[$min-1])){
		return true;
	}
	return false;
}

function isLen($str, $len){
	if( !isset($str[$len-1]) || isset($str[$len]) ){
		return false;
	}
	return true;
}

function isInt($str){
	if($str != ''){
		if(!is_numeric($str)){
			return false;
		}
		if(strstr($str, '.')){
			return false;
		}
	}
	return true;
}

	?>