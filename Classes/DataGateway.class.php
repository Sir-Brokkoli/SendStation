<?php namespace Sendstation\Database;

abstract class DataGateway {

    private $tableName;
    private $conn;

    public function __construct($conn, $tableName){
        $this->tableName = $tableName;
        $this->conn = $conn;
    }

    public abstract function initializeTable();

    protected abstract function updateEntry($entry);
    protected abstract function insertEntry($entry);

    protected final function getTableName(){
        return $this->tableName;
    }

    public final function saveEntry($entry){

        if($entry->getId() !== null){

            return $this->updateEntry($entry);
        }
        else{

            return $this->insertEntry($entry);
        }
    }

    public function deleteEntry($entry){
        $sql = "DELETE FROM " . $this->getTableName() . " WHERE id = ?";
        echo $sql;
        try{
            $success = $this->executeSQL($sql, $out, $entry->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { 

            return false;
         }
    }

    public function findEntryById($id){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id = ?";

        try{
            if($this->executeSQL($sql, $data, $id)){

                return $data;
            }
        }
        catch (\mysql_sql_exception $e) { 
            
            return false; 
        }

        return false;
    }

    public function findAll(){
        try{
            $sql = "SELECT * FROM " . $this->getTableName();
            if($this->executeSQL($sql, $data)){

                return $data;
            }
        }
        catch (\mysql_sql_exception $e){

            return false;
        }

        return false;
    }

    public final function deleteAll(){
        try{
            $sql = "DELETE FROM ?";
            $success = $this->executeSQL($sql, $out, $this->tableName);

            return $success;
        }
        catch (\mysql_sql_exception $e) {

            return false;
        }
    }

    //
    // Executes the SQL query $sql after binding parameters $params and returns
    // the data in $outputData. Returns true if successfull, false otherwise.
    //
    protected final function executeSQL($sql, &$outputData, ... $params) {
        
        $stmt = $this->conn->prepare($sql);
        
        if(count($params) > 0){
            if($paramSpec = self::getArgTypeSpecification($params)){
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

    private static function getArgTypeSpecification($args){
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
}

?>