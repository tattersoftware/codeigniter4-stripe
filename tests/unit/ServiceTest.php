<?php

use CodeIgniter\Test\CIUnitTestCase;
use Stripe\StripeClient;

class ServiceTest extends CIUnitTestCase
{
	public function testServiceReturnsClient()
	{
		$result = service('stripe');

		$this->assertInstanceOf('Stripe\StripeClient', $result);
	}
}

