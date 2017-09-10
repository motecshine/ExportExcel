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
        if (empty($config['writer'])) {
            new \Exception('Config Can Not Empty.');
        }
        if (empty($data)) {
            new \Exception('Sheet Data Can Not Empty.');
        }
        $this->config = $config;
        $this->data = $data;
    }

    public function buildOutStream()
    {
        switch ($this->config['writer']) {
            case 'excel':
                $this->writer = new ExcelWriter($this->config, $this->data);
                break;
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
