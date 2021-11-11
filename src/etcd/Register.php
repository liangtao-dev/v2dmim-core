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

use Exception;
use V2dmIM\Core\utils\log\Log;

/**
 * 服务注册
 */
class Register extends AbsEtcd
{

    /**
     * 租约 ID
     * @var int
     */
    private int $leaseId = 0;


    /**
     * 是否注销
     * @var bool
     */
    private bool $isUnregister;


    /**
     * 租约运行状态
     * @var bool
     */
    private bool $running;

    /**
     * 服务目录
     * @var \V2dmIM\Core\etcd\Schema
     */
    private Schema $schema;

    /**
     * 注册的服务地址
     * @var string
     */
    private string $host;

    /**
     * 注册的服务端口
     * @var int
     */
    private int $port;

    /**
     * 服务注册
     * @param \V2dmIM\Core\etcd\Schema $schema 服务目录
     * @param string                   $host   注册的服务地址
     * @param int                      $port   注册的服务端口
     * @param int                      $ttl    超时时间(单位为秒），不配置(默认为 0)。则永不超时
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/11 12:11
     */
    public function register(Schema $schema, string $host, int $port, int $ttl = 0): void
    {
        $this->schema = $schema;
        $this->host   = $host;
        $this->port   = $port;
        // 超时大于0，则申请租约
        if ($ttl > 0) {
            $res           = $this->client->grant($ttl);
            $this->leaseId = (int)$res['ID'];
        }
        // schema:///serviceName/ip:port ->ip:port
        $serviceValue = $this->host . ':' . $this->port;
        $serviceKey   = sprintf("%s:///%s/", (string)$this->schema, (string)$this->leaseId) . $serviceValue;
        $this->client->put($serviceKey, $serviceValue, ['lease' => $this->leaseId]);
        // 如果租约存在，则建立心跳机制维持租约
        if ($this->leaseId > 0 && $ttl > 0) {
            $this->running = true;
            while ($this->running) {
                usleep(($ttl - 1) * 1000000); // 超时前1秒，发出心跳请求
                try {
                    $this->client->keepAlive($this->leaseId);
                } catch (Exception) {
                    $this->running = false;
                    Log::warning($serviceKey . ' keepAlive stop.');
                    if (!$this->isUnregister) {
                        // 未注销服务情况下心跳断开，则重新注册服务
                        $this->register($this->schema, $this->host, $this->port, $ttl);
                    }
                }
            }
        }
    }

    /**
     * 服务注销
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/10 15:30
     */
    public function unregister(): void
    {
        $this->running      = false;
        $this->isUnregister = true;
        // schema:///serviceName/ip:port ->ip:port
        $serviceValue = $this->host . ':' . $this->port;
        $serviceKey   = sprintf("%s:///%s/", (string)$this->schema, (string)$this->leaseId) . $serviceValue;
        $this->client->del($serviceKey);
    }

}
