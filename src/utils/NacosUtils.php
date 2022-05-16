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
// | Version: 2.0 2022/5/16 11:09
// +----------------------------------------------------------------------
namespace V2dmIM\Core\utils;

use alibaba\nacos\Naming;
use RuntimeException;
use Swoole\NameResolver\Nacos;
use Swoole\Timer;
use Throwable;
use V2dmIM\Core\utils\log\Log;

/**
 * Nacos2.0 工具类
 */
class NacosUtils
{

    /**
     * 服务注册+维持心跳
     * @param string $host Nacos服务地址
     * @param string $name 服务名称
     * @param string $ip   服务IP
     * @param int    $port 服务端口
     * @param int    $ms   心跳间隔
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/5/16 11:15
     */
    public static function registerAndHeart(string $host, string $name, string $ip, int $port, int $ms = 5000): void
    {
        try {
            $nacos = new Nacos($host);
            $res   = $nacos->join($name, $ip, $port);
            if ($res !== true) {
                throw new RuntimeException("swoole_service_$name $ip:$port registration failed.");
            }
            $naming   = Naming::init("swoole_service_$name", $ip, $port);
            $instance = $naming->get();
            if ($instance === null) {
                throw new RuntimeException("swoole_service_$name $ip:$port not found.");
            }
        } catch (Throwable $e) {
            Log::error($e->getMessage());
            Timer::after($ms, function () use ($host, $name, $ip, $port, $ms) {
                self::registerAndHeart($host, $name, $ip, $port, $ms);
            });
            return;
        }
        Timer::tick($ms, function (int $timer_id) use ($naming, $instance, $host, $name, $ip, $port, $ms) {
            try {
                $res = $naming->beat($instance);
                Log::debug("Timer::tick#$timer_id swoole_service_$name {$instance->getIp()}:{$instance->getPort()} client beat interval {$res->getClientBeatInterval()}ms.");
            } catch (Throwable $e) {
                Log::error($e->getMessage());
                if (Timer::clear($timer_id)) {
                    Timer::after($ms, function () use ($host, $name, $ip, $port, $ms) {
                        self::registerAndHeart($host, $name, $ip, $port, $ms);
                    });
                }
            }
        });
    }

}
