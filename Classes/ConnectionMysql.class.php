<?php 
namespace Sendstation\Database;

include_once('Classes/config.php');

class ConnectionMysql{
    public static $conn = null;
    public static $instance = null;

    protected function __construct(){
        // Create connection
        self::$conn = new \mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);


        // Check connection
        if (self::$conn->connect_error) {
            die("Connection failed: " . self::$conn->connect_error);
        }
    }

    function __destruct(){
        /*if(!(self::$conn == null)){
            self::closeConnection();
        }*/
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new ConnectionMysql();
        }
        return self::$conn;
    }

    public static function closeConnection(){
        self::$conn->close();
        self::$conn = null;
    }

    public static function getDataFromTable($tableSpec, $dataSpec, $conditions = "", $specifications = "", ... $args){
        if(self::$instance == null){
            self::$instance = new ConnectionMysql();
        }

        $sql = "SELECT " . $dataSpec . " FROM " . $tableSpec;

        if(empty($conditions) == false){
            $sql .= " WHERE " . $conditions;
        }

        if(empty($specifications) == false){
            $sql .= " " . $specifications;
        }

        if($stmt = self::$conn->prepare($sql)){
            foreach($args as $arg){
                if($spec = self::getArgTypeSpecification($arg)){
                    $stmt->bind_param($spec, $arg);
                }
                else{
                    echo "Param type of " . $arg . " not valid.";
                    return false;
                }
            }

            if($stmt->execute()){
                $dataSet = $stmt->get_result();
            }
            else{
                //Error: Unable to send query
                $stmt->close();
                return false;
            }

            $stmt->close();
            return $dataSet;
        }

        return false;
    }

    private static function getArgTypeSpecification($arg){
        $spec = "";

        switch(gettype($arg)){
            case "string": 
                $spec = "s"; break;
            case "integer": 
                $spec = "i"; break;
            case "double": 
                $spec = "d"; break;
            case "boolen": 
                $spec = "b"; break;
            default: 
                $spec = false;
        }

        return $spec;
    }

    

    //Disable clone function since we work with a singleton.
    private function __clone(){

    }
}
?>