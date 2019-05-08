<?php

namespace Pipisco\Verotel\FlexPay\PaymentProcessor;

use Pipisco\Verotel\FlexPay\FlexPayHelper;

/**
 * Class CardBilling
 * @package Pipisco\Verotel\FlexPay\PaymentProcessor
 */
class CardBilling extends FlexPayHelper
{

    /**
     * Base URL card billing
     *
     * @var string
     */
    protected const BASE_URL = 'https://secure.billing.creditcard/';

}
