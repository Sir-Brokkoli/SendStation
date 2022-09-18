<?php
namespace Sendstation\Database;

require_once "Classes/Database/ISqlDatabaseConnection.php";
require_once "Classes/config.php";

/**
 * A simple implementation of the ISqlDatabaseConnection interface.
 */
class MysqlDatabaseConnection implements ISqlDatabaseConnection {

    private static $instance;

    private $conn;

    protected function __construct() {
        $this->conn = new \mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if($this->conn->connect_error) {
            // TODO: Throw exception, unable to connects
        }
    }

    /**
     * Returns the instance of the conncetion singleton.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new MysqlDatabaseConnection();
        }
        return self::$instance;
    }

    /**
     * Executes the given SQL querry and returns its result in the outputData parameter.
     */
    public function executeSqlQuery(string $sql, &$outputData, ... $params) :bool {
        $stmt = $this->conn->prepare($sql);
        if(count($params) > 0){
            if($paramSpec = $this->getArgTypeSpecification($params)){
                $stmt->bind_param($paramSpec, ... $params);
            }
            else{
                echo "ArgType not supported Exception!\n";
                $stmt->close();
                return false;
            }
        }
        
        $success = $stmt->execute();
        $outputData = $stmt->get_result();
        $stmt->close();
        return $success;
    }

    private function getArgTypeSpecification($args){
        $spec = "";

        foreach($args as $arg){
            switch(gettype($arg)){
                case "string": 
                    $spec .= "s"; break;
                case "integer": 
                    $spec .= "i"; break;
                case "double": 
                    $spec .= "d"; break;
                case "boolean": 
                    $spec .= "b"; break;
                default: 
                    return false;
            }
        }

        return $spec;
    }

    private function __clone() {
        // Disable cloning of the singleton
    }
}

?>