<?php

namespace Pipisco\Verotel\FlexPay\PaymentProcessor;

use Pipisco\Verotel\FlexPay\FlexPayHelper;

/**
 * Class BitsafePay
 * @package Pipisco\Verotel\FlexPay\PaymentProcessor
 */
class BitsafePay extends FlexPayHelper
{

    /**
     * Base URL bitsafe pay
     *
     * @var string
     */
    protected const BASE_URL = 'https://secure.bitsafepay.com/';

}
