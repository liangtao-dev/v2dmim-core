<?php

namespace V2dmIM\Tests\Core;

use PHPUnit\Framework\TestCase;
use V2dmIM\Core\Config;

class ConfigTest extends TestCase
{

    public function testInstance()
    {
        $path = __DIR__ . DS . 'config.php';
        var_dump($path);
        $config = Config::instance($path);
        var_dump(config('redis.connections.route.business.register.host'));
        $this->assertTrue($config->a === 1);
    }
}
