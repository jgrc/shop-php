<?php

declare(strict_types=1);

namespace Jgrc\Shop\Acceptance\Context\Infrastructure;

use Behat\Behat\Context\Context;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

class DataBaseContext implements Context
{
    private EntityManagerInterface $entityManager;
    private string $databaseName;
    private static bool $created = false;

    public function __construct(EntityManagerInterface $entityManager, string $databaseName)
    {
        $this->entityManager = $entityManager;
        $this->databaseName = $databaseName;
    }

    /** @BeforeScenario */
    public function prepareDatabase(): void
    {
        if (self::$created) {
            return;
        }
        $tmpConnection = $this->createTempConnection();
        if (self::$created = in_array($this->databaseName, $tmpConnection->createSchemaManager()->listDatabases())) {
            return;
        }

        $tmpConnection->createSchemaManager()->createDatabase($this->databaseName);
        $tool = new SchemaTool($this->entityManager);
        $tool->createSchema($this->entityManager->getMetadataFactory()->getAllMetadata());
    }

    /** @BeforeScenario */
    public function beginTransaction(): void
    {
        $this->entityManager->beginTransaction();
    }

    /** @AfterScenario  */
    public function rollback(): void
    {
        $this->entityManager->rollback();
    }

    private function createTempConnection(): Connection
    {
        $params = $this->entityManager->getConnection()->getParams();
        unset($params['dbname'], $params['url']);
        return DriverManager::getConnection($params, $this->entityManager->getConnection()->getConfiguration());
    }
}
