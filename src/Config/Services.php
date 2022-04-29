<?php

namespace Tatter\Stripe\Config;

use CodeIgniter\Config\BaseService;
use Stripe\Stripe;
use Stripe\StripeClient;
use Tatter\Stripe\Config\Stripe as StripeConfig;

class Services extends BaseService
{
    /**
     * Returns an initialized Stripe client
     *
     * @param StripeConfig $config Configuration settings to pass to setAppInfo
     */
    public static function stripe(?StripeConfig $config = null, bool $getShared = true): StripeClient
    {
        if ($getShared) {
            return static::getSharedInstance('stripe', $config);
        }

        if (null === $config) {
            $config = config('Stripe');
        }

        // Initialize the API
        Stripe::setApiKey(env('stripe.apiSecret'));
        Stripe::setAppInfo($config->appName, $config->appVersion, $config->appUrl, $config->partnerID);
        Stripe::setApiVersion($config->apiVersion);

        return new StripeClient(env('stripe.apiSecret'));
    }
}
