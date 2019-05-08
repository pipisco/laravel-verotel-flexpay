<?php

namespace Pipisco\Verotel\FlexPay\Traits;

use Pipisco\Verotel\FlexPay\Enums\UrlParameter;

/**
 * Trait SignatureCalculation
 * @package Pipisco\Verotel\FlexPay\Traits
 */
trait SignatureCalculation
{

    /**
     * @var array
     */
    protected $excluded_params = [
        UrlParameter::EMAIL,
        UrlParameter::SIGNATURE,
    ];

    /**
     * @param array $params
     * @return string
     */
    public function getSignature(array $params) : string
    {
        $signature_array = [$this->secret];
        $params          = $this->excluded($params);

        foreach ($params as $param => $value) {
            array_push($signature_array, sprintf('%s=%s', $param, $value));
        }

        return strtolower(sha1(join(":", $signature_array)));
    }

    /**
     * @param array $params
     * @return array
     */
    private function excluded(array $params) : array
    {
        foreach ($this->excluded_params as $param) {
            if (isset($params[$param])) {
                unset($params[$param]);
            }
        }

        ksort($params, SORT_REGULAR);

        return $params;
    }

}
