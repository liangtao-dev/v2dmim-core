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
use V2dmIM\Core\etcd\Register;
use V2dmIM\Core\etcd\Schema;

class RegisterTest extends TestCase
{

    private Register $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new Register();
    }

    public function testRegister()
    {
        $this->service->register(Schema::GATEWAY(), '192.168.0.200', 9502, 3);
    }

    public function testUnregister()
    {
        $this->service->unregister();
    }

}
