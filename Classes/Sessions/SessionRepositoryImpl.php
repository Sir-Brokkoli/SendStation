<?php namespace Sendstation\Sessions;

require_once 'Classes/Sessions/Model/Session.php';
require_once 'Classes/Sessions/ISessionRepository.php';
require_once 'Classes/Database/SqlRepository.php';

use Sendstation\Sessions\Model\Session;
use Sendstation\Database\SqlRepository;

/**
 * Implementation of a session repository using a SQL driven database.
 */
class SessionRepositoryImpl extends SqlRepository implements ISessionRepository {
    
    private static $instance;

    private function __construct() {
        parent::__construct("Sessions");
    }

    /**
     * Returns the singleton instance of the session repository.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SessionRepositoryImpl();
        }
        return self::$instance;
    }

    /**
     * Returns the active session of the given climber or null if non found.
     */
    public function findActiveSessionByClimber($climberId) :?Session {
        $sql = "SELECT * FROM {$this->tableName} WHERE id_climber=? AND is_active=1";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $climberId)) {
            // TODO: Exception management
        }

        if ($rawData->num_rows == 0) {
            return null;
        }
        return $this->rawDataToEntities($rawData)[0];
    }

    /**
     * Adds the session to the persited context.
     */
    public function insert($session) :bool {
        $sql = "INSERT INTO {$this->tableName} (id_climber, id_crag, date, is_eco, is_active) VALUES (?,?,?,?,?)";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $session->getClimberId(), 
                                                                $session->getCragId(),
                                                                $session->getDate(),
                                                                $session->isEco() ? 1 : 0,
                                                                $session->isActive() ? 1 : 0)) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Updates the given session in the persisted context.
     */
    public function update($session) :bool {
        $sql = "UPDATE {$this->tableName} SET id_crag = ?, date = ?, is_eco = ?, is_active = ? WHERE id = ?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $session->getCragId(), 
                                                                $session->getDate(), 
                                                                $session->isEco() ? 1 : 0, 
                                                                $session->isActive() ? 1 : 0, 
                                                                $session->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Converts the raw data array to an array of sessions.
     */
    protected function rawDataToEntities($rawData) :array {
        $sessions = array();
        while($data = $rawData->fetch_assoc()){
            array_push($sessions, new Session($data['id'],
                                        $data['id_climber'],
                                        $data['id_crag'],
                                        $data['date'],
                                        $data['is_eco'],
                                        $data['reg_date'],
                                        $data['is_active']));
        }

        return $sessions;
    }
}
?>