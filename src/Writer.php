<?php
namespace Irain\ExportExcel;

use Irain\ExportExcel\Writer\ExcelWriter;

class Writer
{
    private $config;
    private $data;
    private $writer;
    public function __construct($config, array $data)
    {
        $this->config = $config;
        $this->data = $data;
    }

    public function buildAndOutStream()
    {
        switch ($this->config['writer']) {
            case 'excel':
                $this->writer = new ExcelWriter($this->config, $this->data);
                break;
            /* Default writer driver is excel */
            default :
                $this->writer = new ExcelWriter($this->config, $this->data);
        }

        return $this->writer->buildAndOutStream($this->buildDownloadFileName());
    }

    public function path()
    {
        return $this->config['path'] ? $this->config['path'] . '/' : './';
    }

    private function buildDownloadFileName($ext = '.xls')
    {
        return $this->path() . $this->config['name'] . $ext;
    }
}
