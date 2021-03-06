<?php
namespace Sendstation\Database;

include_once 'RoutesDataGateway.class.php';
include_once 'CragsDataGateway.class.php';
include_once 'SessionsDataGateway.class.php';
include_once 'GoesDataGateway.class.php';
include_once 'ClimbersDataGateway.class.php';
include_once 'ConnectionMysql.class.php';

class Database {

    private function __construct(){}
    private function __clone(){}

    public static function getRoutesDataGateway(){
        return new RoutesDataGateway(self::getConnection());
    }

    public static function getCragsDataGateway(){
        return new CragsDataGateway(self::getConnection());
    }

    public static function getSessionsDataGateway(){
        return new SessionsDataGateway(self::getConnection());
    }

    public static function getGoesDataGateway(){
        return new GoesDataGateway(self::getConnection());
    }

    public static function getClimbersDataGateway(){
        return new ClimbersDataGateway(self::getConnection());
    }

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