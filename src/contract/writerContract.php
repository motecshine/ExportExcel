<?php
namespace Irain\ExportExcel\Contract;

interface WriterContract {
    public function buildAndOutStream($path);
    public function save($path);
    public function buildTable();
    public function buildTableHeader();
}
