<?php namespace Tatter\Stripe;

/**
 * Class Stripe
 *
 * A wrapper class for the Stripe PHP SDK.
 */
class Stripe
{
	/**
	 * The customer to act upon.
	 *
	 * @var string|null
	 */
	protected $customerId;
	
	/**
	 * Store an initial customer ID.
	 * Initiate the Stripe API with the environment key.
	 *
	 * @param string  $customerId
	 */
	public function __construct(string $customerId = null)
	{
		// Store the customer ID
		$this->customerId = $customerId;

		// Initialize the API
		\Stripe\Stripe::setApiKey(env('stripe.secret'));
	}
	
	/**
	 * Returns the current customer ID.
	 *
	 * @return string|null  Customer ID
	 */
	public function getCustomerId(): ?string
	{
		return $this->customerId;
	}
	
	/**
	 * Set the customer ID to use for customer-specific calls.
	 *
	 * @param string  $customerId 
	 *
	 * @return $this
	 */
	public function setCustomerId(string $customerId = null): self
	{
		$this->customerId = $customerId;

		return $this;
	}

	/**
	 * Get a payment method.
	 * Example return:
	 *
	 *	"id": "pm_1FqQcsK94IKEAfkDkDtV0aGcC",
	 *	"object": "payment_method",
	 *	"billing_details": {
	 *		"address": {
	 *			"city": null,
	 *			"country": null,
	 *			"line1": null,
	 *			"line2": null,
	 *			"postal_code": "44444",
	 *			"state": null
	 *		},
	 *		"email": "jillian@example.com",
	 *		"name": null,
	 *		"phone": null
	 *	},
	 *	"card": {
	 *		"brand": "visa",
	 *		"checks": {
	 *			"address_line1_check": null,
	 *			"address_postal_code_check": "pass",
	 *			"cvc_check": "pass"
	 *		},
	 *		"country": "US",
	 *		"exp_month": 12,
	 *		"exp_year": 2022,
	 *		"fingerprint": "bHCf4XCyh1gChedJ",
	 *		"funding": "credit",
	 *		"generated_from": null,
	 *		"last4": "4242",
	 *		"three_d_secure_usage": {
	 *			"supported": true
	 *		},
	 *		"wallet": null
	 *	},
	 *	"created": 1576529830,
	 *	"customer": "cus_G7GhvT4cqREHxG",
	 *	"livemode": false,
	 *	"metadata": [],
	 *	"type": "card"
	 *
	 * @return object|null  Payment method objects
	 */
	public function getMethod(string $methodId)
	{
		$response = \Stripe\PaymentMethod::retrieve($methodId);

		return $response->data ?? null;
	}

	/**
	 * Get a customer's current payment methods.
	 *
	 * @return array|null  Payment method objects
	 */
	public function getMethods(): ?array
	{
		if (empty($this->customerId))
		{
			return null;
		}
		
		$response = \Stripe\PaymentMethod::all([
			'customer' => $this->customerId,
			'type' => 'card',
		]);

		return $response->data ?? null;
	}

	/**
	 * Initialize a setup intent.
	 *
	 * @param int  $userId 
	 *
	 * @return $this
	 */
	public function getIntent()
	{	
		return \Stripe\SetupIntent::create();
	}

/* Example of successful setup intent response:
{
  "id": "seti_1FqKEAfDkK9VhK94IkkuSpNk",
  "object": "setup_intent",
  "cancellation_reason": null,
  "client_secret": "seti_1Fq9KEAfVhK94IDkKkkuSpNk_secret_GMtIqD6AzCRdASD3rrENtMBFuETlG8sfoZS",
  "created": 1576464037,
  "description": null,
  "last_setup_error": null,
  "livemode": false,
  "next_action": null,
  "payment_method": "pm_1FqQcsK94IKEAfkDkDtV0aGcC",
  "payment_method_types": [
    "card"
  ],
  "status": "succeeded",
  "usage": "off_session"
}
*/

}
