## About BulkDownloadTool

This tool would help anyone who would like to download a variety of files in bulk via a single zip file.

Anyone who has there files stored on AWS S3 would be able to download through this tool (Based on Laravel filesystem).

###Javascript & CSS Scaffolding

The Bootstrap and Vue scaffolding provided by Laravel is located in the laravel/ui Composer package, which may be installed using Composer:

`composer require laravel/ui:^2.4`


###PHP artisan commands

`php artisan ui vue --auth`

`php artisan queue:table`

`php artisan migrate`

`php artisan make:job DownloadUserFiles`

`php artisan make:controller DownloadController`

`php artisan queue:work`

###Testing
---

###Route
```
Route::get('/download', 'DownloadController@dispatchJob')->name('download');
```

###Testing
-

####Register user account
http://127.0.0.1:8000/register

####Download URL
http://127.0.0.1:8000/download

####Dummy files
```
    [
      ‘/file/category_a/1.pdf’,
      ‘/file/category_a/2.pdf’,
      ‘/file/category_b/3.pdf’,
    ]
```

####Timeout Interval
```
sleep(10);
```

####Storage
local path
```
BulkDownloadTool/storage/app/1-2021-05-22-03-12-57
```

public path

```
BulkDownloadTool/public/1-2021-05-22-03-12-57.zip
```
# BulkDownloadTool
