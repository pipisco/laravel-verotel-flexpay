<?php

namespace Pipisco\Verotel\FlexPay\PaymentProcessor;

use Pipisco\Verotel\FlexPay\FlexPayHelper;

/**
 * Class Verotel
 * @package Pipisco\Verotel\FlexPay\PaymentProcessor
 */
class Verotel extends FlexPayHelper
{

    /**
     * Base verotel URL
     *
     * @var string
     */
    protected const BASE_URL = 'https://secure.verotel.com/';

}
