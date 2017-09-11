<?php

namespace Irain\ExportExcel;

use Irain\ExportExcel\Writer\ExcelWriter;
use RuntimeException;

class Writer
{

    private $config;

    private $data;

    private $writer;

    private $resource;

    /**
     * Writer constructor.
     */
    public function __construct() {}

    /**
     * set config
     *
     * @param array $config
     * @return Writer $this
     */
    public function setConfig($config)
    {
        if (empty($config)) {
            throw new RuntimeException('Config Can Not Empty.');
        }
        $this->config = $config;
        return $this;
    }

    /**
     * set data
     *
     * @param  array $data
     * @return Writer
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     *  get Writer
     *
     * @return ExcelWriter
     * @throws \Exception
     */
    public function getWriter()
    {
        switch ($this->config['writer']) {
            case 'excel' :
                $this->writer = new ExcelWriter($this->config, $this->data);
                break;
            /* Default writer driver is excel */
            default :
                $this->writer = new ExcelWriter($this->config, $this->data);
        }
        return $this->writer;
    }

    /**
     * set resource
     *
     * @param $resource
     *
     * @return $this
     * @throws \Exception
     */
    public function setResource($resource)
    {
        if (!is_resource($resource)) {
            throw new \InvalidArgumentException('Param must be resource type.');
        }
        $this->resource = $resource;
        return $this;
    }

    /**
     * set resource
     *
     * @return mixed
     * @throws \Exception
     */
    public function resourceDataToArray()
    {
        return $this->getWriter()->setResource($this->resource)->resourceDataToArray();
    }

    /**
     * build and out stream
     *
     * @return mixed
     */
    public function buildAndOutStream()
    {
        return $this->getWriter()->buildAndOutStream($this->buildDownloadFileName());
    }

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
