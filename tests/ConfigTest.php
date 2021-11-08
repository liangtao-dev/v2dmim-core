<?php

namespace V2dmIM\Tests\Core;

use PHPUnit\Framework\TestCase;
use V2dmIM\Core\Config;

class ConfigTest extends TestCase
{

    public function testInstance()
    {
        $path = __DIR__ . DS . 'config.php';
        print_r($path);
        $config = Config::instance($path);
        $this->assertTrue($config->a === 1);
    }
}
