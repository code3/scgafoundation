<?php

require ('lib/nmiCustomerVault.class.php');

$vault = new nmiCustomerVault;

$vault->setCcNumber('4111111111111111');
$vault->setCcExp('1113');
$vault->setCvv('999');

$vault->setCompany('Some company');
$vault->setFirstName('John');
$vault->setLastName('Smith');
$vault->setAddress1('888');
$vault->setCity('Dallas');
$vault->setState('TX');
$vault->setZip('77777');
$vault->setPhone('8008983436');
$vault->setEmail('test@domain.com');

$vault->addAndCharge(150.00);

/*
 *
 * You can add a customer while processing a transaction using the following
 * $amount = 100.00;
 * $vault->setOrderDescription('Some Item');
 * $vault->setTax('9.00');
 * $vault->setShipping('12.00');
 * $vault->addAndProcess($amount);
 */

$result = $vault->execute();
/*
Result is returned as an array in the format of...
$result = Array
(
    [response] => 1
    [responsetext] => Customer Added
    [authcode] =>
    [transactionid] => 0
    [avsresponse] =>
    [cvvresponse] =>
    [orderid] =>
    [type] =>
    [response_code] => 100
    [customer_vault_id] => 80202634
)
 *
 */

switch($result['response'])
{
    case 1: //Success

        //You will want to take the customer_vault_id and store it for your later usage
        //You can later process, update, or delete customers in the vault based on customer_vault_id

        break;
    default; //Error or fail, The fail response is actually 2, error is 3, but we fail regardless if it's not successful

        //You can redisplay your form here, or do something else here
}

?>