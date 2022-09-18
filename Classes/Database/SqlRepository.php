<?php namespace Sendstation\Database;

require_once 'IEntity.php';
require_once 'IRepository.php';
require_once 'MysqlDatabaseConnection.php';

/**
 * Abstract crud repository for a SQL based backend. Imlements findAll, 
 * findById, save and delete.
 */
abstract class SqlRepository implements IRepository {
    protected $tableName;
    protected ISqlDatabaseConnection $connection;

    protected function __construct(string $tableName) {
        $this->tableName = $tableName;
        $this->connection = MysqlDatabaseConnection::getInstance();
    }

    /**
     * Converts the raw data retrieved from the database to an array of
     * entities.
     */
    protected abstract function rawDataToEntities($data) :array;

    /**
     * Fetches all entities from the database.
     */
    public function findAll() :array {
        $sql = "SELECT * FROM {$this->tableName}";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData)) {
            // TODO: Exception management
        }
        return $this->rawDataToEntities($rawData);
    }

    /**
     * Fetches the entity with the given id from the database or returns 
     * null if no such entity was found.
     */
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

    /**
     * Inserts of updates the entity in the persistance context depending
     * on whether its id is set.
     */
    public function save(IEntity $entry) :bool {
        if ($entry->getId() === null) {
            return $this->insert($entry);
        }
        return $this->update($entry);
    }

    /**
     * Deletes the entity with the given id from the persistance context
     */
    public function delete(IEntity $entity) :bool {
        $sql = "DELETE FROM {$this->tableName} WHERE id=?";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData, $entity->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }
}