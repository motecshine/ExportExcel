<?php

namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use RuntimeException;

class Import
{
    private $config;

    private $resource;

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
     * set resource file data to array data
     *
     * @return $this
     * @throws \Exception
     *
     * @return mixed
     */
    public function resourceDataToArray()
    {
        return $this->writer
            ->setConfig($this->config)
            ->setResource($this->resource)
            ->resourceDataToArray();
    }

}