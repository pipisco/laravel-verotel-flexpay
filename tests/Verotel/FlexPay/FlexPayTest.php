<?php

namespace Pipisco\Tests\Verotel\FlexPay;

use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\FlexPayClient;
use Tests\TestCase;

class FlexPayTest extends TestCase
{

    protected $shop_key                 = 115790;
    protected $signature_key            = 'KzkfbQBeTEAPjFXFuPfuAzUfZZzSqz';
    protected $version                  = '3.4';
    protected $merchant_id              = '9804000000000000';

    protected $bill_base_uri            = 'https://secure.bill.creditcard/';
    protected $bitsafe_pay_base_uri     = 'https://secure.bitsafepay.com/';
    protected $card_billing_base_uri    = 'https://secure.billing.creditcard/';
    protected $gay_charge_base_uri      = 'https://secure.gaycharge.com/';
    protected $paint_fest_base_uri      = 'https://secure.paintfestpayments.com/';
    protected $verotel_base_uri         = 'https://secure.verotel.com/';

    protected $postback_initial_request = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=initial&expiresOn=2019-06-09&paymentMethod=CC&period=P1M&priceAmount=12.31&priceCurrency=EUR&referenceID=98040000000000000&saleID=500000&shopID=115790&subscriptionType=one-time&transactionID=100100&type=subscription&signature=7a1a4b6b582743029c4d28667db4b254f35d8ebd';
    protected $postback_rebill_request  = 'amount=12.31&currency=EUR&custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=rebill&nextChargeOn=2019-06-30&paymentMethod=CC&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=recurring&type=subscription&signature=a2a4a35f826faf8b13ec4b09840585245dc40b76';

    public function testInitialPostback()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_initial_request, $postback_initial_request);
        $data    = $flexpay->postback()->initial($postback_initial_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_initial_request[UrlParameter::SIGNATURE]);
    }

    public function testRebillRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_rebill_request, $postback_rebill_request);
        $data    = $flexpay->postback()->initial($postback_rebill_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_rebill_request[UrlParameter::SIGNATURE]);
    }


}