<?php

namespace V2dmIM\Tests\Core;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class Packagist extends TestCase
{

    public function testUpdate(): void
    {
        $client = new Client();
        $uri = "https://packagist.org/api/update-package?username=%E6%A2%81%E6%B6%9B&apiToken=FjIlrSn4rDTSTWqSI22l";
        $response = $client->post($uri, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => ["repository" => ["url" => "https://github.com/liangtao-dev/v2dmim-core.git"]]
        ]);
        $string = (string)$response->getBody();
        print_r($string);
        $obj = json_decode($string);
        $this->assertTrue($response->getStatusCode() === 202 && $obj->status === "success");
    }

}
