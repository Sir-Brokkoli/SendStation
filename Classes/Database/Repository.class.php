<?php namespace Sendstation\Database;

abstract class Repository {

    private $tableName;
    private $conn;

    public function __construct($conn, $tableName){

        $this->tableName = $tableName;
        $this->conn = $conn;
    }

    public abstract function initializeTable();
}

?>