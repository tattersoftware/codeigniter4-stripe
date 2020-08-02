<?php

use CodeIgniter\Test\CIUnitTestCase;
use Stripe\Customer;
use Stripe\StripeClient;

class ServiceTest extends CIUnitTestCase
{
	public function testServiceReturnsClient()
	{
		$result = service('stripe');

		$this->assertInstanceOf('Stripe\StripeClient', $result);
	}

	public function testServiceClientWorks()
	{
		$stripe = service('stripe');

		$customer = $stripe->customers->create(['email' => 'bazinga@example.com']);
		$stripe->customers->delete($customer->id);

		$this->assertInstanceOf(Customer::class, $customer);
	}
}

