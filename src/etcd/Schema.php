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
// | Version: 2.0 2021/11/8 17:48
// +----------------------------------------------------------------------
namespace V2dmIM\Core\etcd;

use V2dmIM\Core\Enum;

/**
 * 服务目录
 * @method static GATEWAY()
 * @method static HTTP()
 * @method static USER()
 * @method static FRIEND()
 * @method static OFFLINE_MESSAGE()
 * @method static PUSH()
 * @method static ONLINE_MESSAGE_RELAY()
 * @method static GROUP()
 * @method static AUTH()
 */
class Schema extends Enum
{

    // 长连接网关服务
    const GATEWAY = 'Gateway';

    // 短连接API服务
    const HTTP = 'Http';


    const USER                 = 'User';
    const FRIEND               = 'Friend';
    const OFFLINE_MESSAGE      = 'OfflineMessage';
    const PUSH                 = 'Push';
    const ONLINE_MESSAGE_RELAY = 'OnlineMessageRelay';
    const GROUP                = 'Group';
    const AUTH                 = 'Auth';

}
