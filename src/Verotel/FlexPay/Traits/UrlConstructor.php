<?php

namespace Pipisco\Verotel\FlexPay\Traits;

use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\FlexPayException;

/**
 * Trait UrlConstructor
 * @package Pipisco\Verotel\FlexPay\Traits
 */
trait UrlConstructor
{

    /**
     * @var array
     */
    protected $attributes = [
        UrlParameter::VERSION                       => null,
        UrlParameter::SHOP_ID                       => null,
        UrlParameter::TYPE                          => null,
        UrlParameter::PRICE_AMOUNT                  => null,
        UrlParameter::PRICE_CURRENCY                => null,
        UrlParameter::DESCRIPTION                   => null,
        UrlParameter::PAYMENT_METHOD                => null,
        UrlParameter::REFERENCE_ID                  => null,
        UrlParameter::CUSTOM_1                      => null,
        UrlParameter::CUSTOM_2                      => null,
        UrlParameter::CUSTOM_3                      => null,
        UrlParameter::BACK_URL                      => null,
        UrlParameter::DECLINE_URL                   => null,
        UrlParameter::ONE_CLICK_TOKEN               => null,
        UrlParameter::EMAIL                         => null,
        UrlParameter::SIGNATURE                     => null,
        UrlParameter::PERIOD                        => null,
        UrlParameter::SUBSCRIPTION_TYPE             => null,
        UrlParameter::EVENT                         => null,
        UrlParameter::SALE_ID                       => null,
        UrlParameter::NEXT_CHARGE_ON                => null,
        UrlParameter::EXPIRES_ON                    => null,
        UrlParameter::CANCELLED_BY                  => null,
        UrlParameter::SUBSCRIPTION_PHASE            => null,
        UrlParameter::UNCANCELLED_BY                => null,
        UrlParameter::TRANSACTION_ID                => null,
        UrlParameter::PARENT_ID                     => null,
        UrlParameter::NAME                          => null,
        UrlParameter::CC_BRAND                      => null,
        UrlParameter::TRUNCATED_PAN                 => null,
        UrlParameter::PRECEDED_BY_SALE_ID           => null,
        UrlParameter::PRECEDING_SALE_ID             => null,
        UrlParameter::TRIAL_AMOUNT                  => null,
        UrlParameter::TRIAL_PERIOD                  => null,
        UrlParameter::UPGRADE_OPTIONS               => null,
        UrlParameter::AMOUNT                        => null,
        UrlParameter::CURRENCY                      => null,
        UrlParameter::RESPONSE                      => null,
        UrlParameter::ERROR                         => null,
        UrlParameter::DISCOUNT_AMOUNT               => null,
        UrlParameter::EXPIRED                       => null,
        UrlParameter::COUNTRY                       => null,
        UrlParameter::CANCELLED                     => null,
        UrlParameter::CANCELLED_ON                  => null,
        UrlParameter::BTC_TRANSACTION_STATUS        => null,
        UrlParameter::CREATED_ON                    => null,
        UrlParameter::SALE_RESULT                   => null,
        UrlParameter::BILLING_ADDR_FULL_NAME        => null,
        UrlParameter::BILLING_ADDR_COMPANY          => null,
        UrlParameter::BILLING_ADDR_ADDRESS_LINE_1   => null,
        UrlParameter::BILLING_ADDR_ADDRESS_LINE_2   => null,
        UrlParameter::BILLING_ADDR_CITY             => null,
        UrlParameter::BILLING_ADDR_ZIP              => null,
        UrlParameter::BILLING_ADDR_STATE            => null,
        UrlParameter::BILLING_ADDR_COUNTRY          => null,
    ];

    /**
     * @param string $version
     */
    public function setVersion(string $version) : void
    {
        $this->attributes[UrlParameter::VERSION] = $version;
    }

    /**
     * @param int $shop_id
     */
    public function setShopId(int $shop_id) : void
    {
        $this->attributes[UrlParameter::SHOP_ID] = $shop_id;
    }

    /**
     * @param null|string $type
     */
    public function setType(?string $type = null) : void
    {
        $this->attributes[UrlParameter::TYPE] = $type;
    }

