<?php

namespace V2dmIM\Tests\Core;

use V2dmIM\Core\struct\utils\validate\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{

    function test()
    {
        $path = __DIR__ . DS . 'config.php';
        print_r($path);
        $config = Config::instance($path);
        $this->assertTrue($config->a === 1);
    }
}
