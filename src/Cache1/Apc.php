<?php

namespace Irain\ExportExcel\Cache;

use Irain\ExportExcel\Contract\CacheContract;
use Cache\Bridge\SimpleCache\SimpleCacheBridge;
use Cache\Adapter\Apcu\ApcuCachePool;

class Apc implements CacheContract
{

    static public $instance;

    private $simpleCache;

    private function __construct()
    {
        $pool              = new ApcuCachePool();
        $this->simpleCache = new SimpleCacheBridge($pool);
    }

    static public function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getCache()
    {
        return $this->simpleCache;
    }
}