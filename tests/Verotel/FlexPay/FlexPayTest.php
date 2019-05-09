<?php

namespace Pipisco\Tests\Verotel\FlexPay;

use PHPUnit\Framework\TestCase;
use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\FlexPayClient;

class FlexPayTest extends TestCase
{

    protected $shop_key                  = 115790;
    protected $signature_key             = 'KzkfbQBeTEAPjFXFuPfuAzUfZZzSqz';
    protected $version                   = '3.4';
    protected $merchant_id               = '9804000000000000';

    protected $bill_base_uri             = 'https://secure.bill.creditcard/';
    protected $bitsafe_pay_base_uri      = 'https://secure.bitsafepay.com/';
    protected $card_billing_base_uri     = 'https://secure.billing.creditcard/';
    protected $gay_charge_base_uri       = 'https://secure.gaycharge.com/';
    protected $paint_fest_base_uri       = 'https://secure.paintfestpayments.com/';
    protected $verotel_base_uri          = 'https://secure.verotel.com/';

    protected $postback_purchase_request  = 'CCBrand=1010101010101&custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&paymentMethod=CC&priceAmount=12.31&priceCurrency=EUR&referenceID=98040000000000000&saleID=456789&shopID=115790&transactionID=1001000&truncatedPAN=XXXXXXXXXXXX3321&type=purchase&signature=4d3119e55dc0307154a84140367f5abb976c694e';
    protected $postback_initial_request   = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=initial&expiresOn=2019-06-09&paymentMethod=CC&period=P1M&priceAmount=12.31&priceCurrency=EUR&referenceID=98040000000000000&saleID=500000&shopID=115790&subscriptionType=one-time&transactionID=100100&type=subscription&signature=7a1a4b6b582743029c4d28667db4b254f35d8ebd';
    protected $postback_rebill_request    = 'amount=12.31&currency=EUR&custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=rebill&nextChargeOn=2019-06-30&paymentMethod=CC&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=recurring&type=subscription&signature=a2a4a35f826faf8b13ec4b09840585245dc40b76';
    protected $postback_cancel_request    = 'cancelledBy=user&custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=cancel&expiresOn=2019-06-30&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=recurring&type=subscription&signature=f74697510b90abcf693febcec131e55d8f6703b3';
    protected $postback_uncancel_request  = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=uncancel&nextChargeOn=2019-06-09&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=recurring&type=subscription&uncancelledBy=support&signature=f9160b82a665834224e21d851ef927ef0557e166';
    protected $postback_extend_request    = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=extend&expiresOn=2019-06-09&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=one-time&type=subscription&signature=8ca04bd64b0fb2cefaa26572220e6c237dfb930c';
    protected $postback_expiry_request    = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=expiry&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionType=one-time&type=subscription&signature=e8f5bd4af673ba0ee6036c98848b34e1b84e9372';
    protected $postback_downgrade_request = 'amount=12.31&currency=EUR&custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=downgrade&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=one-time&type=subscription&signature=a68fe675f12b88eb1a3097bc1bf3a4b41e88fe23';
    protected $postback_upgrade_request   = 'CCBrand=1010101010101&custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=upgrade&expiresOn=2019-06-09&paymentMethod=CC&period=P1M&precededBySaleID=456788&priceAmount=12.31&priceCurrency=EUR&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionType=one-time&truncatedPAN=XXXXXXXXXXXX0101&type=subscription&signature=d464a6df40a07771a3f38fc2f3910c6436a38a48';
    protected $postback_credit_request    = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=credit&parentID=10101010&priceAmount=12.31&priceCurrency=EUR&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=one-time&transactionID=1001000&type=subscription&signature=6d44120eee1f5c4f8eee6debd4e02d8cb0e99aae';
    protected $postback_chargeback_request    = 'custom1=Custom+Param+1&custom2=Custom+Param+2&custom3=Custom+Param+3&event=chargeback&parentID=10101010&priceAmount=12.31&priceCurrency=EUR&referenceID=98040000000000000&saleID=456789&shopID=115790&subscriptionPhase=normal&subscriptionType=one-time&transactionID=1001000&type=subscription&signature=37429bf3bd4d7917023f4586ec9f9d94df9d1e8d';

    public function testPurchasePostback()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_purchase_request, $postback_purchase_request);
        $data    = $flexpay->postback()->get($postback_purchase_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_purchase_request[UrlParameter::SIGNATURE]);
    }

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
        $data    = $flexpay->postback()->rebill($postback_rebill_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_rebill_request[UrlParameter::SIGNATURE]);
    }

    public function testCancelRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_cancel_request, $postback_cancel_request);
        $data    = $flexpay->postback()->cancel($postback_cancel_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_cancel_request[UrlParameter::SIGNATURE]);
    }

    public function testUncancelRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_uncancel_request, $postback_uncancel_request);
        $data    = $flexpay->postback()->uncancel($postback_uncancel_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_uncancel_request[UrlParameter::SIGNATURE]);
    }

    public function testExtendRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_extend_request, $postback_extend_request);
        $data    = $flexpay->postback()->uncancel($postback_extend_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_extend_request[UrlParameter::SIGNATURE]);
    }

    public function testExpiryRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_expiry_request, $postback_expiry_request);
        $data    = $flexpay->postback()->expiry($postback_expiry_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_expiry_request[UrlParameter::SIGNATURE]);
    }

    public function testDowngradeRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_downgrade_request, $postback_downgrade_request);
        $data    = $flexpay->postback()->downgrade($postback_downgrade_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_downgrade_request[UrlParameter::SIGNATURE]);
    }

    public function testUpgradeRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_upgrade_request, $postback_upgrade_request);
        $data    = $flexpay->postback()->upgrade($postback_upgrade_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_upgrade_request[UrlParameter::SIGNATURE]);
    }

    public function testCreditRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_credit_request, $postback_credit_request);
        $data    = $flexpay->postback()->credit($postback_credit_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_credit_request[UrlParameter::SIGNATURE]);
    }

    public function testChargeBackRequest()
    {
        $flexpay = new FlexPayClient($this->shop_key, $this->signature_key, $this->version);
        parse_str($this->postback_chargeback_request, $postback_chargeback_request);
        $data    = $flexpay->postback()->credit($postback_chargeback_request);

        $this->assertTrue($data[UrlParameter::SIGNATURE] === $postback_chargeback_request[UrlParameter::SIGNATURE]);
    }

}