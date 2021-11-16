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
// | Date: 2021/5/8 15:04
// +----------------------------------------------------------------------

namespace V2dmIM\Core\utils\pool;

use Swoole\Database\PDOConfig;


/**
 * PDO连接池
 * @package com\db
 */
class PDOPool
{

    //创建静态私有的变量保存该类对象
    static private ?\Swoole\Database\PDOPool $instance = null;

    // 防止使用new直接创建对象
    private function __construct()
    {
    }

    // 防止使用clone克隆对象

    static public function instance(): \Swoole\Database\PDOPool
    {
        //判断$instance是否是Singleton的对象，不是则创建
        if (is_null(self::$instance)) {
            self::$instance = new \Swoole\Database\PDOPool((new PDOConfig)
                                                               ->withHost(config('database.hostname'))
                                                               ->withPort(config('database.hostport'))
                                                               // ->withUnixSocket('/tmp/mysql.sock')
                                                               ->withDbName(config('database.database'))
                                                               ->withCharset(config('database.charset'))
                                                               ->withUsername(config('database.username'))
                                                               ->withPassword(config('database.password'))
//                                                               ->withOptions([8 => 0, 3 => 2, 11 => 0, 17 => false, 20 => false])
            );
        }
        return self::$instance;
    }

    private function __clone()
    {
    }
}
