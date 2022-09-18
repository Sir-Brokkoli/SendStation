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

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new SessionRepositoryImpl();
        }
        return self::$instance;
    }

    public function findActiveSessionByClimber($climberId) :?Session {
        $sql = "SELECT * FROM {$this->tableName} WHERE nickname=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $username)) {
            // TODO: Exception management
        }

        if ($rawData->num_rows == 0) {
            return null;
        }
        return $this->rawDataToEntities($rawData)[0];
    }

    public function insert($session) :bool {
        $sql = "INSERT INTO {$this->getTableName()} (id_climber, id_crag, date, is_eco, is_active) VALUES (?,?,?,?,?)";
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