<?php
namespace Irain\ExportExcel;

use Irain\ExportExcel\Cache\Apc;
use Irain\ExportExcel\Cache\Memcached;
use Irain\ExportExcel\Cache\Redis;

class CacheDriver {

    /**
     * set cache driver
     *
     * @param $config
     *
     * @return \Cache\Bridge\SimpleCache\SimpleCacheBridge|string
     */
    public function setCacheDriver($config)
    {
        switch ($config['name']) {
            case 'apc':
                $driver = Apc::getInstance()->getCache();
                break;
            case 'redis':
                $driver = Redis::getInstance($config)->getCache();
                break;
            case 'memcached':
                $driver = Memcached::getInstance($config)->getCache();
                break;
            default:
                $driver = '';
        }
        return $driver;
    }
}