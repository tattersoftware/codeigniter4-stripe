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
	 * Get a payment method. See docs for example return object:
	 * https://stripe.com/docs/api/payment_methods
	 *
	 * @return Stripe\PaymentMethod|null  The payment method object
	 */
	public function getMethod(string $methodId)
	{
		return \Stripe\PaymentMethod::retrieve($methodId) ?? null;
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
