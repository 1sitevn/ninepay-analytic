9Pay Analytic
=======================

This package send notifications. Package is allowing send notifications with firebase, telegram, twilio,...

## Installation

Install MakeResource through Composer.

    "require": {
        "onesite/ninepay-analytic": "~1.0"
    }
    
## Using the package

### Send notification with Firebase

    <?php

    use GuzzleHttp\Psr7\Response;
    
    $service = new OneSite\NinePay\Analytic\Analytic();  

    /**
     * @var Response $response
     */
    $response = $this->service->log($params);
