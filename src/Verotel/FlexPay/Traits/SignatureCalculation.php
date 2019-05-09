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
    protected $excluded_request_params = [
        UrlParameter::EMAIL,
        UrlParameter::SIGNATURE,
    ];

    protected $excluded_postback_params = [
        UrlParameter::EMAIL,
        UrlParameter::SIGNATURE,
        UrlParameter::VERSION,
    ];

    protected $excluded_callback_params = [
        UrlParameter::EMAIL,
        UrlParameter::SIGNATURE,
        UrlParameter::VERSION,
    ];

    /**
     * @param array $params
     * @return string
     */
    public function getSignature(array $params) : string
    {
        $signature_array = [$this->secret];
        $params          = $this->excluded($params, $this->excluded_request_params);

        foreach ($params as $param => $value) {
            array_push($signature_array, sprintf('%s=%s', $param, $value));
        }

        return $this->signature(join(':', $signature_array));
    }

    /**
     * @param array $params
     * @return string
     */
    public function getCallbackSigntature(array $params) : string
    {
        $signature_array = [$this->secret];
        $params          = $this->excluded($params, $this->excluded_callback_params);

        foreach ($params as $param => $value) {
            array_push($signature_array, sprintf('%s=%s', $param, $value));
        }

        return $this->signature(join(':', $signature_array));
    }

    /**
     * @param array $params
     * @return string
     */
    public function getPostbackSignature(array $params) : string
    {
        $signature_array = [$this->secret];
        $params          = $this->excluded($params, $this->excluded_postback_params);

        foreach ($params as $param => $value) {
            array_push($signature_array, sprintf('%s=%s', $param, $value));
        }

        return $this->signature(join(':', $signature_array));
    }

    /**
     * @param array $params
     * @param array $excluded
     * @return array
     */
    private function excluded(array $params, array $excluded = []) : array
    {
        foreach ($excluded as $param) {
            if (isset($params[$param])) {
                unset($params[$param]);
            }
        }

        ksort($params, SORT_REGULAR);

        return $params;
    }

    /**
     * @param string $string
     * @return string
     */
    private function signature(string $string) : string
    {
        return strtolower(sha1($string));
    }
}
