<?php namespace Sendstation\Database;

include_once 'DataGateway.class.php';
include_once 'config.php';
include_once 'Classes/Model/Climber.class.php';

use Sendstation\Model\Climber;

class ClimbersDataGateway extends DataGateway {

    public function __construct($conn){
        parent::__construct($conn, DT_CLIMBERS);
    }

    public function initializeTable(){
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTableName();
        $sql .= "(";
        $sql .= "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
        $sql .= "nickname CHAR(16) NOT NULL UNIQUE, ";
        $sql .= "email CHAR(32) NOT NULL UNIQUE, ";
        $sql .= "password CHAR(255) NOT NULL, ";
        $sql .= "reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL";
        $sql .= ")";

        try{
            $success = $this->executeSQL($sql, $out);

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function getScheme() : array {

        return Climber::getSerializationScheme();
    }

    public function findAll(){
        $climbersData = parent::findAll();

        $climbers = $this->getClimbersFromData($climbersData);

        return $climbers;
    }

    public function findByEmail($email){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE email = ?";

        try {
            if($this->executeSQL($sql, $climberData, $email)) {
                $climberArray = $this->getClimbersFromData($climberData);

                if(count($climberArray) == 1) {
                    return $climberArray[0];
                }

                return null;
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findByUsername($username){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE nickname = ?";

        try {
            if($this->executeSQL($sql, $climberData, $username)) {
                $climberArray = $this->getClimbersFromData($climberData);

                if(count($climberArray) == 1) {
                    return $climberArray[0];
                }

                return null;
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    protected function insertEntry($climber){
        $sql = "INSERT INTO " . $this->getTableName() . " (nickname, email, password) VALUES (?,?,?)";

        try{
            $success = $this->executeSQL($sql, $out, 
                                $climber->getNickname(),
                                $climber->getEmail(),
                                $climber->getPasswordHash());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    protected function updateEntry($climber){
        $sql = "UPDATE " . $this->getTableName() . " SET nickname = ?, email = ?, password = ? WHERE id = ?";

        try{
            $success = $this->executeSQL($sql, $out, 
                                $climber->getNickname(), 
                                $climber->getEmail(), 
                                $climber->getPasswordHash(),
                                $climber->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    private function getClimbersFromData($climbersData) {
        $climbers = array();
        while($data = $climbersData->fetch_assoc()){
            array_push($climbers, new Climber($data['id'],
                                        $data['nickname'],
                                        $data['email'],
                                        $data['password'],
                                        $data['reg_date']));
        }

        return $climbers;
    }
}

?>