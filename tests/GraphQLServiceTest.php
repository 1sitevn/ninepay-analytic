<?php


namespace OneSite\NinePay\Analytic\Tests;


use OneSite\NinePay\Analytic\Analytic;
use OneSite\NinePay\Analytic\GraphQLService;
use PHPUnit\Framework\TestCase;


/**
 * Class GraphQLServiceTest
 * @package OneSite\NinePay\Analytic\Tests
 */
class GraphQLServiceTest extends TestCase
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

        $this->service = new GraphQLService();
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
     * PHPUnit test: vendor/bin/phpunit --filter testQuery tests/GraphQLServiceTest.php
     */
    public function testQuery()
    {
        $query = 'query FetchOrders($user_id: Int!){
          order(user_id: $user_id){
            data{
                order_id
                amount
                fee
                discount
                total
                user_id
                user_phone
                card{type, price, image_url}
                created_at(format:"H:i d/m/Y")
            },
            total,
            per_page,
            current_page,
            from,
            to,
            last_page,
            has_more_pages
          }
        }';

        $data = $this->service->query($query, [
            'user_id' => 43
        ], [
            'Device-ID' => uniqid(),
            'Device-Name' => 'TungNT',
            'Device-Model' => 'Xiaomi Red Mi Note 8 Pro',
            'Platform' => 'Android',
            'OS' => 'Android 1.1',
            'Browser-Name' => 'Chrome',
            'IP-Address' => '35.247.128.96',
            'User-Agent' => 'PostmanRuntime/7.25.0',
            'Firebase-Token' => base64_encode(uniqid()),
            'Network' => 'WIFI',
            'Object-ID' => 0,
            'Object-Type' => 'get_orders',
        ]);

        echo "\n" . json_encode($data);

        $this->assertArrayNotHasKey('error', $data);
    }
}
