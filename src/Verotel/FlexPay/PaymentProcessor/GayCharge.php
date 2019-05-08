<?php

namespace Pipisco\Verotel\FlexPay\PaymentProcessor;

use Pipisco\Verotel\FlexPay\FlexPayHelper;

/**
 * Class GayCharge
 * @package Pipisco\Verotel\FlexPay\PaymentProcessor
 */
class GayCharge extends FlexPayHelper
{

    /**
     * Base URL for gay charge
     *
     * @var string
     */
    protected const BASE_URL = 'https://secure.gaycharge.com/';

}
