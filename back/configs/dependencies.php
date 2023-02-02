<?php

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Wigo\StudyNotes\Infra\EntityManagerCreator;

require_once __DIR__ . "/../vendor/autoload.php";

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    EntityManagerInterface::class => function () {
        return EntityManagerCreator::createEntityManager();
    }
]);

return $containerBuilder->build();
