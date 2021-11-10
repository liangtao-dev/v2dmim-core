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
// | Version: 2.0 2021/11/8 17:37
// +----------------------------------------------------------------------
namespace V2dmIM\Core\etcd;

use Etcd\Client;

/**
 * 服务注册与发现
 */
class Service
{

    /**
     * 服务注册
     * @param \V2dmIM\Core\etcd\Schema $schema      服务目录
     * @param string                   $etcdAddress etcd服务器地址
     * @param string                   $host        注册的服务地址
     * @param int                      $port        注册的服务端口
     * @param string                   $serviceName 注册的服务名称
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/9 9:58
     */
    public static function register(Schema $schema, string $etcdAddress, string $host, int $port, string $serviceName): array
    {
        $client = new Client($etcdAddress);
        // schema:///serviceName/ip:port ->ip:port
        $serviceValue = $host . ':' . $port;
        $serviceKey   = sprintf("%s:///%s/", (string)$schema, $serviceName) . $serviceValue;
        return $client->put($serviceKey, $serviceValue);
    }

    /**
     * 服务发现
     * @param \V2dmIM\Core\etcd\Schema $schema
     * @param string                   $etcdAddress
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/10 14:17
     */
    public static function discovery(Schema $schema, string $etcdAddress): array
    {
        $client = new Client($etcdAddress);
        return $client->getKeysWithPrefix(sprintf("%s:///", (string)$schema));
    }

    /**
     * 服务注销
     * @param \V2dmIM\Core\etcd\Schema $schema
     * @param string                   $etcdAddress
     * @param string                   $host
     * @param int                      $port
     * @param string                   $serviceName
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/10 15:30
     */
    public static function logoff(Schema $schema, string $etcdAddress, string $host, int $port, string $serviceName): array
    {
        $client = new Client($etcdAddress);
        // schema:///serviceName/ip:port ->ip:port
        $serviceValue = $host . ':' . $port;
        $serviceKey   = sprintf("%s:///%s/", (string)$schema, $serviceName) . $serviceValue;
        return $client->del($serviceKey);
    }

}
