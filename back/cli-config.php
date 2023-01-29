<?php

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Wigo\StudyNotes\Helper\EntityManagerCreator;

require 'vendor/autoload.php';



$config = new PhpFile('migrations.php');

$entityManager = EntityManagerCreator::createEntityManager();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));
