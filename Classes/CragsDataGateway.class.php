<?php namespace Sendstation\Database;

include_once 'DataGateway.class.php';
include_once 'config.php';
include_once 'Classes/Crags/Model/Crag.php';

use Sendstation\Crags\Model\Crag;

class CragsDataGateway extends DataGateway {

    public function __construct($conn){
        parent::__construct($conn, DT_CRAGS);
    }

    public function initializeTable(){
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTableName();
        $sql .= "(";
        $sql .= "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
        $sql .= "name CHAR(32) NOT NULL UNIQUE, ";
        $sql .= "description CHAR(128) DEFAULT '' NOT NULL";
        $sql .= ")";

        try{
            $success = $this->executeSQL($sql, $out);

            return $success;
        }
        catch (\mysql_sql_exception $e) { return false; }
    }

    public function findEntryById($id){
        $cragData = parent::findEntryById($id)->fetch_assoc();
        return new Crag($cragData['id'], $cragData['name'], $cragData['description']);
    }

    public function findAll(){
        $cragsData = parent::findAll();

        $crags = $this->getCragsFromData($cragsData);

        return $crags;
    }

    public function findSendedRoutesCount($climberId) {
        $sql = "SELECT id_crag, name, COUNT(sended) AS sends, COUNT(*) AS total 
                FROM (SELECT DISTINCT c.id AS id_crag, c.name AS name, r.id AS id_route, g.send AS sended 
                    FROM Crags AS c JOIN Routes AS r ON c.id = r.id_crag 
                    LEFT JOIN (SELECT g.id_route as id_route, g.send as send FROM Goes AS g
                        JOIN Sessions AS s ON g.id_session = s.id 
                        WHERE send = TRUE AND s.id_climber = ?) AS g ON g.id_route = r.id) AS res 
                GROUP BY id_crag, name
                ORDER BY sends DESC";
        

        try{
            $this->executeSQL($sql, $out, $climberId);

            return $out;
        }
        catch (\mysql_sql_exception $e) { return false; }
    }

    protected function insertEntry($crag){
        $sql = "INSERT INTO " . $this->getTableName() . " (name, description) VALUES (?,?)";

        try{
            $success = $this->executeSQL($sql, $out, $crag->getName(), $crag->getDescription());

            return $success;
        }
        catch (\mysql_sql_exception $e) { return false; }
    }

    protected function updateEntry($crag){
        $sql = "UPDATE " . $this->getTableName() . " SET name = ?, description = ? WHERE id = ?";

        try{
            $success = $this->executeSQL($sql, $out, $crag->getName(), $crag->getDescription(), $crag->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { return false; }
    }

    private function getCragsFromData($cragsData) {
        $crags = array();
        while($data = $cragsData->fetch_assoc()){
            array_push($crags, new Crag($data['id'],
                                        $data['name'],
                                        $data['description']));
        }

        return $crags;
    }
}

?>