<?php

namespace OneSite\NinePay\Analytic;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

/**
 * Class GraphQLService
 * @package OneSite\NinePay\Analytic
 */
class GraphQLService
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
     * @param $query
     * @param array $variables
     * @param array $headers
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function query($query, $variables = [], $headers = [])
    {
        $params = [
            'query' => $query,
            'variables' => $variables,
            'hash' => md5(time())
        ];

        $defaultHeaders = [
            'Api-Key' => $this->getSignature([
                'hash' => $params['hash']
            ])
        ];

        /**
         * @var Response $response
         */
        $response = $this->client->request('POST', $this->getApiUrl() . "/graphql", [
            'http_errors' => false,
            'verify' => false,
            'headers' => array_merge($defaultHeaders, $headers),
            'form_params' => $params
        ]);

        $responseCode = $response->getStatusCode();
        $responseContent = json_decode($response->getBody());
        if ($responseCode != 200) {
            return [
                'error' => [
                    'status_code' => $responseCode,
                    'message' => $responseContent
                ]
            ];
        }

        return [
            'data' => $responseContent
        ];
    }

    /**
     * @param $key
     * @param string $default
     * @return mixed|string
     */
    private function getHeader($key, $default = '')
    {
        return !empty($_SERVER[$key]) ? $_SERVER[$key] : $default;
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
