<?php
namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Irain\ExportExcel\Contract\WriterContract;


class ExportExcel {
    private $config;
    private $data;
    private $cacheDriver;

    public function __construct($config, array $data)
    {
        if (empty($config)) {
            new \Exception('Config Can Not Empty.');
        }
        if (empty($data)) {
            new \Exception('Sheet Data Can Not Empty.');
        }

        $this->config = $config;
        $this->data = $data;

        $this->spreadsSheet = new Spreadsheet;
        $this->cacheDriver = (new CacheDriver())->setCacheDriver($this->config['cache_driver']);
        if (! empty($this->cacheDriver)) {
            Settings::setCache($this->cacheDriver);
        }

    }

}

