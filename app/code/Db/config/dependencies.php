<?php

use Zend\ServiceManager\ServiceManager;

return [
    'dependencies' => [
        'factories' => [
            /**
             * Factory for PDO connection
             */
            \MadeiraMadeira\Db\Api\ConnectionInterface::class => function (ServiceManager $sm) {
                $dbConfig = $sm->get('config')['db'];
                $pdo = new \PDO($dbConfig['dns'], $dbConfig['username'], $dbConfig['password']);
                $pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, true);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $connection = new \MadeiraMadeira\Db\Connection($pdo);

                return $connection;
            }
        ]
    ]
];
