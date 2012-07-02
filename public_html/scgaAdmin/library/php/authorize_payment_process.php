<?php
function payment_process($info, $currencyCode = 'USD', $type = 'AUTH_CAPTURE', $account = 'scga'){
	if($account == 'scga'){//scga
		$auth_net_login_id = 'Fdtn-Kevin'; 
		$auth_net_tran_key = 'SCGA4golf';
		//$auth_net_url = 'https://test.authorize.net/gateway/transact.dll';
		//$auth_net_url = 'https://secure.authorize.net/gateway/transact.dll';
		$auth_net_url = 'https://secure.nmi.com/gateway/transact.dll';
	}
	
	$result = 'Approved';
		
	foreach($info as $key=>$val){
		$info[$key] = urlencode($val);
	}
	
	$authnet_values	= array(
		"x_login"				=> $auth_net_login_id,
		"x_version"				=> "3.1",
		"x_delim_char"			=> "|",
		"x_delim_data"			=> "TRUE",
		"x_url"					=> "FALSE",
		"x_type"				=> $type,
		"x_method"				=> "CC",
		"x_tran_key"			=> $auth_net_tran_key,
		"x_relay_response"		=> "FALSE",
		"x_card_num"			=> $info['ccNumber'],
		"x_card_code"			=> $info['ccCode'],
		"x_exp_date"			=> $info['ccExp'],
		"x_description"			=> $info['desc'],
		"x_amount"				=> $info['amount'],
		"x_first_name"			=> $info['firstname'],
		"x_last_name"			=> $info['lastname'],
		"x_address"				=> $info['address'],
		"x_city"				=> $info['city'],
		"x_state"				=> $info['state'],
		"x_zip"					=> $info['zip']
		);
	
	$fields = "";
	foreach( $authnet_values as $key => $value ){
		$fields .= "$key=" . urlencode( $value ) . "&";
	}
	
	$ch = curl_init($auth_net_url);
	curl_setopt($ch, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
	curl_setopt($ch, CURLOPT_POSTFIELDS, rtrim( $fields, "& " )); // use HTTP POST to send form data
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response. ###
	$resp = curl_exec($ch); //execute post and get results
	curl_close ($ch);
	$results = explode('|', $resp);
	//echo "this is the response".$resp;
	//print_r($results);
	//die();
	if($results[0] != '1'){
		$result = $results[3];
	}
	$notUsed = array('P', 'S', 'U', 'G', 'B');
	if(in_array($results[5], $notUsed) ){
		$results[5] = '';
	}
	if($resp ==''){
		return array('result'=> "There was an error processing your credit card.");
	}
	else{
		return array(
			'result'=> $result,
			'transaction' => $results[6], 
			'amount' => $results[9],
			'avs' => $results[5],
			'cvv' => $results[38]
		);
	}
}

?>