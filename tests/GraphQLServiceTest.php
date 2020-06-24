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
     * PHPUnit test: vendor/bin/phpunit --filter testMutation tests/GraphQLServiceTest.php
     */
    public function testMutation()
    {
        $query = 'mutation{
            storeEvent(
                type: "login", 
                label: "Login",
                device_id: "9PAYTEST0001",
                device_name: "TungNT",
                device_model: "Xiaomi redme note 8 pro",
                platform: "Android",
                os: "Android 11.10",
                browser_name: "Chrome 83.24.11",
                user_agent: "PostmanRuntime/7.25.0",
                ip: "35.247.128.96",
                object_id: "43",
                object_type: "login",
                user_id: "43",
                user_phone: "0888523111"
                network: "WIFI",
                extra_data: ""
            ) {
                type
                label
                device_id
                device_name
                device_model
                platform
                os
                browser_name
                user_agent
                ip
                object_id
                object_type
                network
                user_id
                user_phone
            }    
        }';

        $data = $this->service->query($query);

        echo "\n" . json_encode($data);

        $this->assertArrayNotHasKey('error', $data);
    }

    /**
     * PHPUnit test: vendor/bin/phpunit --filter testQuery tests/GraphQLServiceTest.php
     */
    public function testQuery()
    {
        $query = 'query{
          event(limit: 2){
            data{
                id
                label
                type
                user_id
                user_phone
                object_id
                object_type
                device_id
                device_name
                device_model
                browser_name
                ip
                platform
                network
                os
                user_agent
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

        $data = $this->service->query($query);

        echo "\n" . json_encode($data);

        $this->assertArrayNotHasKey('error', $data);
    }
}
