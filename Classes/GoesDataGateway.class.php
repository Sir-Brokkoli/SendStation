<?php
namespace Sendstation\Database;

use Sendstation\Go;

include_once 'DataGateway.class.php';
include_once 'config.php';
include_once 'Go.class.php';

class GoesDataGateway extends DataGateway {

    public function __construct($conn){
        parent::__construct($conn, DT_GOES);
    }

    public function initializeTable(){
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTableName();
        $sql .= "(";
        $sql .= "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
        $sql .= "id_session INT(6) UNSIGNED NOT NULL, ";
        $sql .= "id_route INT(6) UNSIGNED NOT NULL, ";
        $sql .= "falls INT UNSIGNED NOT NULL, ";
        $sql .= "send TINYINT(1) DEFAULT 0 NOT NULL, ";
        $sql .= "toprope TINYINT(1) DEFAULT 0 NOT NULL, ";
        $sql .= "FOREIGN KEY (id_session) REFERENCES Sessions(id) ON UPDATE CASCADE ON DELETE CASCADE, ";
        $sql .= "FOREIGN KEY (id_route) REFERENCES Routes(id) ON UPDATE CASCADE ON DELETE RESTRICT";
        $sql .= ")";

        try{
            $success = $this->executeSQL($sql, $out);

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findAll(){
        $goesData = parent::findAll();

        $goes = $this->getGoesFromData($goesData);

        return $goes;
    }

    protected function insertEntry($go){
        $sql = "INSERT INTO " . $this->getTableName() . " (id_session, id_route, falls, send, toprope) VALUES (?,?,?,?,?)";
        echo $sql;
        try{
            $success = $this->executeSQL($sql, $out, 
                                $go->getSessionId(),
                                $go->getRouteId(),
                                $go->getFalls(),
                                $go->wasSent() ? 1 : 0,
                                $go->wasToproped() ? 1 : 0);

            return $success;
        }
        catch (\mysql_sql_exception $e) { echo "Fail"; }
    } 

    protected function updateEntry($go){
        $sql = "UPDATE " . $this->getTableName() . " SET id_session = ?, id_route = ?, falls = ?, send = ?, toprope = ? WHERE id = ?";

        try{
            $success = $this->executeSQL($sql, $out, 
                                $go->getSessionId(),
                                $go->getRouteId(),
                                $go->getFalls(),
                                $go->wasSent(),
                                $go->wasToproped(),
                                $go->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findGoesOfSessionInRoute($session, $route){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id_session = ? AND id_route = ?";

        try{
            $success = $this->executeSQL($sql, $outputData, 
                                $session->getId(),
                                $route->getId());

            if($success){
                return $this->getGoesFromData($outputData);
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findGoesInSession($session){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id_session = ?";

        try{
            $success = $this->executeSQL($sql, $outputData, 
                                $session->getId());

            if($success){
                return $this->getGoesFromData($outputData);
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function deleteGoesInSession($session){
        $sql = "DELETE FROM " . $this->getTableName() . " WHERE id_session = ?";
        echo $sql;
        try{
            $success = $this->executeSQL($sql, $out, $session->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findSendGo($climberId, $route){
        $sql = "SELECT " . $this->getTableName() . ".id FROM " . $this->getTableName() . ", " . DT_SESSIONS . " WHERE "; 
        $sql .= $this->getTableName() . ".id_route = ? AND ";
        $sql .= $this->getTableName() . ".id_session = " . DT_SESSIONS . ".id AND ";
        $sql .= DT_SESSIONS . ".id_climber = ? AND ";
        $sql .= $this->getTableName() . ".send = 1";
        
        try{
            $success = $this->executeSQL($sql, $outputData, 
                                $route->getId(),
                                $climberId);

            if($success){
                return $outputData->num_rows > 0;
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findTopropeGo($climberId, $route){
        $sql = "SELECT " . $this->getTableName() . ".id FROM " . $this->getTableName() . ", " . DT_SESSIONS . " WHERE "; 
        $sql .= $this->getTableName() . ".id_route = ? AND ";
        $sql .= $this->getTableName() . ".id_session = " . DT_SESSIONS . ".id AND ";
        $sql .= DT_SESSIONS . ".id_climber = ? AND ";
        $sql .= $this->getTableName() . ".toprope = 1";

        try{
            $success = $this->executeSQL($sql, $outputData, 
                                $route->getId(),
                                $climberId);

            if($success){
                return $outputData->num_rows > 0;
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    private function getGoesFromData($goesData) {
        $goes = array();
        while($data = $goesData->fetch_assoc()){
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