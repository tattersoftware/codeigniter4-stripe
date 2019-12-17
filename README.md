# Tatter\Stripe
Stripe SDK integration for CodeIgniter 4

## Quick Start

1. Install with Composer: `> composer require tatter/stripe`
2. Set the environment keys: **.env** > `stripe.apiKey` and `stripe.secret`
3. Load the service: `$stripe = service('stripe');`

## Description

This is a CodeIgniter 4 integration of the Stripe PHP SDK

* [Documentation](https://stripe.com/docs)
* [API Reference](https://stripe.com/docs/api)
* [GitHub repository](https://github.com/stripe/stripe-php)

## Installation

Install easily via Composer to take advantage of CodeIgniter 4's autoloading capabilities
and always be up-to-date:
* `> composer require tatter/stripe`

Or, install manually by downloading the source files and adding the directory to
`app/Config/Autoload.php`.

## Configuration

Edit **.env** in your project root and add your Stripe credentials from the
[Stripe Dashboard](https://dashboard.stripe.com/account/apikeys). E.g.:

```
#--------------------------------------------------------------------
# STRIPE
#--------------------------------------------------------------------

stripe.apiKey = pk_test_6pRNASCoBOKtIshFeQd4XMUh
stripe.secret = sk_test_BQokikJOvBiI2HlWgH4olfQ2
```

> *WARNING* Make sure you never include credentials in your repository!

## Usage

Load the Stripe service:

	$stripe = service('stripe');

