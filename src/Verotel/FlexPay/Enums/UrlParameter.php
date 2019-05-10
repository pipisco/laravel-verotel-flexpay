<?php

namespace Pipisco\Verotel\FlexPay\Enums;

/**
 * Class UrlParameter
 * @package Pipisco\Verotel\FlexPay\Enums
 */
class UrlParameter
{

    /**
     * Version of the FlexPay call, 3.4 for this version
     *
     * @var string
     */
    const VERSION                       = 'version';

    /**
     * ID of the website in the Verotel system
     *
     * @var string
     */
    const SHOP_ID                       = 'shopID';

    /**
     * See Type::class
     *
     * @var string
     */
    const TYPE                          = 'type';

    /**
     * Amount to be processed in nnn.nn format
     *
     * @var string
     */
    const PRICE_AMOUNT                  = 'priceAmount';

    /**
     * See support currency in the Currency::class
     *
     * @var string
     */
    const PRICE_CURRENCY                = 'priceCurrency';

    /**
     * Text is displayed on the order page - max 100 printable characters
     *
     * @var string
     */
    const DESCRIPTION                   = 'description';

    /**
     * Payment method, CC, DDEU or BTC (if not set then buyers can choose from available payment methods)
     *
     * @NOTE: DDEU is available only in DE, AT, CH, BE, IT, NL, ES and FR
     * @var string
     */
    const PAYMENT_METHOD                = 'paymentMethod';

    /**
     * Merchant's reference identifier. It must be unique if provided
     *
     * @var string
     */
    const REFERENCE_ID                  = 'referenceID';

    /**
     * Pass-through variable - max 255 printable characters
     *
     * @var string
     */
    const CUSTOM_1                      = 'custom1';

    /**
     * Pass-through variable - max 255 printable characters
     *
     * @var string
     */
    const CUSTOM_2                      = 'custom2';

    /**
     * Pass-through variable - max 255 printable characters
     *
     * @var string
     */
    const CUSTOM_3                      = 'custom3';

    /**
     * URL for redirect after successful transaction - max 255 characters
     *
     * @var string
     */
    const BACK_URL                      = 'backURL';

    /**
     * URL for redirect after declined transaction - max 255 characters
     *
     * @var string
     */
    const DECLINE_URL                   = 'declineURL';

    /**
     * The one-time oneClickToken from previous purchase
     *
     * @NOTE: oneClickToken is excluded from signature calculations
     * @var string
     */
    const ONE_CLICK_TOKEN               = 'oneClickToken';

    /**
     * Email of the buyer. If not set, it will be collected on the Order Page
     *
     * @NOTE: email is excluded from signature calculations (max 100 chars else it will be ignored)
     * @var string
     */
    const EMAIL                         = 'email';

    /**
     * Signature
     *
     * @NOTE See SignatureCalculation::class
     */
    const SIGNATURE                     = 'signature';

    /**
     * Duration in ISO8601 format, for example: P30D, minimum is 7 days for recurring and 2 days for on-time
     *
     * @var string
     */
    const PERIOD                        = 'period';

    /**
     * @var string
     */
    const SUBSCRIPTION_TYPE             = 'subscriptionType';

    /**
     * @var string
     */
    const EVENT                         = 'event';

    /**
     * @var string
     */
    const SALE_ID                       = 'saleID';

    /**
     * @var string
     */
    const NEXT_CHARGE_ON                = 'nextChargeOn';

    /**
     * @var string
     */
    const EXPIRES_ON                    = 'expiresOn';

    /**
     * @var string
     */
    const CANCELLED_BY                  = 'cancelledBy';

    /**
     * @var string
     */
    const SUBSCRIPTION_PHASE            = 'subscriptionPhase';

    /**
     * @var string
     */
    const UNCANCELLED_BY                = 'uncancelledBy';

    /**
     * @var string
     */
    const TRANSACTION_ID                = 'transactionID';

    /**
     * @var string
     */
    const PARENT_ID                     = 'parentID';

    /**
     * Description of the product. Text is displayed on the order page - max 100 printable characters
     *
     * @var string
     */
    const NAME                          = 'name';

    /**
     * @var string
     */
    const CC_BRAND                      = 'CCBrand';

    /**
     * @var string
     */
    const TRUNCATED_PAN                 = 'truncatedPAN';

    /**
     * @var string
     */
    const PRECEDED_BY_SALE_ID           = 'precededBySaleID';

    /**
     * @var string
     */
    const PRECEDING_SALE_ID             = 'precedingSaleID';

    /**
     * @var string
     */
    const TRIAL_AMOUNT                  = 'trialAmount';

    /**
     * @var string
     */
    const TRIAL_PERIOD                  = 'trialPeriod';

    /**
     * @var string
     */
    const UPGRADE_OPTIONS               = 'upgradeOption';

    /**
     * @var string
     */
    const AMOUNT                        = 'amount';

    /**
     * @var string
     */
    const CURRENCY                      = 'currency';

    /**
     * @var string
     */
    const RESPONSE                      = 'response';

    /**
     * @var string
     */
    const ERROR                         = 'error';

    /**
     * @var string
     */
    const DISCOUNT_AMOUNT               = 'discountAmount';

    /**
     * @var string
     */
    const EXPIRED                       = 'expired';

    /**
     * @var string
     */
    const COUNTRY                       = 'country';

    /**
     * @var string
     */
    const CANCELLED                     = 'cancelled';

    /**
     * @var string
     */
    const CANCELLED_ON                  = 'cancelledOn';

    /**
     * @var string
     */
    const BTC_TRANSACTION_STATUS        = 'btc_transaction_status';

    /**
     * @var string
     */
    const CREATED_ON                    = 'createdOn';

    /**
     * @var string
     */
    const SALE_RESULT                   = 'saleResult';

    /**
     * @var string
     */
    const BILLING_ADDR_FULL_NAME        = 'billingAddr_fullName';

    /**
     * @var string
     */
    const BILLING_ADDR_COMPANY          = 'billingAddr_company';

    /**
     * @var string
     */
    const BILLING_ADDR_ADDRESS_LINE_1   = 'billingAddr_addressLine1';

    /**
     * @var string
     */
    const BILLING_ADDR_ADDRESS_LINE_2   = 'billingAddr_addressLine2';

    /**
     * @var string
     */
    const BILLING_ADDR_CITY             = 'billingAddr_city';

    /**
     * @var string
     */
    const BILLING_ADDR_ZIP              = 'billingAddr_zip';

    /**
     * @var string
     */
    const BILLING_ADDR_STATE            = 'billingAddr_state';

    /**
     * @var string
     */
    const BILLING_ADDR_COUNTRY          = 'billingAddr_country';
}
