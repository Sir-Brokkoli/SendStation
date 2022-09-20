<?php namespace Sendstation\Security;

require_once 'Classes/Security/IAuthenticationService.php';
require_once 'Classes/Security/AuthenticationFailureException.php';
require_once 'Classes/Database/MysqlDatabaseConnection.php';

use Sendstation\Database\MysqlDatabaseConnection;

/**
 * Implementation of the IAuthenticationService.
 */
class Authentication implements IAuthenticationService {

    private static $instance;

    private function __construct() {
        // Singleton
    }

    /**
     * Returns the singleton instance and instanciates it if neccessary.
     */
    public static function getInstance() :IAuthenticationService {
        if(self::$instance == null) {
            self::$instance = new Authentication();
        }
        return self::$instance;
    }

    /**
     * Checks whether the logged in user has admin authorization.
     */
    public function checkForAdminAuthority() :bool {
        if (!key_exists('id', $_SESSION)) {
            return false;
        }
        $tableName = "Climbers";
        $loggedId = $_SESSION['id'];

        $sql = "SELECT COUNT(*) AS admin 
                FROM (
                    SELECT * 
                    FROM {$tableName} 
                    WHERE id=? AND admin=1
                ) AS res";

        return MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $loggedId)
            && $result->fetch_assoc()['admin'] = 1;
    }

    /**
     * Requires the logged in user to have admin authorization, throws
     * AuthenticationException if not the case.
     */
    public function requireAdminAuthority() :void {
        if (!$this->checkForAdminAuthority()) {
            throw new AuthenticationFailureException("admin");
        }
    }

    /**
     * Checks whether the logged in user has manager authorization.
     */
    public function checkForManagerAuthority() :bool {
        if (!key_exists('id', $_SESSION)) {
            return false;
        }
        $tableName = "Climbers";
        $loggedId = $_SESSION['id'];

        $sql = "SELECT COUNT(*) AS manager 
                FROM (
                    SELECT * 
                    FROM {$tableName} 
                    WHERE id=? AND admin=1
                ) AS res";

        return MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $result, $loggedId)
            && $result['manager'] = 1;
    }

    /**
     * Requires the logged in user to have manager authorization, throws
     * AuthenticationException if not the case.
     */
    public function requireManagerAuthority() :void {
        if (!$this->checkForManagerAuthority()) {
            throw new AuthenticationFailureException("manager");
        }
    }

    /**
     * Checks whether the logged user has the given id.
     */
    public function checkForLoggedUserId(int $userId) :bool {
        return key_exists('id', $_SESSION) && $_SESSION['id'] === $userId;
    }

    /**
     * Requires the logged user to have the given id, throws an
     * AuthenticationFailureException if not the case.
     */
    public function requireForLoggedUserId(int $userId) :void {
        if (!$this->checkForLoggedUserId($userId)) {
            throw new AuthenticationFailureException("userId");
        }
    }
}

?>