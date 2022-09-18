<?php namespace Sendstation\Sessions;

require_once 'Classes/Sessions/Model/Go.php';
require_once 'Classes/Sessions/IGoRepository.php';
require_once 'Classes/Database/SqlRepository.php';

use Sendstation\Sessions\Model\Go;

use Sendstation\Database\SqlRepository;

/**
 * Implementation of a go repository using a SQL driven database.
 */
class GoRepositoryImpl extends SqlRepository implements IGoRepository {

    private static $instance;

    private function __construct() {
        parent::__construct("Goes");
    }

    public static function getInstance() :IGoRepository {
        if (self::$instance == null) {
            self::$instance = new GoRepositoryImpl();
        }
        return self::$instance;
    }

    /**
     * Fetches all goes registered in the given route.
     */
    public function findByRoute($routeId) :array {
        $sql = "SELECT * FROM {$this->tableName} WHERE id_route=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $routeId)) {
            // TODO: Exception management
        }

        return $this->rawDataToEntities($rawData);
    }

    /**
     * Fetches all goes registered in the given session.
     */
    public function findBySession($sessionId) :array {
        $sql = "SELECT * FROM {$this->tableName} WHERE id_session=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $sessionId)) {
            // TODO: Exception management
        }
        
        return $this->rawDataToEntities($rawData);
    }

    /**
     * Fetches all goes registered in the given session and route.
     */
    public function findBySessionAndRoute($sessionId, $routeId) :array {
        $sql = "SELECT * FROM {$this->tableName} WHERE id_route=? AND id_session=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $routeId, $sessionId)) {
            // TODO: Exception management
        }
        
        return $this->rawDataToEntities($rawData);
    }
    
    /**
     * Fetches the send go of the given climber in the given route. Returns null if
     * none found.
     */
    public function findSendGoByClimberAndRoute($climberId, $routeId) :?Go {
        $sessionsTableName = "Sessions";

        $sql = "SELECT {$this->tableName}.* FROM {$this->tableName}, {$sessionsTableName} WHERE "; 
        $sql .= "{$this->tableName}.id_route = ? AND ";
        $sql .= "{$this->tableName}.id_session = {$sessionsTableName}.id AND ";
        $sql .= "{$sessionsTableName}.id_climber = ? AND ";
        $sql .= "{$this->tableName}.send = 1";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $routeId, $climberId)) {
            // TODO: Exception management
            echo "Error!";
            die();
        }

        if ($rawData->num_rows > 0) {
            return $this->rawDataToEntities($rawData)[0];
        }
        return null;
    }

    /**
     * Fetches the toprope send go of the given climber in the given route. Returns null 
     * if none found.
     */
    public function findTopropeSendGoByClimberAndRoute($climberId, $routeId) :?Go {
        $sessionsTableName = "Sessions";

        $sql = "SELECT {$this->tableName}.* FROM {$this->tableName}, {$sessionsTableName} WHERE 
                {$this->tableName}.id_route = ? AND 
                {$this->tableName}.id_session = {$sessionsTableName}.id AND 
                {$sessionsTableName}.id_climber = ? AND 
                {$this->tableName}.toprope = 1";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $routeId, $climberId)) {
            // TODO: Exception management
            return null;
        }

        if ($rawData->num_rows > 0) {
            return $this->rawDataToEntities($rawData)[0];
        }
        return null;
    }

    /**
     * Adds the given go to the persisted context.
     */
    public function insert($go) :bool {
        $sql = "INSERT INTO {$this->tableName} (id_session, id_route, falls, send, toprope) VALUES (?,?,?,?,?)";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $go->getSessionId(), 
                                                                $go->getRouteId(),
                                                                $go->getFalls(),
                                                                $go->wasSent() ? 1 : 0,
                                                                $go->wasToproped() ? 1 : 0)) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Updates the given go in the persisted context.
     */
    public function update($go) :bool {
        $sql = "UPDATE {$this->tableName} SET id_session = ?, id_route = ?, falls = ?, send = ?, toprope = ? WHERE id = ?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $go->getSessionId(), 
                                                                $go->getRouteId(),
                                                                $go->getFalls(),
                                                                $go->wasSent() ? 1 : 0,
                                                                $go->wasToproped() ? 1 : 0, 
                                                                $go->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Removes all goes associated with the given session from the persisted context.
     */
    public function deleteBySession($sessionId) :bool {
        $sql = "DELETE FROM {$this->tableName} WHERE id_session=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $sessionId)) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Removes all goes associated with the given route from the persisted context.
     */
    public function deleteByRoute($routeId) :bool {
        $sql = "DELETE FROM {$this->tableName} WHERE id_route=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $routeId)) {
            // TODO: Exception management
            return false;
        }

        return true;
    }
    
    /**
     * Accumulates the data for the goes data sheet.
     */
    public function accummulateGoesData($climberId) {
        $sql = "SELECT COUNT(*) AS goes, 
                    COUNT(DISTINCT g.id_session) AS sessions, 
                    SUM(g.falls) AS falls, 
                    MAX(g.falls) AS mostFalls 
                FROM Goes AS g 
                JOIN (SELECT id FROM Sessions WHERE id_climber = ?) AS s ON g.id_session = s.id;";
        if (!$this->connection->executeSqlQuery($sql, $data, $climberId)) {
            // TODO: Exception management
            return false;
        }

        return $data;
    }

    /**
     * Accumulates the number of sended routes for each crag for the given climber.
     */
    public function accummulateSendCountPerCrag($climberId) {
        $sql = "SELECT id_crag, name, COUNT(sended) AS sends, COUNT(*) AS total 
                FROM (SELECT DISTINCT c.id AS id_crag, c.name AS name, r.id AS id_route, g.send AS sended 
                    FROM Crags AS c JOIN Routes AS r ON c.id = r.id_crag 
                    LEFT JOIN (SELECT g.id_route as id_route, g.send as send FROM Goes AS g
                        JOIN Sessions AS s ON g.id_session = s.id 
                        WHERE send = TRUE AND s.id_climber = ?) AS g ON g.id_route = r.id) AS res 
                GROUP BY id_crag, name
                ORDER BY sends DESC";
        if (!$this->connection->executeSqlQuery($sql, $data, $climberId)) {
            // TODO: Exception management
            return false;
        }

        return $data;
    }

    /**
     * Converts the raw data to go instances.
     */
    protected function rawDataToEntities($rawData) :array {
        $goes = array();
        while($data = $rawData->fetch_assoc()){
            array_push($goes, new Go($data['id'],
                                $data['id_session'],
                                $data['id_route'],
                                $data['falls'],
                                $data['send'],
                                $data['toprope']));
        }

        return $goes;
    }
}
?>