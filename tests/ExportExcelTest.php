<?php
namespace Irain\ExportExcel\Tests;

use Mockery;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Irain\ExportExcel\Export;
use RuntimeException;

class ExportTest extends PHPUnitTestCase
{
    public function testExportWithoutDefaultSetting()
    {
        new Export([]);
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Config Can Not Empty.');
    }
}