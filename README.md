# Verotel FlexPay Laravel Plugin
[![Build Status](https://travis-ci.com/pipisco/laravel-verotel-flexpay.svg?branch=master)](https://travis-ci.com/pipisco/laravel-verotel-flexpay)

Verotel FlexPay Laravel Package is component for you Laravel application. Package allows you to use Verotel payment gateway and accept credit cards and other payment methods on your website.

## Table of Contents

- <a href="#installation">Installation</a>
    - <a href="#composer">Composer</a>
- <a href="#config">Config</a>
    - <a href="#config-files">Config file</a>
- <a href="#usage">Usage</a>
    - <a href="#create-a-subscription-order">Create a subscription order</a>

## Installation
Install the package via composer:
```
composer require pipisco/laravel-verotel-flexpay
```

## Config
### Config file
Before usage Verotel FlexPay component, you should put to the `.env` configuration files next Verotel credentials

| `.env` variable               | Verotel description               |
| :---------------------------- |:--------------------------------: |
| `VEROTEL_FLEXPAY_ID`          | Your Shop ID                      |
| `VEROTEL_FLEXPAY_SECRET`      | Signature Key                     |
| `VEROTEL_FLEXPAY_MERCHANT_ID` | Merchant ID means yor Verotel ID  |
| `VEROTEL_FLEXPAY_API_VERSION` | Protocol Verotel ID               | 


Example
```php
VEROTEL_FLEXPAY_ID=<SHOP_ID>
VEROTEL_FLEXPAY_SECRET=<SIGNATURE_KEY>
VEROTEL_FLEXPAY_MERCHANT_ID=<MERCHANT_ID>
VEROTEL_FLEXPAY_API_VERSION=3.4
```

## Usage
### Create a subscription order
The "startorder" subscription request is used to redirect buyer to the Verotel Order Page to process subscription with a given amount, duration and currency.

Example method for initial `one-time` subscription. We're choose only mandatory parameters and use `processor()` method to the define payment processor automaticly.
```php
    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribe(Request $request) : RedirectResponse
    {
        $flexpay = new FlexPayClient();
        
        return redirect($flexpay->processor()->subscription([
            UrlParameter::NAME              => 'Order name',
            UrlParameter::SUBSCRIPTION_TYPE => SubscriptionType::ONE_TIME,
            UrlParameter::PRICE_AMOUNT      => 99.99,
            UrlParameter::PRICE_CURRENCY    => Currency::USD,
            UrlParameter::PERIOD            => 'P1M',
        ]));
    }

```

Example method for initial `recurring` subscription.
```php
    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws \Exception
     * @throws \Pipisco\Verotel\FlexPay\FlexPayException
     */
    public function subscribe(Request $request) : RedirectResponse
    {
        $flexpay = new FlexPayClient();

        return redirect($flexpay->processor()->subscription([
            UrlParameter::NAME              => 'Order name',
            UrlParameter::SUBSCRIPTION_TYPE => SubscriptionType::RECURRING,
            UrlParameter::PRICE_AMOUNT      => 99.99,
            UrlParameter::PRICE_CURRENCY    => Currency::USD,
            UrlParameter::PERIOD            => 'P1M',
        ]));
    }
```

Also, you can use supported options parameters, see below table.

| Parameter        | Enum help class                | Type      | Required       | Description                                                    |  
| :--------------- | :----------------------------- | :--------: | :-------------: | :------------------------------------------------------------- |
| `priceAmount`    | `UrlParameter::PRICE_AMOUNT`<br/><br/> You can use `Currency` enum class and choose right currency from then:<br/><br/> - `Currency::USD`<br/>- `Currency::EUR`<br/>- `Currency::GBP`<br/>- `Currency::AUD`<br/>- `Currency::CAD`<br/>- `Currency::CHF`<br/>- `Currency::DKK`<br/>- `Currency::NOK`<br/>- `Currency::SEK` | Float     | **mandatory**  | priceAmount amount to be processed in `nnn.nn` format          |
| `priceCurrency`  | `UrlParameter::PRICE_CURRENCY` | String    | **mandatory**  | `priceCurrency` 3 char ISO code, must be one of the Sale currencies (`USD` `EUR` `GBP` `AUD` `CAD` `CHF` `DKK` `NOK` `SEK`)<br/><br/>NOTE: only EUR is can be used for DDEU payment method system |
| `period` | `UrlParameter::PERIOD` | String | **mandatory** | Duration in **ISO8601** format, for example: **P30D**, minimum is 7 days for recurring and 2 days for on-time |
| `subscriptionType` | `UrlParameter::SUBSCRIPTION_TYPE`<br/><br/> You can use `SubscriptionType` enum class and choose subscription type as bellow:<br/>`SubscriptionType::ONE_TIME`<br/>`SubscriptionType::RECURRING` | String | **mandatory** | NOTE: `DDEU` and `BTC` only support `one-time` | 
| `trialAmount` | `UrlParameter::TRIAL_AMOUNT` | Number | optional | Amount to be processed in `nnn.nn` format for the initial trial period, minimum is 2 days |
| `trialPeriod` | `UrlParameter::TRIAL_PERIOD` | String | optional | Duration in ISO8601 format, for example: **P30D** |
| `name` | `UrlParameter::NAME` | String | optional | Name of the product. Text is displayed on the order page - max 100 printable characters |
| `paymentMethod` | `UrlParameter::PAYMENT_METHOD`<br/><br/>It's a perfect params because yourself choose payment method. For helpful, you can use my `PaymentMethod` enum class as:<br>Credit card payment `PaymentMethod::CREDIT_CARD`<br/>`PaymentMethod::BTC` to Bitcoin payment<br>and `PaymentMethod::DIGITAL_DATA_ENTRY_UTIL` | String | optional | Payment method, `CC`, `DDEU` or `BTC` (if not set then buyers can choose from available payment methods)<br/> NOTE: DDEU is available only in DE, AT, CH, BE, IT, NL, ES and FR |
| `referenceID` | `UrlParameter::REFERENCE_ID` | String | optional | Merchant's reference identifier. It must be unique if provided |
| `custom1` | `UrlParameter::CUSTOM_1` | String | optional | Pass-through variable - max 255 printable characters |
| `custom2` | `UrlParameter::CUSTOM_2` | String | optional | Pass-through variable - max 255 printable characters |
| `custom3` | `UrlParameter::CUSTOM_3` | String | optional | Pass-through variable - max 255 printable characters |
| `backURL` | `UrlParameter::BACK_URL` | String | optional | URL for redirect after successful transaction - max 255 characters |
| `declineURL` | `UrlParameter::DECLINE_URL` | String | optional | URL for redirect after declined transaction - max 255 characters |
| `email` | `UrlParameter::EMAIL` | String | optional | Email of the buyer. If not set, it will be collected on the Order Page |

 
Documentation is under construction. Subscribe to me and stay tuned.
