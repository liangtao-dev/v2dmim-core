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
// | Version: 2.0 2021/6/3 13:42
// +----------------------------------------------------------------------

namespace V2dmIM\Core\struct\response;

use V2dmIM\Core\enum\EventType;
use V2dmIM\Core\Struct;

/**
 * 通知报文
 * @package com\response
 */
class Notify extends Struct
{

    private EventType $event;

    private mixed $data;

    private int $sequence;


    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    /**
     * @return int
     */
    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * @param int $sequence
     */
    public function setSequence(int $sequence): void
    {
        $this->sequence = $sequence;
    }

    /**
     * @return \V2dmIM\Core\enum\EventType
     */
    public function getEvent(): EventType
    {
        return $this->event;
    }

    /**
     * @param \V2dmIM\Core\enum\EventType $event
     */
    public function setEvent(EventType $event): void
    {
        $this->event = $event;
    }

}
