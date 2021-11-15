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
// | Version: 2.0 2021/5/28 9:36
// +----------------------------------------------------------------------

use V2dmIM\Core\Config;
use V2dmIM\Core\Result;

/**
 * config
 * @param string $name
 * @return mixed
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2021/11/8 14:01
 */
function config(string $name = ''): mixed
{
    try {
        $instance = Config::instance();
    } catch (Exception) {
        return null;
    }
    $data = $instance->getData();
    if (!empty($name)) {
        $arr = explode('.', $name);
        foreach ($arr as $key) {
            if (array_key_exists($key, $data)) {
                $data = $data[$key];
            } else {
                return null;
            }
        }
    }
    return $data;
}

/**
 * 将字符串转换成二进制
 * @param string $str
 * @param string $separator
 * @return string
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2021/4/14 10:27
 */
function str2bin(string $str, string $separator = ' '): string
{
    //1.列出每个字符
    $arr = preg_split('/(?<!^)(?!$)/u', $str);
    //2.unpack字符
    foreach ($arr as &$v) {
        $temp = unpack('H*', $v);
        $v    = base_convert($temp[1], 16, 2);
        unset($temp);
    }
    return join($separator, $arr);
}

/**
 * 将二进制转换成字符串
 * @param string $str
 * @param string $separator
 * @return string
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2021/4/14 10:27
 */
function bin2str(string $str, string $separator = ' '): string
{
    $arr = explode($separator, $str);
    foreach ($arr as &$v) {
        $v = pack("H" . strlen(base_convert($v, 2, 16)), base_convert($v, 2, 16));
    }
    return join('', $arr);
}

/**
 * 系统非常规MD5加密方法
 * @param string $str 要加密的字符串
 * @param string $key
 * @return string
 */
function think_im_md5(string $str, string $key = 'ThinkUCenter'): string
{
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 字符串命名风格转换
 * type 0 将Java风格转换为C的风格 1 将C风格转换为Java的风格
 * @param string $name    字符串
 * @param int    $type    转换类型
 * @param bool   $ucfirst 首字母是否大写（驼峰规则）
 * @return string
 */
function parse_name(string $name, int $type = 0, bool $ucfirst = true): string
{
    if ($type) {
        $name = preg_replace_callback('/_([a-zA-Z])/', function ($match) {
            return strtoupper($match[1]);
        },                            $name);

        return $ucfirst ? ucfirst($name) : lcfirst($name);
    }

    return strtolower(trim(preg_replace("/[A-Z]/", "_\\0", $name), "_"));
}


/**
 * 是否为json字符串
 * @param string $string
 * @return bool
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2019-12-03 11:49
 */
function is_json(string $string): bool
{
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}

/**
 * Http服务成功返回
 * @param mixed  $data
 * @param string $msg
 * @return string
 * @author       TaoGe <liangtao.gz@foxmail.com>
 * @date         2020/9/23 13:47
 */
function success(mixed $data = '', string $msg = ''): string
{
    return Result::y($data, $msg ?: 'success');
}

/**
 * Http服务错误返回
 * @param string $msg  错误信息
 * @param int    $code 错误代码
 * @return string
 * @author       TaoGe <liangtao.gz@foxmail.com>
 * @date         2020/9/23 13:47
 */
function error(string $msg = '', int $code = 0): string
{
    return Result::n($msg ?: 'fail', '', ['code' => $code]);
}

/**
 * 生成GUID
 * @return string
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2021/11/15 11:53
 */
function string_make_guid(): string
{
    // 1、去掉中间的“-”，长度有36变为32
    // 2、字母由“大写”改为“小写”
    if (function_exists('com_create_guid') === true) {
        return strtolower(str_replace('-', '', trim(com_create_guid(), '{}')));
    }

    return sprintf('%04x%04x%04x%04x%04x%04x%04x%04x', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

/**
 * 不区分大小写的in_array实现
 * @param $value
 * @param $array
 * @return bool
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2019-12-20 15:02
 */
function in_array_case($value, $array): bool
{
    return in_array(strtolower($value), array_map('strtolower', $array));
}

/**
 * 调试打印
 * @param mixed $value
 * @author TaoGe <liangtao.gz@foxmail.com>
 * @date   2019-12-20 15:01
 */
function lt(mixed $value)
{
    switch (gettype($value)) {
        case 'resource':
        case 'boolean':
            var_dump($value);
            break;
        case 'integer':
        case 'double':
        case 'string':
            echo($value);
            break;
        case 'array':
            print_r($value);
            break;
        case 'NULL':
            echo 'NULL';
            break;
        default:
            echo 'unknown type';
    }
    echo PHP_EOL;
}
