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
// | Version: 2.0 2021/5/28 15:27
// +----------------------------------------------------------------------

namespace V2dmIM\Core\model;

use V2dmIM\Core\enum\DeviceType;
use V2dmIM\Core\Model;

class DeviceModel extends Model
{

    private int $fd;

    private string $ip;

    private DeviceType $device;

    private string $deviceToken = '';

    /**
     * @return int
     */
    public function getFd(): int
    {
        return $this->fd;
    }

    /**
     * @param int $fd
     */
    public function setFd(int $fd): void
    {
        $this->fd = $fd;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return \V2dmIM\Core\enum\DeviceType
     */
    public function getDevice(): DeviceType
    {
        return $this->device;
    }

    /**
     * @param \V2dmIM\Core\enum\DeviceType $device
     */
    public function setDevice(DeviceType $device): void
    {
        $this->device = $device;
    }

    /**
     * @return string
     */
    public function getDeviceToken(): string
    {
        return $this->deviceToken;
    }

    /**
     * @param string $deviceToken
     */
    public function setDeviceToken(string $deviceToken): void
    {
        $this->deviceToken = $deviceToken;
    }

}
