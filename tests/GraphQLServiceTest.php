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
        ]);

        echo "\n" . json_encode($data);

        $this->assertArrayNotHasKey('error', $data);
    }
}
