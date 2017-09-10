<?php

namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Export
{

    private $config;

    private $data;

    private $cacheDriver;

    private $writer;

    /**
     * Export constructor.
     *
     * @param array $config
     *
     * @throws \Exception
     */
    public function __construct($config)
    {
        if (empty($config)) {
            throw new \Exception('Config Can Not Empty.');
        }

        $this->config       = $config;
        $this->spreadsSheet = new Spreadsheet;
        $this->writer       = new Writer();

        if(!empty($this->config['cache_driver'])) {
            $this->cacheDriver  = (new CacheDriver())->setCacheDriver($this->config['cache_driver']);
        }

        if (!empty($this->cacheDriver)) {
            Settings::setCache($this->cacheDriver);
        }
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
            throw new \Exception('Table header Can Not Empty.');
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
            throw new \Exception('File name Can Not Empty.');
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
            throw new \Exception('Sheet Data Can Not Empty.');
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

