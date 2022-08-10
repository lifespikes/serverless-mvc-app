<?php

const VIEW_DIR = __DIR__.'/views';

function config($key): array
{
    return [
        'db' => [
            'host'      =>  getenv('DB_HOST') ?: 'localhost',
            'database'  =>  getenv('DB_NAME') ?: '',
            'user'      =>  getenv('DB_USER') ?: 'root',
            'password'  =>  getenv('DB_PASSWORD') ?: ''
        ],

        'aws' => [
            'key'       =>  getenv('AWS_ACCESS_KEY') ?: '',
            'secret'    =>  getenv('AWS_SECRET_ACCESS_KEY') ?: '',
            'region'    =>  getenv('AWS_REGION') ?: 'us-east-1',

            'bucket'    =>  getenv('AWS_BUCKET') ?: 'lambda-example-app'
        ]
    ][$key];
}

function view(string $view, array $data = []): string
{
    extract($data);

    ob_start();
    include VIEW_DIR . '/' . $view . '.php';
    return ob_get_clean();
}

function layout(string $layout, string $view = null, array $data = []): string
{
    return view("layouts/$layout", [
        'body' => view($view, $data)
    ]);
}
