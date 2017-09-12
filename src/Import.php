<?php

namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Settings;
use RuntimeException;

class Import
{
    private $config;

    private $resource;

    private $cacheDriver;
    
    private $writer;
    
    /**
     * Export constructor.
     *
     * @param array $config
     *
     */
        public function __construct($config)
        {
            if (!empty($config)) {
                $this->setConfig($config);
            }
            $this->writer       = new Writer;
 
            if (!empty($this->config['cache_driver'])) {
                $this->cacheDriver  = (new CacheDriver())->setCacheDriver($this->config['cache_driver']);
            }
 
            if (!empty($this->cacheDriver)) {
                Settings::setCache(/** @scrutinizer ignore-type */$this->cacheDriver);
            }
        }

    /**
     * set config
     *
     * @param array $config
     */

    public function setConfig($config)
    {
        if (empty($config)) {
            throw new RuntimeException('Config Can Not Empty.');
        }
        $this->config = $config;
    }

    /**
     * Set table header
     *
     * @param array $header
     *
     * @return $this
     * @throws \Exception
     */
    public function header($header)
    {
        if (empty($header)) {
            throw new RuntimeException('Table header can not empty.');
        }

        $this->config['table_header'] = $header;

        return $this;
    }

    /**
     * Set file name
     *
     * @param string $resource resource name
     *
     * @return $this
     * @throws \Exception
     */
    public function setResource($resource)
    {
        if (empty($resource)) {
            throw new RuntimeException('Resouce file name can not empty.');
        }
        $this->resource = $resource;
        return $this;
    }
    

    /**
     * Set file name
     *
     * @return mixed resouce to array
     */
    public function resourceToArray()
    {
            return  $this->writer
                ->setConfig($this->config)
                ->setResource($this->resource)
                ->resourceToArray();
    }
}