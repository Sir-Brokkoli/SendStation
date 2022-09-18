<?php namespace Sendstation\Database;

require_once 'IEntity.php';
require_once 'IRepository.php';
require_once 'MysqlDatabaseConnection.php';

abstract class SqlRepository implements IRepository {
    protected $tableName;
    protected ISqlDatabaseConnection $connection;

    protected function __construct(string $tableName) {
        $this->tableName = $tableName;
        $this->connection = MysqlDatabaseConnection::getInstance();
    }

    protected abstract function rawDataToEntities($data) :array;

    public function findAll() :array {
        $sql = "SELECT * FROM {$this->tableName}";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData)) {
            // TODO: Exception management
        }
        return $this->rawDataToEntities($rawData);
    }

    public function findById($id) :?IEntity {
        $sql = "SELECT * FROM {$this->tableName} WHERE id=?";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData, $id)) {
            // TODO: Exception management
        }

        if ($rawData->num_rows == 0) {
            return null;
        }
        return $this->rawDataToEntities($rawData)[0];
    }

    public function save(IEntity $entry) :bool {
        if ($entry->getId() === null) {
            return $this->insert($entry);
        }
        return $this->update($entry);
    }

    public function delete(IEntity $entity) :bool {
        $sql = "DELETE FROM {$this->tableName} WHERE id=?";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData, $entity->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }
}