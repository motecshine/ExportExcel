<?php
namespace Irain\ExportExcel;

use Irain\ExportExcel\Contract\WriterContract;
use Irain\ExportExcel\Writer\ExcelWriter;

class Writer implements WriterContract
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

    public function getWriter()
    {
        switch ($this->config['writer']) {
            case 'excel':
                $this->writer = new ExcelWriter($this->config, $this->data);
                break;
        }
    }

    public function save($path)
    {
        // TODO: Implement save() method.
    }

    public function buildAndOutStream()
    {
        // TODO: Implement buildAndOutStream() method.
    }

    public function downloadPath()
    {
        return $this->config['path'] ? $this->config['path'] . '/' : './';
    }

    public function write()
    {
    }

    private function buildDownloadFileName($ext = '.xls')
    {
        return $this->downloadPath() . $this->config['name'] . $ext;
    }
}
