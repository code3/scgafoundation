<?php

require ('lib/nmiDirectPost.class.php');

//Transaction ID from previous Auth
$transaction_id = '123456';

$transaction = new nmiDirectPost;

$transaction->setTransactionId($transaction_id);

$transaction->capture();

$result = $transaction->execute();
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

switch($result['response'])
{
    case 1: //Success

        //Add order to database or whatever other internal action is needed
        //You would generally then redirect your use to the thankyou page

        break;
    default; //Error or fail, The fail response is actually 2, error is 3, but we fail regardless if it's not successful

        //You can redisplay your form here, or do something

        
}

?>