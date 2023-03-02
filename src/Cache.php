<?php
// +----------------------------------------------------------------------
// | think-wechat [微信 SDK for thinkphp6, 基于 w7corp/easywechat]
// +----------------------------------------------------------------------
// | Copyright (c) 2023 https://leapfu.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: Trenton <370887237@qq.com>
// +----------------------------------------------------------------------

namespace trenton93\wechat;

use Psr\SimpleCache\CacheInterface;

/**
 * 缓存类
 * Class Cache
 * @package trenton93\wechat
 */
class Cache implements CacheInterface
{
    protected $cache = null;

    public function __construct()
    {
        $this->cache = app('cache');
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->cache->set($key, $value, $ttl);
    }

    public function delete($key)
    {
        return $this->cache->rm($key);
    }

    public function clear()
    {
        return $this->cache->clear();
    }

    public function getMultiple($keys, $default = null) {}

    public function setMultiple($values, $ttl = null) {}

    public function deleteMultiple($keys) {}

    public function has($key)
    {
        return !is_null($this->cache->get($key));
    }

    public function get($key, $default = null)
    {
        return $this->cache->get($key, $default);
    }

}