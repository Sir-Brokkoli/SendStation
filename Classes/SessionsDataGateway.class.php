<?php namespace Sendstation\Database;

include_once 'DataGateway.class.php';
include_once 'config.php';
include_once 'Classes/Sessions/Model/Session.php';

use Sendstation\Sessions\Model\Session;

class SessionsDataGateway extends DataGateway {

    public function __construct($conn){
        parent::__construct($conn, DT_SESSIONS);
    }

    public function initializeTable(){
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTableName();
        $sql .= "(";
        $sql .= "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
        $sql .= "id_climber INT(6) UNSIGNED NOT NULL, ";
        $sql .= "id_crag INT(6) UNSIGNED NOT NULL, ";
        $sql .= "date DATE DEFAULT CURRENT_DATE, ";
        $sql .= "is_eco TINYINT(1) DEFAULT 0 NOT NULL, ";
        $sql .= "reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP, ";
        $sql .= "is_active TINYINT(1) NOT NULL, ";
        $sql .= "FOREIGN KEY (id_climber) REFERENCES Climbers(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $sql .= "FOREIGN KEY (id_crag) REFERENCES Crags(id) ON UPDATE CASCADE ON DELETE RESTRICT";
        $sql .= ")";

        try{
            $success = $this->executeSQL($sql, $out);

            return $success;
        }
        catch (\mysql_sql_exception $e) { 
            return false; 
        }
    }

    public function getScheme() : array {

        return Session::getSerializationScheme();
    }

    public function findAll(){

        $sessionsData = parent::findAll();

        $sessions = $this->getSessionsFromData($sessionsData);

        return $sessions;
    }

    protected function insertEntry($session){
        $sql = "INSERT INTO " . $this->getTableName() . " (id_climber, id_crag, date, is_eco, is_active) VALUES (?,?,?,?,?)";

        try{
            $success = $this->executeSQL($sql, $out,  
                                $session->getClimberId(), 
                                $session->getCragId(),
                                $session->getDate(),
                                $session->isEco() ? 1 : 0,
                                $session->isActive() ? 1 : 0);

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    protected function updateEntry($session){
        $sql = "UPDATE " . $this->getTableName() . " SET id_crag = ?, date = ?, is_eco = ?, is_active = ? WHERE id = ?";

        try{
            $success = $this->executeSQL($sql, $out, 
                                $session->getCragId(), 
                                $session->getDate(), 
                                $session->isEco() ? 1 : 0, 
                                $session->isActive() ? 1 : 0, 
                                $session->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findActiveSession($climberId){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id_climber = ? AND is_active = 1";

        try{
            $this->executeSQL($sql, $sessionData, $climberId);

            if($sessionData->num_rows == 0){
                return null;
            }
            else if($sessionData->num_rows == 1){
                $sessionArray = $this->getSessionsFromData($sessionData);

                return $sessionArray[0];
            }
            else {
                // TODO - Log an error message
                return false;
            }
        }
        catch (\mysql_sql_exception $e) { }
    }

    private function getSessionsFromData($sessionsData) {
        $sessions = array();
        while($data = $sessionsData->fetch_assoc()){
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