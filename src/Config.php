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
// | Date: 2021/11/8 11:30
// +----------------------------------------------------------------------

namespace V2dmIM\Core;

use Exception;

/**
 * Class Config
 * @property array database
 * @property array redis
 * @package app
 */
class Config
{
    /**
     * 声明一个静态属性来存放实例
     * @var self |null
     */
    private static ?self $instance = null;

    /**
     * 声明一个数组 用于存放读取来的数据库类信息
     * @var array|mixed
     */
    private array $data;

    /**
     * 首先将类的构造函数和克隆方法写死
     * @param string $path
     */
    private function __construct(string $path)
    {
        //将配置数组赋给成员变量
        $this->data = include($path);
    }

    /**
     * 写一个静态方法来声明并判断实例，存在则返回已存在的实例，不存在则实例化新的，保证实例对象的唯一性
     * @param string $path
     * @return static
     * @throws \Exception
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:27
     */
    public static function instance(string $path = ''): static
    {
        if (is_null(self::$instance)) {
            if (empty($path)) {
                throw new Exception("Config the first instantiation must pass parameters");
            }
            if (!file_exists($path)) {
                throw new Exception("config file does not exist. " . $path);
            }
            self::$instance = new self($path);
        }
        return self::$instance;
    }

    /**
     * getData
     * @return array
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:27
     * @noinspection PhpUnused
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * setData
     * @param array $data
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:26
     * @noinspection PhpUnused
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * 使用魔术方法读取data中的信息
     * @param $key
     * @return mixed|null
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:27
     */
    public function __get($key)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    /**
     * 使用魔术方法 在运行期动态增加或改变配置选项
     * @param $key
     * @param $value
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:27
     */
    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * 私有防止克隆
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:27
     */
    private function __clone()
    {
    }
}
