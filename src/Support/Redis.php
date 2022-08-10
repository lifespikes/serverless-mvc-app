<?php

namespace LifeSpikes\Support;

use Predis\Client;
use Predis\Session\Handler;

class Redis
{
    /**
     * Using Redis as our session handler is a necessary part
     * of writing a serverless application. PHP stores session data
     * locally, usually in a file; it's also information that must
     * be persisted across requests.
     *
     * Since our serverless environment has no file system, and on
     * load balancing setups it's possible to hit two different servers
     * between requests, we need to let PHP know that we want to
     * customize the way it stores session data.
     *
     * The Predis library is a great library for integrating Redis, and
     * provides built-in helpers for session handling.
     */
    public static function handleSessions(): void
    {
        session_set_save_handler(
            new Handler(
                new Client([
                    'scheme' => 'tcp',
                    'host' => 'localhost',
                    'port' => 6379,
                ])
            )
        );

        session_start();
    }
}
