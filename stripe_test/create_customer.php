<?php

require_once('vendor/autoload.php');


try
{
	// Get token from credit card form (see one.html)
	$token = 'tok_19yQAIFjX0PMgDEUVOmxDwMm';

	\Stripe\Stripe::setApiKey("sk_test_mOnLXjlJxHHd48z5pIKOaJxO");

	$customer_email = "abc@abc.com";

	// Create a Customer:
	$customer = \Stripe\Customer::create(array(
	  "email" => $customer_email,
	  "source" => $token,
	));

	// Save the generated cusomter->id

	$customer_stripe_id = $customer->id;
	echo $customer_stripe_id;

}catch(Exception $e)
{
	echo $e->getMessage();
}


?>
