<?php
namespace Irain\ExportExcel\Contract;

interface WriterContract {
    public function buildAndOutStream();
    public function save($path);
}
