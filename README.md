# Tatter\Stripe
Stripe SDK integration for CodeIgniter 4

[![](https://github.com/tattersoftware/codeigniter4-stripe/workflows/PHPUnit/badge.svg)](https://github.com/tattersoftware/codeigniter4-stripe/actions/workflows/test.yml)
[![](https://github.com/tattersoftware/codeigniter4-stripe/workflows/PHPStan/badge.svg)](https://github.com/tattersoftware/codeigniter4-stripe/actions/workflows/analyze.yml)
[![](https://github.com/tattersoftware/codeigniter4-stripe/workflows/Deptrac/badge.svg)](https://github.com/tattersoftware/codeigniter4-stripe/actions/workflows/inspect.yml)
[![Coverage Status](https://coveralls.io/repos/github/tattersoftware/codeigniter4-stripe/badge.svg?branch=develop)](https://coveralls.io/github/tattersoftware/codeigniter4-stripe?branch=develop)

## Quick Start

1. Install with Composer: `> composer require tatter/stripe`
2. Set the environment keys: **.env** > `stripe.apiKey` and `stripe.apiSecret`
3. Load the service: `$stripe = service('stripe');`

## Description

This is a CodeIgniter 4 integration of the Stripe PHP SDK

* [Documentation](https://stripe.com/docs)
* [API Reference](https://stripe.com/docs/api?lang=php)
* [GitHub repository](https://github.com/stripe/stripe-php)

## Installation

Install easily via Composer to take advantage of CodeIgniter 4's autoloading capabilities
and always be up-to-date:
* `> composer require tatter/stripe`

Or, install manually by downloading the source files and adding the directory to
`app/Config/Autoload.php`.

## Configuration

The library's default behavior can be altered by extending its config file. Copy
**examples/Stripe.php** to **app/Config/** and follow the instructions
in the comments. If no config file is found in **app/Config** then the library will use its own.

In addition to the configuration you *must* set your `apiSecret` in your **.env** file
in your project root. API keys and secrets are available from the
[Stripe Dashboard](https://dashboard.stripe.com/account/apikeys). E.g.:

```
#--------------------------------------------------------------------
# STRIPE
#--------------------------------------------------------------------

stripe.apiKey = pk_test_6pRNASCoBOKtIshFeQd4XMUh
stripe.apiSecret = sk_test_BQokikJOvBiI2HlWgH4olfQ2
```

> *WARNING* Make sure you never include credentials in your repository!

## Usage

Load the Stripe service:

	$stripe = service('stripe');

At this point you have a working `StripeClient` and can use any of the methods described
in the [Stripe API Docs](https://stripe.com/docs/api?lang=php). Note that API endpoints
are version-specific. See **Configuration** above on how to use the example config file to
override the module default if you want to set a specific version.
