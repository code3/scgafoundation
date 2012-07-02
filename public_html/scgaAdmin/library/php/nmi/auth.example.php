<?php

require ('lib/nmiDirectPost.class.php');

$transaction = new nmiDirectPost;

$transaction->setOrderDescription('Some Item');
$transaction->setAmount('100.00');
$transaction->setTax('9.00');
$transaction->setShipping('12.00');

$transaction->setCcNumber('4111111111111111');
$transaction->setCcExp('1113');
$transaction->setCvv('999');

$transaction->setCompany('Some company');
$transaction->setFirstName('John');
$transaction->setLastName('Smith');
$transaction->setAddress1('888');
$transaction->setCity('Dallas');
$transaction->setState('TX');
$transaction->setZip('77777');
$transaction->setPhone('5555555555');
$transaction->setEmail('test@domain.com');

$transaction->auth();

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