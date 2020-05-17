<?php

namespace OneSite\NinePay\Analytic;


use GuzzleHttp\Client;


/**
 * Class Analytic
 * @package OneSite\NinePay\Analytic
 */
class Analytic
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiUrl = null;

    /**
     * @var null
     */
    private $apiSecret = null;

    /**
     * Analytic constructor.
     */
    public function __construct()
    {
        $this->client = new Client();

        $this->apiUrl = Config::get('analytic.api_url');
        $this->apiSecret = Config::get('analytic.api_secret');
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     */
    public function setApiUrl(string $apiUrl): void
    {
        $this->apiUrl = $apiUrl;
    }

    /**
     * @return null
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * @param null $apiSecret
     */
    public function setApiSecret($apiSecret): void
    {
        $this->apiSecret = $apiSecret;
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function log(array $params = [])
    {
        return $this->client->request('POST', $this->getApiUrl() . "/v1/log/analytic", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Api-Key" => $this->getSignature($params)
            ],
            'form_params' => $params
        ]);
    }

    /**
     * @param $params
     * @return string
     */
    private function getSignature($params)
    {
        ksort($params);

        return md5(http_build_query($params) . $this->getApiSecret());
    }
}
