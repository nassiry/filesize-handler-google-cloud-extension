<?php
/**
 * Copyright (c) A.S Nassiry
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/nassiry/filesize-handler
 */

namespace Nassiry\FileSizeUtility\Extensions;

use Google\Cloud\Storage\StorageClient;
use Nassiry\FileSizeUtility\Extensions\Exceptions\GoogleCloudExceptions;
use Nassiry\FileSizeUtility\Sources\FileSourceInterface;

class GoogleCloudFiles implements FileSourceInterface
{
    /**
     * The Google Cloud Storage client instance.
     *
     * @var StorageClient
     */
    private StorageClient $client;

    /**
     * The name of the Google Cloud Storage bucket.
     *
     * @var string
     */
    private string $bucketName;

    /**
     * The file path in the Google Cloud Storage bucket.
     *
     * @var string
     */
    private string $filePath;

    /**
     * GoogleCloudFiles constructor.
     *
     * Initializes the Google Cloud Storage client, bucket name, and file path.
     * Throws an exception if the Google Cloud SDK is not installed.
     *
     * @param StorageClient $client The Google Cloud Storage client.
     * @param string $bucketName The name of the Google Cloud Storage bucket.
     * @param string $filePath The path of the file in the Google Cloud Storage bucket.
     *
     * @throws GoogleCloudExceptions If the Google Cloud SDK is not installed.
     */
    public function __construct(StorageClient $client, string $bucketName, string $filePath)
    {
        if (!class_exists(StorageClient::class)) {
            throw GoogleCloudExceptions::missingDependency();
        }

        $this->client = $client;
        $this->bucketName = $bucketName;
        $this->filePath = $filePath;
    }

    /**
     * Gets the size of the file in bytes from the Google Cloud Storage bucket.
     *
     * Uses the Google Cloud Storage client to retrieve the file metadata and the file size.
     *
     * @return int The size of the file in bytes.
     *
     * @throws GoogleCloudExceptions If the file does not exist in the specified bucket.
     */
    public function getSizeInBytes(): int
    {
        $bucket = $this->client->bucket($this->bucketName);
        $object = $bucket->object($this->filePath);

        if (!$object->exists()) {
            throw GoogleCloudExceptions::fileNotFound($this->filePath);
        }

        return $object->info()['size'];
    }
}