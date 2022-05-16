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


use RuntimeException;

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
     * @var array
     */
    private array $data = [];

    /**
     * 首先将类的构造函数和克隆方法写死
     */
    private function __construct()
    {
    }

    /**
     * 写一个静态方法来声明并判断实例，存在则返回已存在的实例，不存在则实例化新的，保证实例对象的唯一性
     * @return static
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2021/11/8 11:27
     */
    public static function instance(): static
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 载入配置
     * @param string $path
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/5/13 15:03
     */
    public function load(string $path = ''): void
    {
        if (empty($path)) {
            throw new RuntimeException("Config the first instantiation must pass parameters");
        }
        if (!file_exists($path)) {
            throw new RuntimeException("config file does not exist. " . $path);
        }
        $this->data = include($path);
    }

    /**
     * 追加配置
     * @param array $values
     * @author       TaoGe <liangtao.gz@foxmail.com>
     * @date         2021/11/8 11:26
     * @noinspection PhpUnused
     */
    public function append(array $values): void
    {
        $this->data = array_merge($this->data, $values);
    }

    /**
     * 获取全部配置
     * @return array
     * @author       TaoGe <liangtao.gz@foxmail.com>
     * @date         2021/11/8 11:27
     * @noinspection PhpUnused
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * 获取配置
     * @param string $key
     * @return mixed
     * @author       TaoGe <liangtao.gz@foxmail.com>
     * @date         2021/11/8 11:27
     */
    public static function get(string $key): mixed
    {
        return Config::instance()->$key;
    }

    /**
     * 设置配置
     * @param string $key
     * @param        $value
     * @author TaoGe <liangtao.gz@foxmail.com>
     * @date   2022/5/13 15:08
     */
    public static function set(string $key, $value): void
    {
        Config::instance()->$key = $value;
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
    public function __set($key, $value): void
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
