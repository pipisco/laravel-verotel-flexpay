<?php

namespace Pipisco\Verotel\FlexPay\Postback;

use Pipisco\Verotel\FlexPay\Enums\Event;
use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\FlexPayException;
use Pipisco\Verotel\FlexPay\Traits\SignatureCalculation;
use Pipisco\Verotel\FlexPay\Traits\UrlConstructor;

/**
 * Class PostbackHandler
 * @package Pipisco\Verotel\FlexPay\Postback
 */
class PostbackHandler
{

    use SignatureCalculation, UrlConstructor;

    /**
     * @var string
     */
    protected $secret;

    /**
     * PostbackHandler constructor.
     * @param int $shop_id
     * @param string $secret
     * @param string $version
     */
    public function __construct(int $shop_id, string $secret, string $version)
    {
        $this->setShopId($shop_id);
        $this->setVersion($version);
        $this->secret = $secret;

    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     */
    public function get(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        if (! isset($serialize[UrlParameter::EVENT]) || is_null($serialize[UrlParameter::EVENT])) {
            throw new FlexPayException('Undefined post back event type');
        }

        switch ($serialize[UrlParameter::EVENT]) {
            case Event::INITIAL:
                return $this->initial($request);

            case Event::REBILL:
                return $this->rebill($request);

            case Event::EXTEND:
                return $this->extend($request);

            case Event::DOWNGRADE:
                return $this->downgrade($request);

            case Event::CANCEL:
                return $this->cancel($request);

            case Event::UNCANCEL:
                return $this->uncancel($request);

            case Event::EXPIRY:
                return $this->expiry($request);

            case Event::CREDIT:
                return $this->credit($request);

            case Event::CHARGEBACK:
                return $this->chargeback($request);

            case Event::UPGRADE:
                return $this->upgrade($request);
        }
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: The initial sale postback is sent to the nominated "Postback URL" immediately after the sale has been
     * processed. The postback is sent only for successfully approved transactions. The data in the postback provide
     * essential information about the sale. If more information is needed, for example billing address or email
     * address of the buyer, the merchant should query the status page.
     */
    public function initial(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: Rebill postback call is sent to the merchant's URL immediately after a successful rebill transaction.
     */
    public function rebill(array $request) : array 
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE! Merchant or Verotel support may grant extra days to an active subscription. This means that the
     * expiration date or the date of the next planned rebill gets shifted by number of days to the future. The extend
     * postback is then sent to merchant's postback URL to notify the merchant about that the subscription got extended.
     */
    public function extend(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: If Merchant or Verotel support changes the next rebill price the Downgrade postback call is sent
     */
    public function downgrade(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: Cancel postback call is sent to the merchant's URL after the subscription is cancelled by the buyer,
     * merchant, Verotel support or by the system.
     */
    public function cancel(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: Occasionally, buyers wish to revert cancellation of their subscription. Uncancel can be done only by
     * Verotel support. The postback call is sent to the merchant's postback URL immediately after the
     * subscription was uncancelled.
     */
    public function uncancel(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: Expiry postback call is sent to the merchant's postback URL when the subscription gets terminated.
     * The reason for the termination could be the end of a cancelled subscription, declined rebill transaction or
     * termination by Verotel support or the merchant.
     */
    public function expiry(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: Credit postback call is sent to the merchant's postback URL when any transaction of the subscription
     * is credited by merchant, Verotel support or by system (e.g. when an automated refund is performed).
     * The refund also terminates subscription.
     */
    public function credit(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     *
     * @NOTE: Chargeback postback call is sent to the merchant's postback URL when sale transaction is chargebacked.
     * This also blacklists the buyer.
     */
    public function chargeback(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

    /**
     * @param array $request
     * @return array
     * @throws FlexPayException
     * 
     * @NOTE: Upgrade postback call is sent to the merchant's postback URL when the subscription is switched from
     * one plan to another. The postback is sent instead of the Successful sale postbacks when the new subscription
     * the buyer is switching to is successfully created and the previous subscription is terminated in Verotel system
     * (No Expiry postback is sent). See “FlexPay API Upgrade” document for more details.
     */
    public function upgrade(array $request) : array
    {
        $serialize = $this->serializeParameters($request);

        if ($this->getPostbackSignature($serialize) != $request[UrlParameter::SIGNATURE]) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

}
