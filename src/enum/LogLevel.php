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
// | Version: 2.0 2022/5/16 18:00
// +----------------------------------------------------------------------
namespace V2dmIM\Core\enum;

/**
 * 日志等级
 */
enum LogLevel:string
{
    case EMERGENCY = 'emergency';
    case ALERT     = 'alert';
    case CRITICAL  = 'critical';
    case ERROR     = 'error';
    case WARNING   = 'warning';
    case NOTICE    = 'notice';
    case INFO      = 'info';
    case DEBUG     = 'debug';
}
