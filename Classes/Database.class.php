<?php
namespace Sendstation\Database;

include_once 'RoutesDataGateway.class.php';
include_once 'ConnectionMysql.class.php';

class Database {

    private function __construct(){ /* Singleton */}
    private function __clone(){ /* Singleton */}

    private static function getConnection(){
        return ConnectionMysql::getInstance();
    }

    public static function beginTransaction(){
        self::getConnection()->begin_transaction();
    }

    public static function commitTransaction(){
        self::getConnection()->commit();
    }

    public static function rollbackTransaction(){
        self::getConnection()->rollback();
    }
}

?>