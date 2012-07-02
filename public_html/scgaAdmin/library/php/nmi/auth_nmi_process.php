<?php

require ('lib/nmiDirectPost.class.php');

class payment_process extends nmiDirectPost{
 
 private $result;
 private $transactionId;
 private $responseCode;
 private $amount;
 
public function __construct($info, $currencyCode = 'USD', $type = 'AUTH_CAPTURE', $account = 'SCGA'){
	
	
	foreach($info as $key=>$val){
		$info[$key] = urlencode($val);
	}
	
	
	//LAST LEFT OFF HERE WAS PLACING TH INFO ARRAY ON THE PARENT METHODS

	
	 

parent::setOrderDescription($info['desc']);
parent::setAmount($info['amount']);
parent::setTax('');
parent::setShipping('');

parent::setCcNumber($info['ccNumber']);
parent::setCcExp($info['ccExp']);
parent::setCvv($info['ccCode']);

parent::setCompany($account);
parent::setFirstName($info['firstname']);
parent::setLastName($info['lastname']);
parent::setAddress1($info['address']);
parent::setCity($info['city']);
parent::setState($info['state']);
parent::setZip($info['zip']);
parent::setPhone($info['phone']);
parent::setEmail($info['email']);

parent::setMerchantDefinedField($info['merchant_defined_field_1']);

parent::auth();

$result = parent::execute();
/*
Result is returned as an array in the format of...
$result = Array
(
    [response] => 1
    [responsetext] => SUCCESS
    [authcode] => 123456
    [transactionid] => 1087714082
    [avsresponse] => Y
    [cvvresponse] => M
    [orderid] =>
    [type] => sale
    [response_code] => 100
)
 *
 */
 
 //$this->setArrayResult($result);
$this->transactionId = $result['transactionid'];
$this->responseCode = $result['response_code'];
$this->amount = $info['amount'];
 
//echo print_r($result); exit;

switch($result['response'])
{
    case 1: //Success

        //Add order to database or whatever other internal action is needed
        //You would generally then redirect your use to the thankyou page
//return $result['responsetext'];
return $this->result = 'SUCCESS';
   //$this->result = array('result'=> 'Approved'); //i'm returning an array with the words 'Approved' so that I don't have to change submit-donation-form.php code
   break;
		

   case 2:
   return $this->result = 'FAIL';
   //return $result['responsetext'];
   //$this->result = array('result'=> 'Fail'); //i'm returning an array with the words 'Approved' so that I don't have to change submit-donation-form.php code
   break;
	
	case 3:
	return $this->result = 'ERROR';
   //return $result['responsetext'];	
    break;
	
	default; //Error or fail, The fail response is actually 2, error is 3, but we fail regardless if it's not successful
    return false;
        //You can redisplay your form here, or do something

        
}

	
	
	
	}


public function getResult(){
	
	return $this->result;
	
	}
	
	public function getTransactionId(){
		
		return $this->transactionId;
		
		}
	
	
	public function getResponseCode(){
	
	return $this->responseCode;
	
	}

public function getAmount(){
	
	return $this->amount;
	
	}

/*	
	public function setArrayResult($result){
	
	return $this->result = $result;
	
	}
*/

}//end of class

?>