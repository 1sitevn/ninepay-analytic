<?php


namespace OneSite\NinePay\Analytic\Tests;


use GuzzleHttp\Psr7\Response;
use OneSite\NinePay\Analytic\Analytic;
use PHPUnit\Framework\TestCase;

require_once "helpers.php";

/**
 * Class OrderTest
 * @package OneSite\NinePay\Analytic\Tests
 * vendor/bin/phpunit tests/OrderTest.php
 */
class OrderTest extends TestCase
{

    /**
     * @var Analytic
     */
    private $service;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new Analytic();
    }

    /**
     *
     */
    public function tearDown(): void
    {
        $this->service = null;

        parent::tearDown();
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testLogGameTransaction tests/OrderTest.php
     */
    public function testLogGameTransaction()
    {
        $params = [
            'key' => 'PAY_GAME_299',
            'order_id' => '3329',
            'order_amount' => '10000',
            'order_fee' => '0',
            'order_discount' => '2300',
            'order_total' => '7700',
            'order_type' => 'PAY_GAME',
            'order_platform' => 'WEB',
            'order_created_at' => '2020-03-18 15:32:08',
            'payment_id' => 'wZKQ5Xeo',
            'user_id' => '211',
            'user_phone' => '0962640953',
            'product_id' => '299',
            'product_name' => 'Tam Quốc Go',
            'product_type' => '1',
            'product_price' => '10000',
            'product_image_url' => 'https://cdn.smobgame.com/59bba9053985foutbound80x80.png',
            'product_server_id' => 'z1s1',
            'product_server_name' => 'S1 Quan Vũ',
            'product_character_id' => '78168',
            'product_character_name' => 'BINHTRONG',
            'product_user_name' => 'toilatoi.trang',
            'product_item_id' => '0',
            'log_type' => 'transaction_payment'
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->logOrder($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testLogGameCardTransaction tests/OrderTest.php
     */
    public function testLogGameCardTransaction()
    {
        $params = [
            'key' => 'BUY_GAME_CARD_36',
            'order_id' => '3405',
            'order_amount' => '10000',
            'order_fee' => '0',
            'order_discount' => '2000',
            'order_total' => '8000',
            'order_type' => 'BUY_GAME_CARD',
            'order_platform' => 'WEB',
            'order_created_at' => '2020-04-01 16:07:06',
            'payment_id' => 'je8pOdez',
            'user_id' => '211',
            'user_phone' => '0962640953',
            'product_id' => '36',
            'product_type' => 'funcard_10k',
            'product_price' => '10000',
            'product_image_url' => 'https://storage.googleapis.com/npay/images/fc-1555051293.png',
            'product_image_mobile_url' => 'https://storage.googleapis.com/npay/images/fc-1555051293.png',
            'log_type' => 'transaction_payment'
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->logOrder($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testLogMobileCardTransaction tests/OrderTest.php
     */
    public function testLogMobileCardTransaction()
    {
        $params = [
            'key' => 'BUY_MOBILE_CARD_10',
            'order_id' => '3227',
            'order_amount' => '10000',
            'order_fee' => '0',
            'order_discount' => '0',
            'order_total' => '10000',
            'order_type' => 'BUY_MOBILE_CARD',
            'order_platform' => 'WEB',
            'order_created_at' => '2020-03-18 15:32:08',
            'payment_id' => '21aaP41q',
            'user_id' => '43',
            'user_phone' => '0888523111',
            'product_id' => '10',
            'product_type' => 'vina_10k',
            'product_price' => '10000',
            'product_image_url' => 'https://storage.googleapis.com/npay/display/card/vnp.png',
            'product_image_mobile_url' => 'https://storage.googleapis.com/npay/display/card/vnp.png',
            'log_type' => 'transaction_payment'
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->logOrder($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testLogMobileNetworkTransaction tests/OrderTest.php
     */
    public function testLogMobileNetworkTransaction()
    {
        $params = [
            'key' => 'MOBILE_NETWORK_200',
            'order_id' => '3362',
            'order_amount' => '20000',
            'order_fee' => '0',
            'order_discount' => '0',
            'order_total' => '20000',
            'order_type' => 'MOBILE_NETWORK',
            'order_platform' => 'WEB',
            'order_created_at' => '2020-03-27 06:08:33',
            'payment_id' => 'WeyD34m7',
            'user_id' => '170',
            'user_phone' => '0961675648',
            'product_id' => '200',
            'product_type' => 'vinaphone',
            'product_price' => '20000',
            'product_image_url' => 'https://storage.googleapis.com/npay/display/card/vnp.png',
            'product_data_size' => '1.2',
            'product_data_type' => 'GB',
            'log_type' => 'transaction_payment'
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->logOrder($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testLogTopupMobileTransaction tests/OrderTest.php
     */
    public function testLogTopupMobileTransaction()
    {
        $params = [
            'key' => 'TOPUP_MOBILE_vinaphone',
            'order_id' => '2859',
            'order_amount' => '10000',
            'order_fee' => '0',
            'order_discount' => '0',
            'order_total' => '10000',
            'order_type' => 'TOPUP_MOBILE',
            'order_platform' => 'WEB',
            'order_created_at' => '2020-01-06 18:03:06',
            'payment_id' => 'EZ9YODZr',
            'user_id' => '43',
            'user_phone' => '0888523111',
            'product_type' => 'vinaphone',
            'product_price' => '10000',
            'product_image_url' => 'https://storage.googleapis.com/npay/display/card/vnp.png',
            'log_type' => 'transaction_payment'
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->logOrder($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testGetSuggestServices tests/OrderTest.php
     */
    public function testGetSuggestTools()
    {
        $params = [
            'limit' => 2
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->getSuggestTools($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testGetSuggestServices tests/OrderTest.php
     */
    public function testGetSuggestServices()
    {
        $params = [
            'limit' => 2
        ];

        /**
         * @var Response $response
         */
        $response = $this->service->getSuggestServices($params);

        $this->assertEquals(200, $response->getStatusCode());;
    }
}
