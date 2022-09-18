<?php
namespace Sendstation\Database;

/**
 * Interface for a database connection to a SQL-based system.
 */
interface ISqlDatabaseConnection {
    public function executeSqlQuery(string $sql, &$outputData, ... $params) :bool;
}
?>