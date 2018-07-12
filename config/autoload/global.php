<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Doctrine\DBAL\Driver\PDOPgSql\Driver as PDOPgSqlDriver;

return [
    'doctrine' => [
        'connection' => [
            'orm_default' => [
                'driverClass' => PDOPgSqlDriver::class,
                'params' => [
                    'host'     => 'postgres',
                    'port'     => '5432',
                    'user'     => 'postgres',
                    'password' => 'motorola',
                    'dbname'   => 'argosoft',
                ]
            ],
        ],
    ],
];
