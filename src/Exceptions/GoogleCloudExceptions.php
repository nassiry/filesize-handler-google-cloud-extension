<?php


namespace Nassiry\FileSizeUtility\Extensions\Exceptions;

use RuntimeException;

class GoogleCloudExceptions extends RuntimeException
{
    // Google Cloud Storage file does not exist
    public static function fileNotFound($filePath): self
    {
        return new self("File does not exist in Google Cloud Storage: {$filePath}");
    }

    // Missing cloud dependencies.
    public static function missingDependency(): self
    {
        return new self("Google Cloud SDK is not installed. Please run 'composer require google/cloud-storage' to install it.");
    }

}