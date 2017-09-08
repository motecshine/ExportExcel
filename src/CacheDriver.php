<?php
namespace Irain\ExportExcel;

use Irain\ExportExcel\Cache\Apc;
use Irain\ExportExcel\Cache\Memcached;
use Irain\ExportExcel\Cache\Redis;

class CacheDriver {
    public function setCacheDriver($config)
    {
        switch ($config['name']) {
            case 'apc':
                $driver = Apc::getInstance();
                break;
            case 'redis':
                $driver = Redis::getInstance($config);
                break;
            case 'memcached':
                $driver = Memcached::getInstance($config);
                break;
            default:
                $driver = '';
        }
        return $driver;
    }
}