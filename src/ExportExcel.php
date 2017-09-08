<?php
namespace Irain\ExportExcel;

use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportExcel {
    private $config;
    private $cacheDriver;
    public function __construct($config)
    {
        $this->config = $config;
        $this->cacheDriver = (new CacheDriver())->setCacheDriver($this->config['cache_driver']);

        if (! empty($this->cacheDriver)) {
            Settings::setCache($this->cacheDriver);
        }
    }

    public function write()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
        dd($writer);

    }
}

