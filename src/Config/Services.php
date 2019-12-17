<?php namespace Tatter\Stripe\Config;

use CodeIgniter\Config\BaseService;
use Tatter\Stripe\Stripe;

class Services extends BaseService
{
	/**
	 * Returns an instance of the Stripe SDK wrapper class
	 *
	 * @param mixed    $customerId  Initial customer ID to act as
	 * @param boolean  $getShared
	 *
	 * @return \Tatter\Stripe\Stripe
	 */
	public static function stripe($customerId = null, bool $getShared = true): Firebase
	{
		if ($getShared)
		{
			return static::getSharedInstance('stripe', $customerId);
		}

		return new Stripe($customerId);
	}
}
