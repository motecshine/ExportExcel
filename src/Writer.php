<?php

namespace Irain\ExportExcel;

use Irain\ExportExcel\Writer\ExcelWriter;
use RuntimeException;

class Writer
{

    private $config;

    private $data;

    private $writerDriver;

    /**
     * Writer constructor.
     */

    public function __construct() {}

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
     * set data
     *
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getWriterDriver()
    {
        switch ($this->config['writer']) {
            case 'excel' :
                $this->writerDriver = new ExcelWriter($this->config, $this->data);
                break;
            /* Default writer driver is excel */
            default :
                $this->writerDriver = new ExcelWriter($this->config, $this->data);
        }
        return $this->writerDriver;
    }

    /**
     * build and out stream
     *
     * @return mixed
     */
    public function buildAndOutStream()
    {
        return $this->getWriterDriver()->buildAndOutStream($this->buildDownloadFileName());
    }

    /**
     * origin path
     *
     * @return mixed
     */

    public function path()
    {
        return $this->config['path'] ? $this->config['path'] . '/' : './';
    }

    /**
     * build download file name
     *
     * @param string $ext
     *
     * @return string
     */

    private function buildDownloadFileName($ext = '.xls')
    {
        return $this->path() . $this->config['name'] . $ext;
    }
}
