<?php

namespace Pipisco\Verotel\FlexPay;

use http\Url;
use Pipisco\Verotel\FlexPay\Enums\Currency;
use Pipisco\Verotel\FlexPay\Enums\SubscriptionType;
use Pipisco\Verotel\FlexPay\Enums\Type;
use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\Traits\SignatureCalculation;
use Pipisco\Verotel\FlexPay\Traits\UrlConstructor;

class FlexPayHelper
{

    use SignatureCalculation, UrlConstructor;

    /**
     * @var string
     */
    private const FLEXPAY_PATH = 'startorder';

    /**
     * @var string
     */
    private const STATUS_PATH  = 'salestatus';

    /**
     * @var string
     */
    private const CANCEL_PATH  = 'cancel-subscription';

    /**
     * @var string
     */
    protected $secret;

    /**
     * @var array
     */
    protected $subscription_mandatory_params = [
        UrlParameter::PRICE_AMOUNT,
        UrlParameter::PRICE_CURRENCY,
        UrlParameter::PERIOD,
        UrlParameter::SUBSCRIPTION_TYPE,
    ];

    /**
     * @var array
     */
    protected $status_page_mandatory_params = [
        UrlParameter::SALE_ID,
    ];

    /**
     * @var array
     */
    protected $cancel_subscription_mandatory_params = [
        UrlParameter::SALE_ID,
    ];

    protected $upgrade_subscription_mandatory_params = [
        UrlParameter::PRECEDING_SALE_ID,
        UrlParameter::PRICE_AMOUNT,
        UrlParameter::PRICE_CURRENCY,
        UrlParameter::PERIOD,
        UrlParameter::SUBSCRIPTION_TYPE,
    ];

    /**
     * FlexPayHelper constructor.
     * @param int $shop_id
     * @param string $secret
     * @param string $version
     */
    public function __construct(int $shop_id, string $secret, string $version)
    {
        $this->secret  = $secret;
        $this->setShopId($shop_id);
        $this->setVersion($version);
    }

    /**
     * @param array $params
     * @return string
     * @throws FlexPayException
     */
    public function purchase(array $params) : string
    {

        $this->setType(Type::PURCHASE);

        return $this->url(self::FLEXPAY_PATH, $params);
    }

    /**
     * @param array $params
     * @return string
     * @throws FlexPayException
     */
    public function subscription(array $params = []) : string
    {
        foreach ($this->subscription_mandatory_params as $param) {
            if (! isset($params[$param])) {
                throw new FlexPayException(sprintf('Mandatory parameter %s is not defined!', $param));
            }
        }

        $this->setType(Type::SUBSCRIPTION);

        return $this->url(self::FLEXPAY_PATH, $params);
    }

    /**
     * @param array $params
     * @return string
     * @throws FlexPayException
     */
    public function status(array $params = [])
    {
        foreach ($this->status_page_mandatory_params as $param) {
            if (! isset($params[$param])) {
                throw new FlexPayException(sprintf('Mandatory parameter %s is not defined!', $param));
            }
        }

        $this->setType(Type::NULL_TYPE);

        return $this->url(self::STATUS_PATH, $params);
    }

    /**
     * @param array $params
     * @return string
     * @throws FlexPayException
     */
    public function upgrade(array $params = [])
    {
        $this->setType(Type::UPGRADE_SUBSCRIPTION);

        return $this->url(self::FLEXPAY_PATH, $params);
    }

    /**
     * @param array $params
     * @return string
     * @throws FlexPayException
     */
    public function cancel(array $params = [])
    {
        foreach ($this->cancel_subscription_mandatory_params as $param) {
            if (! isset($params[$param])) {
                throw new FlexPayException(sprintf('Mandatory parameter %s is not defined!', $param));
            }
        }

        $this->setType(Type::NULL_TYPE);

        return $this->url(self::CANCEL_PATH, $params);
    }

}
