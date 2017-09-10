<?php
namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Settings;

class Export {
    private $config;
    private $data;
    private $cacheDriver;
    private $writer;

    public function __construct($config)
    {
        if (empty($config)) {
            throw new \Exception('Config Can Not Empty.');
        }
        $this->config = $config;

    }

    public function output()
    {
        if (! empty($this->config['cache_driver'])) {
            $this->configCache();
        }
        $this->writer = new Writer($this->config, $this->data);
        return $this->writer->buildAndOutStream();
    }

    public function data($data)
    {
        if (empty($data)) {
            throw new \Exception('Sheet Data Can Not Empty.');
        }
        $this->data = $data;
        return $this;
    }

    public function configCache()
    {
        $this->cacheDriver = (new CacheDriver)->setCacheDriver($this->config['cache_driver']);
        if (! empty($this->cacheDriver)) {
            Settings::setCache($this->cacheDriver);
        }
    }

}

