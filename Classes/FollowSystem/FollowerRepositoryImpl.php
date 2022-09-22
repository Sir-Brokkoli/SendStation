<?php namespace Sendstation\FollowerSystem;

require_once 'IFollowerRepository.php';
require_once 'Classes/Database/MysqlDatabaseConnection.php';

use Sendstation\Database\MysqlDatabaseConnection;

/**
 * Implementation of the IFollowerRepository interface.
 */
class FollowerRepositoryImpl implements IFollowerRepository {

    private string $tableName = "Followers";

    private static $instance;

    private function __construct() {
        // Singleton
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new FollowerServiceImpl();
        }
        return self::$instace;
    }

    public function addFollowerTo(int $followerId, int $followeeId) :void {
        $sql = "INSERT INTO {$this->tableName} (id_follower, id_followee) VALUES (?,?);";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $followerId, $followeeId)) {
            // Exception management
        }
    }

    public function removeFollowerFrom(int $followerId, int $followeeId) :void {
        $sql = "DELETE * FROM {$this->tableName} WHERE id_follower = ? AND id_followee = ?;";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $followerId, $followeeId)) {
            // Exception management
        }
    }

    public function follows(int $followerId, int $followeeId) :bool {
        $sql = "SELECT * FROM {$this->tableName} WHERE id_follower = ? AND id_followee = ?;";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $followerId, $followeeId)) {
            // Exception management
        }
        return $result->num_rows == 1;
    }
    
    public function findAllFollowers(int $climberId) :array {
        $sql = "SELECT id_follower FROM {$this->tableName} WHERE id_followee = ?;";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $followerId, $followeeId)) {
            // Exception management
        }

        // TODO: Convert data
    }

    public function findAllFollowees(int $climberId) :array {
        $sql = "SELECT id_followee FROM {$this->tableName} WHERE id_follower = ?;";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $followerId, $followeeId)) {
            // Exception management
        }

        // TODO: Convert data
    }
}
?>