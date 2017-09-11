<?php
namespace Irain\ExportExcel\Tests;

use Mockery;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Irain\ExportExcel\Export;
use RuntimeException;

class ExportTest extends PHPUnitTestCase
{
    public function testExportWithoutConfig()
    {
        $export = new Export([]);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Config Can Not Empty.');
        $export->setConfig([]);
    }

    public function testExportWithoutHeader()
    {
        $export = new Export([]);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Table header Can Not Empty.');
        $export->header([]);
    }

    public function testExportWithoutFileName()
    {
        $export = new Export([]);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('File name Can Not Empty.');
        $export->fileName([]);
    }
}