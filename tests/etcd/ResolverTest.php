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
// | Version: 2.0 2021/11/11 14:19
// +----------------------------------------------------------------------
namespace V2dmIM\Tests\Core\etcd;

use Etcd\Client;
use PHPUnit\Framework\TestCase;
use V2dmIM\Core\etcd\Resolver;
use V2dmIM\Core\etcd\Schema;

class ResolverTest extends TestCase
{

    private Resolver $service;

    public function testDiscovery()
    {
        $res = $this->service->discovery(Schema::GATEWAY());
        $this->assertIsArray($res);
        isset($res['count']) && print_r($res['count']);
        isset($res['kvs']) && print_r($res['kvs']);
    }

    public function testPolling()
    {
        for ($x = 0; $x <= 3; $x++) {
            $res = $this->service->polling(Schema::GATEWAY());
            $this->assertIsArray($res);
            print_r($res);
        }
    }

    public function testClean()
    {
        $client = new Client();
        $res    = $client->del("gateway:///7587858441548134199/192.168.0.200:9502");
        $this->assertIsArray($res);
        print_r($res);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new Resolver();
    }
}
