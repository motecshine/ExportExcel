<?php

namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use RuntimeException;

class Export
{

    private $config;

    private $data;

    private $cacheDriver;

    private $spreadsSheet;

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
        $this->spreadsSheet = new Spreadsheet;
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
     * set table header
     *
     * @param array $header
     *
     * @return $this
     * @throws \Exception
     */
    public function header($header)
    {
        if (empty($header)) {
            throw new RuntimeException('Table header Can Not Empty.');
        }

        $this->config['table_header'] = $header;

        return $this;
    }

    /**
     * set file name
     *
     * @param string $name
     *
     * @return $this
     * @throws \Exception
     */
    public function fileName($name)
    {
        if (empty($name)) {
            throw new RuntimeException('File name Can Not Empty.');
        }

        $this->config['name'] = $name;

        return $this;
    }


    /**
     * set data
     *
     * @param $data
     *
     * @return $this
     * @throws \Exception
     */
    public function data($data)
    {
        if (empty($data)) {
            throw new RuntimeException('Sheet Data Can Not Empty.');
        }

        $this->data = $data;

        return $this;
    }

    /**
     * build and out stream
     *
     * @return mixed
     */
    public function output()
    {
        $this->writer->setConfig($this->config);
        $this->writer->setData($this->data);
        return $this->writer->buildAndOutStream();
    }

}

