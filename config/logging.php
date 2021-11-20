<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single'],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => env('LOG_LEVEL', 'critical'),
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => env('LOG_LEVEL', 'debug'),
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'transaction' => [
            'driver' => 'daily',
            'path' => storage_path('logs/transaction/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'released_transaction' => [
            'driver' => 'daily',
            'path' => storage_path('logs/released_transaction/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'SEND_MONEY' => [
            'driver' => 'daily',
            'path' => storage_path('logs/send_money/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'WITHDRAW' => [
            'driver' => 'daily',
            'path' => storage_path('logs/withdrawal/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'ADD_MONEY' => [
            'driver' => 'daily',
            'path' => storage_path('logs/add_money/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'WALLET' => [
            'driver' => 'daily',
            'path' => storage_path('logs/wallet/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'PENDING_WALLET' => [
            'driver' => 'daily',
            'path' => storage_path('logs/pending_wallet/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'wallet_error' => [
            'driver' => 'daily',
            'path' => storage_path('logs/wallet_error/transaction.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'getway_error' => [
            'driver' => 'daily',
            'path' => storage_path('logs/gateway_error/gateway_errors.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        'getway_log' => [
            'driver' => 'daily',
            'path' => storage_path('logs/getway/getway.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],
    ],

];
