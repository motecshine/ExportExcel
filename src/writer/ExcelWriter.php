<?php
namespace Irain\ExportExcel\Writer;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Irain\ExportExcel\Contract\WriterContract;

class ExcelWriter implements  WriterContract{
    private $config;
    private $data;
    private $spreadsSheet;
    private $char = [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z'
    ];

    public function __construct($config, array $data)
    {
        $this->config = $config;
        $this->data = $data;
        $this->spreadsSheet = new Spreadsheet;
    }

    public function downloadPath()
    {
        return $this->config['path'] ? $this->config['path'] . '/' : './';
    }

    public function buildAndOutStream()
    {
        $this->createTableHeader()->createTable()->save();
    }

    private function createTableHeader()
    {
        $this->createSheetData($this->config['table_header'], 1);
        return $this;
    }

    private function createTable()
    {
        $sheetNumber = 2;
        foreach ($this->data as $item) {
            $this->createSheetData($item, $sheetNumber);
            $sheetNumber++ ;
        }
        return $this;
    }

    private function createSheetData($data, $sheetNumber)
    {
        $number = 0;
        foreach ($data as $key => $value) {
            $this->spreadsSheet->getActiveSheet()->setCellValue($this->numberToString($number, $sheetNumber),
                $value);
            $number++;
        }
        return $this;
    }

    private function numberToString($number, $sheetNumber)
    {
        return $this->char[$number] . $sheetNumber;
    }

    public function save($path) {
        $writer = new Xlsx($this->spreadsSheet);
        $writer->save($path);
    }

}

