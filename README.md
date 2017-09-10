# Export Excel
    `Export Excel`  is a simple & faster exports table tool.
# How To Install
    composer require irain/export-excel
# Dependency

    "cache/simple-cache-bridge": "^1.0",
    "cache/redis-adapter": "^1.0",
    "cache/apcu-adapter": "^1.0",
    "cache/memcache-adapter": "^1.0"
    "phpoffice/phpspreadsheet" : "~1.0.0beta"
    
# Example 
    
    use Irain\ExportExcel\Export;
    $conf = [
        'cache_driver' => [
            'name' => 'redis',
            'server' => '127.0.0.1',
            'port' => '6379'
        ],
        'table_header' => [
           'name', 'age'
        ],
        'name' => 'export_file_name' . date('Y-m-d H:i:s', time()),
        'path' => '/tmp',
        'writer' => 'excel'  // if empty default writer is `excel`
    ];
    $excelData = [
        ['green', '1']
    ];
    (new Export($conf, $excelData))->buildAndOutStream();
    
# Special Thanks
# License
MIT
