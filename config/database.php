<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION_PG', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'pgsql' => [
            'driver' => env('DB_CONNECTION_PG'),//'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_PG', '127.0.0.1'),
            'port' => env('DB_PORT_PG', '5432'),
            'database' => env('DB_DATABASE_PG', 'forge'),
            'username' => env('DB_USERNAME_PG', 'forge'),
            'password' => env('DB_PASSWORD_PG', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'mysql' => [
            'driver' => env('DB_CONNECTION_MY'),//'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_MY', '127.0.0.1'),
            'port' => env('DB_PORT_MY', '3306'),
            'database' => env('DB_DATABASE_MY', 'forge'),
            'username' => env('DB_USERNAME_MY', 'forge'),
            'password' => env('DB_PASSWORD_MY', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => env('DB_TABLES_PREFIX', ''),
            'prefix_indexes' => true,
            'strict' => false,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],


		/*'mongodb' => [
			'driver'   => env('DB_CONNECTION_MG'),//'mongodb',
			'host'     => env('DB_HOST_MG', 'localhost'),
			'port'     => env('DB_PORT_MG', 27017),
			'database' => env('DB_DATABASE_MG'),
			'username' => env('DB_USERNAME_MG'),
			'password' => env('DB_PASSWORD_MG'),
			'options'  => [
				'database' => 'admin' // sets the authentication database required by mongo 3
			]
		],*/



    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];