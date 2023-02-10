<?php
require_once("./includes/paypalConfig.php");
// # Create Plan Sample
//
// This sample code demonstrate how you can create a billing plan, as documented here at:
// https://developer.paypal.com/docs/api/payments.billing-plans/v1/#billing-plans_post
// API used: POST /v1/payments/billing-plans

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Common\PayPalModel;

$plan = new Plan();

$plan->setName('Yi-flix monthly subscription')
    ->setDescription('Unlock all features')
    ->setType('INFINITE');

$paymentDefinition = new PaymentDefinition();
// The possible values for such setters are mentioned in the setter method documentation.
// Just open the class file. e.g. lib/PayPal/Api/PaymentDefinition.php and look for setFrequency method.
// You should be able to see the acceptable values in the comments.
$paymentDefinition->setName('Regular Payments')
    ->setType('REGULAR')
    ->setFrequency('Month')
    ->setFrequencyInterval("1")
    ->setAmount(new Currency(array('value' => 7.99, 'currency' => 'USD')));
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$returnUrl = str_replace("billing.php", "profile.php", $currentUrl);
$merchantPreferences = new MerchantPreferences();
$merchantPreferences->setReturnUrl($returnUrl . "?success=true")
    ->setCancelUrl($returnUrl . "?success=false")
    ->setAutoBillAmount("yes")
    ->setInitialFailAmountAction("CONTINUE")
    ->setMaxFailAttempts("0");

$plan->setPaymentDefinitions(array($paymentDefinition));
$plan->setMerchantPreferences($merchantPreferences);

// ### Create Plan
try {
    $createdPlan = $plan->create($apiContext);
  
    try {
      $patch = new Patch();
      $value = new PayPalModel('{"state":"ACTIVE"}');
      $patch->setOp('replace')
        ->setPath('/')
        ->setValue($value);
      $patchRequest = new PatchRequest();
      $patchRequest->addPatch($patch);
      $createdPlan->update($patchRequest, $apiContext);
      $plan = Plan::get($createdPlan->getId(), $apiContext);
  
      // Output plan id
      echo $plan->getId();
    } catch (PayPal\Exception\PayPalConnectionException $ex) {
      echo $ex->getCode();
      echo $ex->getData();
      die($ex);
    } catch (Exception $ex) {
      die($ex);
    }
  } catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode();
    echo $ex->getData();
    die($ex);
  } catch (Exception $ex) {
    die($ex);
  }
?>
 <!-- "sender_batch_header": {
    "sender_batch_id": "2014021801",
    "recipient_type": "EMAIL",
    "email_subject": "You have money!",
    "email_message": "You received a payment. Thanks for using our service!"
  },
  "items": [
    {
      "amount": {
        "value": "9.87",
        "currency": "USD"
      },
      "sender_item_id": "201403140001",
      "recipient_wallet": "PAYPAL",
      "receiver": "<receiver@example.com>"
    },
    {
      "amount": {
        "value": "112.34",
        "currency": "USD"
      },
      "sender_item_id": "201403140002",
      "recipient_wallet": "PAYPAL",
      "receiver": "<receiver2@example.com>"
    },
    {
      "recipient_type": "PHONE",
      "amount": {
        "value": "5.32",
        "currency": "USD"
      },
      "note": "Thanks for using our service!",
      "sender_item_id": "201403140003",
      "recipient_wallet": "VENMO",
      "receiver": "<408-234-1234>"
    }
  ]
}' -->