<?php

namespace LifeSpikes\Support;

use Aws\S3\S3Client;

class S3
{
    public static function upload(string $filename, string $contents): void
    {
        $aws = config('aws');

        $client = new S3Client([
            'version' => 'latest',
            'region' => $aws['region'],

            'credentials' => [
                'key' => $aws['key'],
                'secret' => $aws['secret']
            ]
        ]);

        $client->putObject([
            'Bucket' => $aws['bucket'],
            'Key' => $filename,
            'Body' => $contents,
        ]);
    }
}
