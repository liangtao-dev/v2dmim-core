<?php
declare(strict_types=1);
// +----------------------------------------------------------------------
// | CodeEngine
// +----------------------------------------------------------------------
// | Copyright 艾邦
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: TaoGe <liangtao.gz@foxmail.com>
// +----------------------------------------------------------------------
// | Version: 2.0 2021/11/9 15:36
// +----------------------------------------------------------------------
namespace V2dmIM\Tests\Core\etcd;

use PHPUnit\Framework\TestCase;
use V2dmIM\Core\etcd\Schema;
use V2dmIM\Core\etcd\Service;

class ServiceTest extends TestCase
{

    public function testDiscovery()
    {
        $res = Service::discovery(Schema::WS_GATEWAY(), '127.0.0.1:2379');
        $this->assertIsArray($res);
        print_r($res);
    }

    public function testRegister()
    {
        $res = Service::register(Schema::WS_GATEWAY(), '127.0.0.1:2379', '192.168.0.200', 9502, 'gateway_1');
        $this->assertIsArray($res);
        print_r($res);
    }

    public function testLogoff()
    {
        $res = Service::logoff(Schema::WS_GATEWAY(), '127.0.0.1:2379', '192.168.0.200', 9502, 'gateway_1');
        $this->assertIsArray($res);
        print_r($res);
    }

}
