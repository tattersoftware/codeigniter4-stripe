<?php namespace Tatter\Stripe\Config;

use CodeIgniter\Config\BaseService;
use Stripe\StripeClient;

class Services extends BaseService
{
	/**
	 * Returns an initialized Stripe client
	 *
	 * @param Tatter\Stripe\Config\Stripe $config  Configuration settings to pass to setAppInfo
	 * @param boolean  $getShared
	 *
	 * @return Stripe\StripeClient
	 */
	public static function stripe(Stripe $config = null, bool $getShared = true): StripeClient
	{
		if ($getShared)
		{
			return static::getSharedInstance('stripe', $config);
		}

		if (is_null($config))
		{
			$config = config('Stripe');
		}

		// Initialize the API
		\Stripe\Stripe::setApiKey($config->apiKey);
		\Stripe\Stripe::setAppInfo($config->appName, $config->appVersion, $config->appUrl, $config->partnerID);
		\Stripe\Stripe::setApiVersion('2017-06-05');

		return new StripeClient();
	}
}
