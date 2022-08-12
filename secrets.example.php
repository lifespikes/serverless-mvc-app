<?php

return [
    /* AWS Credentials */
    'AWS_ACCESS_KEY' => '',
    'AWS_SECRET_ACCESS_KEY' => '',
    'AWS_REGION' => 'us-east-1',

    /* Database - This would be handled by RDS */
    'DB_HOST' => '',
    'DB_USER' => '',
    'DB_PASSWORD' => '',
    'DB_NAME' => 'app',

    /* File Storage and Delivery */
    'AWS_BUCKET' => 'my-serverless-app-bucket',
    'CLOUDFRONT_URI' => 'https://your-cloudfront-uri.com',

    /* Redis - Handled by ElastiCache */
    /* Using this we replace PHP's native session handler */
    /* @see \LifeSpikes\Support\Redis::handleSessions() */
    'REDIS_HOST' => 'localhost',
    'REDIS_PORT' => 6379,
    'REDIS_PASSWORD' => '',
];
