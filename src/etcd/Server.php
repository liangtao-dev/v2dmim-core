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
// | Version: 2.0 2021/11/9 15:23
// +----------------------------------------------------------------------
namespace V2dmIM\Core\etcd;

use Etcd\Client;
use V2dmIM\Core\Struct;

class Server extends Struct
{

    //etcd client
    private Client $etcdClient;
    //租约
    private $lease;
    //设置租约时间返回
    private $leaseResp;
    //租约撤销
    private $canclefunc;
    //租约keepalieve相应chan
    private $keepAliveChan;
    //注册的key
    private string $key;

}
