<?php

namespace Pipisco\Verotel\FlexPay\Enums;

/**
 * Class Event
 * @package Pipisco\Verotel\FlexPay\Enums
 */
class Event
{
    const INITIAL       = 'initial';
    const REBILL        = 'rebill';
    const EXTEND        = 'extend';
    const DOWNGRADE     = 'downgrade';
    const CANCEL        = 'cancel';
    const UNCANCEL      = 'uncancel';
    const EXPIRY        = 'expiry';
    const CREDIT        = 'credit';
    const CHARGEBACK    = 'chargeback';
    const UPGRADE       = 'upgrade';
    const PURCHASE      = 'purchase';
}
