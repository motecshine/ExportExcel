<h1 align="center">Export Excel</h1>

<p align="center">`Export Excel`  is a simple & faster exports table tool.</p>

<p align="center">
    <a href="https://packagist.org/packages/irain/export-excel"><img src="https://travis-ci.org/motecshine/ExportExcel.svg?branch=master" alt="Latest Unstable Version"></a>
</p>

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
    $config = [
        'cache_driver' => [
            'name'   => 'redis',
            'server' => '127.0.0.1',
            'port'   => '6379',
        ],
        'path'         => DOWNLOAD_PATH,
        'writer'       => 'excel', // if empty default writer is `excel`
    ];

    $excelData = [
        ['green', '1']
    ];

    $fileName = 'export_file_name' . date('Y-m-d H:i:s', time());

    $export   = new Export($config);

    $export->fileName($fileName)
        ->header(['name', 'age'])
        ->data($excelData)
        ->output();
    
# Contributors
[viest](https://github.com/viest)
# License
Apache License 2.0
