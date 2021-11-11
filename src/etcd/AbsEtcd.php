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
// | Version: 2.0 2021/11/11 14:02
// +----------------------------------------------------------------------
namespace V2dmIM\Core\etcd;

use Etcd\Client;
use JetBrains\PhpStorm\Pure;

abstract class AbsEtcd
{
    /**
     * etcd 客户端
     * @var \Etcd\Client
     */
    protected Client $client;

    /**
     * 构造函数
     * @param string $etcdAddress etcd服务器地址
     * @param string $version     etcd服务器版本
     */
    #[Pure] public function __construct(string $etcdAddress = '127.0.0.1:2379', string $version = 'v3')
    {
        $this->client = new Client($etcdAddress, $version);
    }

}
