<?php

namespace App\Config;

/*
*
* This file contains example values to alter default library behavior.
* Recommended usage:
*	1. Copy the file to app/Config/
*	2. Change any values
*	3. Remove any lines to fallback to defaults
*
*/

class Stripe extends \Tatter\Stripe\Config\Stripe
{
	/**
	 * Your API key
	 *
	 * @var string
	 */
	public $apiKey = '';

	/**
	 * Which version of Stripe's API to use.
	 * Make sure you are familair with Stripe's per-user API versioning before changing this.
	 * https://stripe.com/docs/api/versioning
	 *
	 * @var string|null
	 */
	public $apiVersion = '2020-03-02';

	/**
	 * Your project's name.
	 *
	 * @var string
	 */
	public $appName = 'Tatter\Stripe';

	/**
	 * Your project's version.
	 *
	 * @var string|null
	 */
	public $appVersion = '2.0.0';

	/**
	 * The URL for your project's website with your contact details
	 *
	 * @var string|null
	 */
	public $appUrl = 'https://github.com/tattersoftware/codeigniter4-stripe';

	/**
	 * Your Partner ID from the Partners section of the Dashboard.
	 * Required for Stripe Verified Partners, optional otherwise.
	 *
	 * @var string|null
	 */
	public $partnerID;
}
