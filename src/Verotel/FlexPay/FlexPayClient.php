<?php

namespace Pipisco\Verotel\FlexPay;

use Pipisco\Verotel\FlexPay\Callback\CallbackHandler;
use Pipisco\Verotel\FlexPay\PaymentProcessor\Bill;
use Pipisco\Verotel\FlexPay\PaymentProcessor\BitsafePay;
use Pipisco\Verotel\FlexPay\PaymentProcessor\CardBilling;
use Pipisco\Verotel\FlexPay\PaymentProcessor\GayCharge;
use Pipisco\Verotel\FlexPay\PaymentProcessor\PaintFest;
use Pipisco\Verotel\FlexPay\PaymentProcessor\Verotel;
use Pipisco\Verotel\FlexPay\Enums\PaymentProcessor;
use Pipisco\Verotel\FlexPay\Enums\MerchantPrefix;
use Pipisco\Verotel\FlexPay\Enums\Version;
use Pipisco\Verotel\FlexPay\Postback\PostbackHandler;

/**
 * Class FlexPayClient
 * @package Pipisco\Verotel\FlexPay
 */
class FlexPayClient
{

    /**
     * Latest protocol version is 3.4
     *
     * @var string
     */
    private $version = '3.4';

    /**
     * @var Verotel
     */
    private $verotel;

    /**
     * @var CardBilling
     */
    private $card_billing;

    /**
     * @var BitsafePay
     */
    private $bitsafe_pay;

    /**
     * @var Bill
     */
    private $bill;

    /**
     * @var PaintFest
     */
    private $paint_fest;

    /**
     * @var GayCharge
     */
    private $gay_charge;

    /**
     * @var int|mixed|null
     */
    private $shop_id;

    /**
     * @var mixed|null|string
     */
    private $secret;

    /**
     * @var PostbackHandler
     */
    private $postback;

    /**
     * @var CallbackHandler
     */
    private $callback;

    /**
     * FlexPayClient constructor.
     * @param int|null $shop_id
     * @param null|string $secret
     * @param string $version
     */
    public function __construct(?int $shop_id = null, ?string $secret = null, ?string $version = Version::LATEST)
    {
        $this->shop_id  = $shop_id ?? env('VEROTEL_FLEXPAY_ID', null);
        $this->secret   = $secret ?? env('VEROTEL_FLEXPAY_SECRET', null);
        $this->version  = $version ?? env('VEROTEL_FLEXPAY_API_VERSION', Version::LATEST);
    }

    /**
     * @param int $shop_id
     */
    public function setShopId(int $shop_id) : void
    {
        $this->shop_id = $shop_id;
    }

    /**
     * @param string $secret
     */
    public function setSecret(string $secret) : void
    {
        $this->secret = $secret;
    }

    public function setVersion(string $version) : void
    {
        $this->version = $version;
    }

    /**
     * @param null|string $merchant
     * @return Bill|BitsafePay|CardBilling|GayCharge|PaintFest|Verotel
     * @throws \Exception
     */
    public function processor(?string $merchant = null)
    {
        $merchant        = $merchant ?? env('VEROTEL_FLEXPAY_MERCHANT_ID', null);

        if (is_null($merchant)) {
            throw new FlexPayException('Metrchant id is not define');
        }

        $merchant_prefix = intval(substr($merchant, 0, 4));
        $processor       = MerchantPrefix::$prefix[$merchant_prefix] ?? PaymentProcessor::VEROTEL;

        switch ($processor) {
            case PaymentProcessor::VEROTEL:
                return $this->verotel();

            case PaymentProcessor::CARD_BILLING:
                return $this->cardBilling();

            case PaymentProcessor::BITSAFE_PAY;
                return $this->bitsafePay();

            case PaymentProcessor::BILL:
                return $this->bill();

            case PaymentProcessor::PAINT_FEST:
                return $this->paintFest();

            case PaymentProcessor::GAY_CHARGE:
                return $this->gayCharge();
                
            default:
                return $this->verotel();
        }
    }

    /**
     * @return Verotel
     */
    public function verotel() : Verotel
    {
        if (! $this->verotel) {
            $this->verotel = new Verotel($this->shop_id, $this->secret, $this->version);
        }

        return $this->verotel;
    }

    /**
     * @return CardBilling
     */
    public function cardBilling() : CardBilling
    {
        if (! $this->card_billing) {
            $this->card_billing = new CardBilling($this->shop_id, $this->secret, $this->version);
        }

        return $this->card_billing;
    }

    /**
     *
     * @return BitsafePay
     */
    public function bitsafePay() : BitsafePay
    {
        if (! $this->bitsafe_pay) {
            $this->bitsafe_pay = new BitsafePay($this->shop_id, $this->secret, $this->version);
        }

        return $this->bitsafe_pay;
    }

    /**
     * @return Bill
     */
    public function bill() : Bill
    {
        if (! $this->bill) {
            $this->bill = new Bill($this->shop_id, $this->secret, $this->version);
        }

        return $this->bill;
    }

    /**
     * @return PaintFest
     */
    public function paintFest() : PaintFest
    {
        if (! $this->paint_fest) {
            $this->paint_fest = new PaintFest($this->shop_id, $this->secret, $this->version);
        }

        return $this->paint_fest;
    }

    /**
     * @return GayCharge
     */
    public function gayCharge() : GayCharge
    {
        if (! $this->gay_charge) {
            $this->gay_charge = new GayCharge($this->shop_id, $this->secret, $this->version);
        }

        return $this->gay_charge;
    }

    /**
     * @return PostbackHandler
     */
    public function postback() : PostbackHandler
    {
        if (! $this->postback) {
            $this->postback = new PostbackHandler($this->shop_id, $this->secret, $this->version);
        }

        return $this->postback;
    }

    /**
     * @return CallbackHandler
     */
    public function callback() : CallbackHandler
    {
        if (! $this->callback) {
            $this->callback = new CallbackHandler($this->shop_id, $this->secret, $this->version);
        }

        return $this->callback;
    }

}
