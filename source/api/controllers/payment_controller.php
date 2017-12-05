<?php

$stripe = array(
  "secret_key"      => "sk_test_kMAJ6A6XRrYEW7tz0q9gjuzo",
  "publishable_key" => "pk_test_EJeN6up1FufL37mUukLr9Qgc"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);

class PaymentController
{

	public function collect($payload){

        // if (!array_key_exists('name', $payload)) {
        //     throw new Exception('`name` should be provided!', 400);
        // } elseif (!array_key_exists('price', $payload)) {
        //     throw new Exception('`price` should be provided!', 400);
        // }

		  $token  = $payload->stripeToken;

		  $customer = \Stripe\Customer::create(array(
		      'email' => $payload->email,
		      'source'  => $token
		  ));

		  $charge = \Stripe\Charge::create(array(
		      'customer' => $customer->id,
		      'amount'   => $payload->amount,
		      'currency' => 'cad'
		  ));
		  
	}

}