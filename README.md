<div align="center">

# PHP FileSizeHandler - Google Cloud Extension

![Packagist Downloads](https://img.shields.io/packagist/dt/nassiry/filesize-handler-googlecloud-extension)
![Packagist Version](https://img.shields.io/packagist/v/nassiry/filesize-handler-googlecloud-extension)
![PHP](https://img.shields.io/badge/PHP-%5E8.0-blue)
![License](https://img.shields.io/github/license/nassiry/filesize-handler-google-cloud-extension)

</div>


The **Google Cloud Extension** for [FileSizeHandler](https://github.com/nassiry/filesize-handler) enables support for retrieving file sizes from Google Cloud Storage.

## Installation

Install the extension via Composer:

```bash
composer require nassiry/filesize-handler-googlecloud-extension
```
## Usage
```php
use Nassiry\FileSizeUtility\FileSizeHandler;
use Nassiry\FileSizeUtility\Extensions\GoogleCloudFiles;
use Google\Cloud\Storage\StorageClient;

$gcsClient = new StorageClient([
    'keyFilePath' => '/path/to/keyfile.json',
]);

$handler = FileSizeHandler::create()
    ->from(new GoogleCloudFiles(
        $gcsClient,         // Google Cloud Storage Client
        'my-bucket',        // Google Cloud bucket name
        'path/to/file.txt'  // File path in the bucket
    ))
    ->formattedSize();

echo $handler; // Output: "15.67 MiB"
```

### Features
- Fetch file sizes from Google Cloud Storage.
- Seamlessly integrates with the main [FileSizeHandler](https://github.com/nassiry/filesize-handler) library.

### Contributing
Feel free to submit issues or pull requests to improve the package. Contributions are welcome!

### License
This package is open-source software licensed under the [MIT license](LICENSE).