<?php

require_once('vendor/autoload.php');

try
{

	\Stripe\Stripe::setApiKey("sk_test_mOnLXjlJxHHd48z5pIKOaJxO");

	// retrive the customer_stripe_id from database when it's time to charge
	$customer_stripe_id = 'cus_AJ2JYeCYaNDsBn';

	$charge = \Stripe\Charge::create(array(
	"amount" => 1000,
	"currency" => "usd",
	"metadata" => array("order_id" => 252, "something" =>"some value"),
	"customer" => $customer_stripe_id
	));

} catch (Exception $e)
{
	echo $e->getMessage();
}




?>
