<?php

namespace Wigo\StudyNotes\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [__DIR__ . "/.."],
            true
        );

        $consoleOutput = new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $logMiddleware = new Middleware($consoleLogger);
        $config->setMiddlewares([$logMiddleware]);

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'host' => "localhost",
            'port' => '3306',
            'dbname' => 'study_notes',
            'user' => 'root',
            'password' => '13112602'
        ], $config);

        $entityManager = new EntityManager($connection, $config);

        return $entityManager;
    }
}
