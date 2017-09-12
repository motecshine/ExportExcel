<?php

namespace Irain\ExportExcel\Writer;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Irain\ExportExcel\Contract\WriterContract;
use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

class ExcelWriter implements WriterContract
{

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
        'Z',
    ];

    public function __construct($config, $data)
    {
        $this->config       = $config;
        $this->data         = $data;
        $this->spreadsSheet = new Spreadsheet;
    }

    public function buildAndOutStream($path)
    {
        return $this->buildTableHeader()
                    ->buildTable()
                    ->save($path);
    }

    public function resourceToArray()
    {
        if (!empty($this->data)) {
            try {
                $reader = IOFactory::load($this->data);
                $worksheet = $reader->getActiveSheet()->toArray();
                $worksheet = array_shift($worksheet);
            } catch (Exception $e) {
                throw new Exception('File not found.');
            }
        }
        return $worksheet;
    }

    public function buildTableHeader()
    {
        if (!empty($this->config['table_header'])) {
            $this->createSheetData($this->config['table_header'], 1);
        }
        return $this;
    }

    public function buildTable()
    {
        $sheetNumber = 2;
        foreach ($this->data as $item) {
            $this->createSheetData($item, $sheetNumber);
            $sheetNumber++;
        }
        return $this;
    }

    private function createSheetData($data, $sheetNumber)
    {
        $number = 0;
        foreach ($data as $key => $value) {
            $this->spreadsSheet
                ->getActiveSheet()
                ->setCellValue($this->numberToString($number, $sheetNumber), $value);
            $number++;
        }
        return $this;
    }

    private function numberToString($number, $sheetNumber)
    {
        return $this->char[$number] . $sheetNumber;
    }

    public function save($path)
    {
        try {
            $writer = new Xlsx($this->spreadsSheet);
            $writer->save($path);
            return $this->getPath($path);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function getPath($path)
    {
        return $path;
    }
}

