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
    /** @var string[] */
    private static array $tables = [];

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
    public function purgeTables(): void
    {
        $this->loadTables();
        $this->executeQuery('SET FOREIGN_KEY_CHECKS=0');
        array_walk(self::$tables, fn(string $table) => $this->executeQuery('TRUNCATE TABLE ' . $table));
        $this->executeQuery('SET FOREIGN_KEY_CHECKS=1');
    }

    private function executeQuery(string $sql): void
    {
        $this->entityManager->getConnection()->prepare($sql)->executeQuery();
    }

    private function createTempConnection(): Connection
    {
        $params = $this->entityManager->getConnection()->getParams();
        unset($params['dbname'], $params['url']);
        return DriverManager::getConnection($params, $this->entityManager->getConnection()->getConfiguration());
    }

    private function loadTables(): void
    {
        if (self::$tables) {
            return;
        }

        self::$tables = $this->entityManager->getConnection()->createSchemaManager()->listTableNames();
    }
}
