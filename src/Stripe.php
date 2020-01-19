<?php namespace Tatter\Stripe;

/**
 * Class Stripe
 *
 * A wrapper class for the Stripe PHP SDK.
 */
class Stripe
{
	const LIBRARY_VERSION = '1.0.1';

	/**
	 * The customer to act upon.
	 *
	 * @var string|null
	 */
	protected $customerId;

	/**
	 * Error messages from the last call
	 *
	 * @var array
	 */
	protected $errors = [];
	
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
		\Stripe\Stripe::setAppInfo('Tatter\Stripe', self::LIBRARY_VERSION, 'https://github.com/tattersoftware/codeigniter4-stripe');
	}

	/**
	 * Get and clear any error messsages
	 *
	 * @return array  Any error messages from the last call
	 */
	public function getErrors(): array
	{
		$errors       = $this->errors;
		$this->errors = [];

		return $errors;
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
	 * Returns the current customer, or one specified by its ID.
	 * https://stripe.com/docs/api/customers/retrieve?lang=php
	 *
	 * @param data $data  Optional customer data 
	 *
	 * @return string  ID of the new customer
	 */
	public function getCustomer(string $customerId = null): \Stripe\Customer
	{
		return \Stripe\Customer::retrieve($customerId ?? $this->customerId);
	}

	/**
	 * Create a new customer and set it as the current.
	 * https://stripe.com/docs/api/customers/create?lang=php
	 *
	 * @param data $data  Optional customer data 
	 *
	 * @return string  ID of the new customer
	 */
	public function createCustomer(array $data = []): string
	{
		$response = \Stripe\Customer::create($data);

		$this->customerId = $response->id;

		return $this->customerId;
	}

	/**
	 * Delete a customer by its ID.
	 * https://stripe.com/docs/api/customers/remove?lang=php
	 *
	 * @param string $customerId
	 *
	 * @return bool
	 */
	public function deleteCustomer(array $data = []): string
	{
		if ($customer = $this->getCustomer($customerId))
		{
			$customer->delete();

			return $customer->deleted;
		}

		return false;
	}

	/**
	 * Get a payment method. See docs for example return object:
	 * https://stripe.com/docs/api/payment_methods
	 *
	 * @param string $methodId  The Stripe payment method ID
	 *
	 * @return Stripe\PaymentMethod|null  The payment method object
	 */
	public function getMethod(string $methodId)
	{
		try
		{
			$method = \Stripe\PaymentMethod::retrieve($methodId);
		}
		catch (\Stripe\Exception\InvalidRequestException $e)
		{
			 $this->errors[] = $e->getError()->message;
			 return null;
		}

		return $method;
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
