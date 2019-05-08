<?php

namespace Pipisco\Verotel\FlexPay\Enums;

/**
 * Class Type
 * @package App\Components\Payments\Verotel\FlexPay\Enums
 */
class Type
{
    /**
     * @var string
     */
    const PURCHASE              = 'purchase';

    /**
     * @var string
     */
    const SUBSCRIPTION          = 'subscription';

    /**
     * @var string
     */
    const UPGRADE_SUBSCRIPTION  = 'upgradesubscription';

    /**
     * @var null
     */
    const NULL_TYPE             = null;
}