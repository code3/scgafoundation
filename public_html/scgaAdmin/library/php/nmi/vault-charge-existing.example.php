<?php

require ('lib/nmiCustomerVault.class.php');

/*
 * We are assuming that a credit card and the user's information
 * has already been added to the customer vault
 */

$customer_vault_id = '123456';

$vault = new nmiCustomerVault;
$vault->setCustomerVaultId($customer_vault_id);
$vault->charge(100.00);


$result = $vault->execute();
/*
Result is returned as an array in the format of...
$result = Array
(
    [response] => 1
    [responsetext] => SUCCESS
    [authcode] => 123456
    [transactionid] => 1088246975
    [avsresponse] =>
    [cvvresponse] =>
    [orderid] =>
    [type] =>
    [response_code] => 100
)

 *
 */

switch($result['response'])
{
    case 1: //Success
        //The charge was successful do what you need here

        break;
    default; //Error or fail, The fail response is actually 2, error is 3, but we fail regardless if it's not successful

}

?>