    /**
     * @param string $price_amount
     */
    public function setPriceAMount(string $price_amount) : void
    {
        $this->attributes[UrlParameter::PRICE_AMOUNT] = $price_amount;
    }

    /**
     * @param string $price_currency
     */
    public function setPriceCurrency(string $price_currency) : void
    {
        $this->attributes[UrlParameter::PRICE_CURRENCY] = $price_currency;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description) : void
    {
        $this->attributes[UrlParameter::DESCRIPTION] = $description;
    }

    /**
     * @param string $payment_method
     */
    public function setPaymentMenthod(string $payment_method) : void
    {
        $this->attributes[UrlParameter::PAYMENT_METHOD] = $payment_method;
    }

    /**
     * @param string $reference_id
     */
    public function setReferenceId(string $reference_id) : void
    {
        $this->attributes[UrlParameter::REFERENCE_ID] = $reference_id;
    }

    /**
     * @param string $custom
     */
    public function setFirstCustomParam(string $custom) : void
    {
        $this->attributes[UrlParameter::CUSTOM_1] = $custom;
    }

    /**
     * @param string $custom
     */
    public function setSecondCustomParam(string $custom) : void
    {
        $this->attributes[UrlParameter::CUSTOM_2] = $custom;
    }

    /**
     * @param string $custom
     */
    public function setThirdCustomParam(string $custom) : void
    {
        $this->attributes[UrlParameter::CUSTOM_3] = $custom;
    }

    /**
     * @param string $back_url
     */
    public function setBackUrl(string $back_url) : void
    {
        $this->attributes[UrlParameter::BACK_URL] = $back_url;
    }

    /**
     * @param string $decline_url
     */
    public function setDeclineUrl(string $decline_url) : void
    {
        $this->attributes[UrlParameter::DECLINE_URL] = $decline_url;
    }

    /**
     * @param string $one_click_token
     */
    public function setOneClickToken(string $one_click_token) : void
    {
        $this->attributes[UrlParameter::ONE_CLICK_TOKEN] = $one_click_token;
    }

    /**
     * @param string $signature
     */
    public function setSignature(string $signature) : void
    {
        $this->attributes[UrlParameter::SIGNATURE] = $signature;
    }

    /**
     * @param string $period
     */
    public function setPeriod(string $period) : void
    {
        $this->attributes[UrlParameter::PERIOD] = $period;
    }

    /**
     * Can be one-time or recurring
     *
     * @param string $subscription_type
     */
    public function setSubscriptionType(string $subscription_type) : void
    {
        $this->attributes[UrlParameter::SUBSCRIPTION_TYPE] = $subscription_type;
    }

    /**
     * @param string $path
     * @param array $params
     * @return string
     * @throws FlexPayException
     */
    public function url(string $path, array $params) : string
    {
        $params                          = $this->serializeParameters($params);
        $signature                       = $this->getSignature($params);
        $params[UrlParameter::SIGNATURE] = $signature;

        return sprintf('%s%s?%s', static::BASE_URL, $path, http_build_query($params));
    }

    /**
     * @param array $params
     * @return array
     * @throws FlexPayException
     */
    public function serializeParameters(array $params) : array
    {
        $serializeArray = [];
        $attributes     = $this->attributes;

        foreach ($attributes as $attribute => $value) {
            if (! is_null($value)) {
                $serializeArray[$attribute] = $value;
            }
        }

        foreach ($params as $param => $user_value) {

            if ($attributes[$param]) {
                continue;
            }
            if (! is_null($attributes[$param])) {
                continue;
            }

            if (isset($serializeArray[$param])) {
                continue;
            }
            if (! is_null($user_value) && strlen($user_value) > 0) {
                $serializeArray[$param] = $user_value;
            }
        }

        if (! isset($serializeArray[UrlParameter::SHOP_ID])) {
            throw new FlexPayException(sprintf('Mandatory parameter %s is not define.', UrlParameter::SHOP_ID));
        }

        ksort($serializeArray, SORT_REGULAR);

        return $serializeArray;
    }
}