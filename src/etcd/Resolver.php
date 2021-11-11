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
// | Version: 2.0 2021/11/11 14:01
// +----------------------------------------------------------------------
namespace V2dmIM\Core\etcd;

/**
 * 服务发现
 */
class Resolver extends AbsEtcd
{

    /**
     * 负载均衡索引
     * @var int
     */
    private int $index = 0;

    /**
     * 服务发现
     * @param \V2dmIM\Core\etcd\Schema $schema
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/10 14:17
     */
    public function discovery(Schema $schema): array
    {
        return $this->client->getKeysWithPrefix(sprintf("%s:///", (string)$schema));
    }


    /**
     * 轮询选举
     * @param \V2dmIM\Core\etcd\Schema $schema
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/11 14:53
     */
    public function polling(Schema $schema): ?array
    {
        $res = $this->client->getKeysWithPrefix(sprintf("%s:///", (string)$schema));
        if (isset($res['kvs']) && is_array($res['kvs']) && isset($res['count']) && $res['count'] > 0) {
            $this->index = $this->index <= $res['count'] ? $this->index : 0;
            $result      =& $res['kvs'][$this->index];
            $this->index++;
            return $result;
        }
        return null;
    }

}
