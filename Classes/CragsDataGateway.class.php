<?php namespace Sendstation\Database;

include_once 'DataGateway.class.php';
include_once 'config.php';
include_once 'Classes/Model/Crag.class.php';

use Sendstation\Model\Crag;

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
        catch (\mysql_sql_exception $e) { }
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

    protected function insertEntry($crag){
        $sql = "INSERT INTO " . $this->getTableName() . " (name, description) VALUES (?,?)";

        try{
            $success = $this->executeSQL($sql, $out, $crag->getId(), $crag->getName(), $crag->getDescription());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    protected function updateEntry($crag){
        $sql = "UPDATE " . $this->getTableName() . " SET name = ?, description = ? WHERE id = ?";

        try{
            $success = $this->executeSQL($sql, $out, $crag->getName(), $crag->getDescription(), $crag->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
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