<?php


namespace OneSite\NinePay\Analytic;


/**
 * Class Config
 * @package OneSite\NinePay\Analytic
 */
class Config
{
    /**
     * @param $key
     * @param null $default
     * @return array|mixed|null
     */
    public static function get($key, $default = null)
    {
        if (!function_exists('config')) {
            return $default;
        }

        return config($key, $default);
    }
}
