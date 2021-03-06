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

        $this->apiUrl = config('analytic.api_url');
        $this->apiSecret = config('analytic.api_secret');
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
     * @param $logType
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTopServices($logType, array $params = [])
    {
        return $this->client->request('GET', $this->getApiUrl() . "/v1/log/" . $logType . "/top-services", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Api-Key" => $this->getSignature($params)
            ],
            'query' => $params
        ]);
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSuggestServices(array $params = [])
    {
        return $this->client->request('GET', $this->getApiUrl() . "/v1/suggest/services", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Api-Key" => $this->getSignature($params)
            ],
            'query' => $params
        ]);
    }


    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSuggestTools(array $params = [])
    {
        return $this->client->request('GET', $this->getApiUrl() . "/v1/suggest/tools", [
            'http_errors' => false,
            'verify' => false,
            'headers' => [
                "Api-Key" => $this->getSignature($params)
            ],
            'query' => $params
        ]);
    }

    /**
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
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
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function logOrder(array $params = [])
    {
        return $this->client->request('POST', $this->getApiUrl() . "/v1/log/order", [
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
