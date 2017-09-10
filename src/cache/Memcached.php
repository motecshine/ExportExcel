<?php

namespace Irain\ExportExcel\Cache;

use Irain\ExportExcel\Contract\CacheContract;
use Cache\Bridge\SimpleCache\SimpleCacheBridge;
use Cache\Adapter\MemCache\MemcacheCachePool;

class Memcached implements CacheContract
{

    static public $instance;

    private $config;

    private $simpleCache;

    private function __construct($config)
    {
        $client = new \Memcache();
        $client->connect($this->config['server'], $this->config['port']);
        $pool              = new MemcacheCachePool($client);
        $this->simpleCache = new SimpleCacheBridge($pool);
    }

    static public function getInstance($config)
    {
        if (!self::$instance) {
            self::$instance = new self($config);
        }

        return self::$instance;
    }

    public function getCache()
    {
        return $this->simpleCache;
    }
}