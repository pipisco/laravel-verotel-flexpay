<?php

namespace Pipisco\Verotel\FlexPay\Callback;

use Illuminate\Http\Request;
use Pipisco\Verotel\FlexPay\Enums\UrlParameter;
use Pipisco\Verotel\FlexPay\FlexPayException;
use Pipisco\Verotel\FlexPay\Traits\SignatureCalculation;
use Pipisco\Verotel\FlexPay\Traits\UrlConstructor;

/**
 * Class CallbackHandler
 * @package Pipisco\Verotel\FlexPay\Callback
 */
class CallbackHandler
{

    use SignatureCalculation, UrlConstructor;

    /**
     * @var string
     */
    protected $secret;

    /**
     * Success constructor.
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
     * @param Request $request
     * @return array
     * @throws FlexPayException
     */
    public function success(Request $request) : array
    {
        $serialize = $this->serializeParameters($request->get());

        if ($serialize[UrlParameter::SIGNATURE] != $request->get(UrlParameter::SIGNATURE)) {
            throw new FlexPayException('Access denied. Signature failed verification');
        }

        return $serialize;
    }

}
