<?php

namespace Pipisco\Verotel\FlexPay\PaymentProcessor;

use Pipisco\Verotel\FlexPay\FlexPayHelper;

/**
 * Class Bill
 * @package Pipisco\Verotel\FlexPay\PaymentProcessor
 */
class Bill extends FlexPayHelper
{

    /**
     * Base billing URL
     *
     * @var string
     */
    protected const BASE_URL = 'https://secure.bill.creditcard/';

}
