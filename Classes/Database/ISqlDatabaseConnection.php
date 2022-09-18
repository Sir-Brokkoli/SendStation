<?php
namespace Sendstation\Database;

interface ISqlDatabaseConnection {
    public function executeSqlQuery(string $sql, &$outputData, ... $params) :bool;
}
?>