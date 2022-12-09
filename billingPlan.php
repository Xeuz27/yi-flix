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
use PayPal\Api\PayPalModel;

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

// Charge Models
// shipping and taxes not using but keeping code

// $chargeModel = new ChargeModel();
// $chargeModel->setType('SHIPPING')
//     ->setAmount(new Currency(array('value' => 10, 'currency' => 'USD')));
// $paymentDefinition->setChargeModels(array($chargeModel));

$merchantPreferences = new MerchantPreferences();

$currentUrl = "http://$_SERVER[HTTP_HOST]$S_SERVER[REQUEST_URL]";
$returnUrl = str_replace("billing.php", "profile.php", $currentUrl);


// ReturnURL and CancelURL are not required and used when creating billing agreement with payment_method as "credit_card".
// However, it is generally a good idea to set these values, in case you plan to create billing agreements which accepts "paypal" as payment_method.
// This will keep your plan compatible with both the possible scenarios on how it is being used in agreement.
$merchantPreferences->setReturnUrl($returnUrl . "?success=true")
    ->setCancelUrl($returnUrl . "?success=false")
    ->setAutoBillAmount("yes")
    ->setInitialFailAmountAction("CONTINUE")
    ->setMaxFailAttempts("0");
    
    // ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));


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