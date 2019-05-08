<?php

namespace Pipisco\Verotel\FlexPay\Enums;

/**
 * Class MerchantPrefix
 * @package Pipisco\Verotel\FlexPay\Enums
 */
class MerchantPrefix
{
    /**
     * @var array
     */
    public static $prefix = [
        9408    => PaymentProcessor::VEROTEL,
        9804    => PaymentProcessor::VEROTEL,
        9762    => PaymentProcessor::CARD_BILLING,
        9653    => PaymentProcessor::BITSAFE_PAY,
        9511    => PaymentProcessor::BILL,
        9444    => PaymentProcessor::PAINT_FEST,
        9388    => PaymentProcessor::GAY_CHARGE,
    ];

}
