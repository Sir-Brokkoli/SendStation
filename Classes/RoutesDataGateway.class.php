<?php namespace Sendstation\Database;

include_once 'DataGateway.class.php';
include_once 'config.php';
include_once 'Classes/Model/Route.class.php';

use Sendstation\Model\Route;

class RoutesDataGateway extends DataGateway{

    public function __construct($conn){
        parent::__construct($conn, DT_ROUTES);
    }

    public function initializeTable(){
        $sql = "CREATE TABLE IF NOT EXISTS " . $this->getTableName();
        $sql .= "(";
        $sql .= "id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, ";
        $sql .= "id_crag INT(6) UNSIGNED NOT NULL, ";
        $sql .= "name CHAR(32) NOT NULL UNIQUE, ";
        $sql .= "grade CHAR(3) NOT NULL, ";
        $sql .= "description CHAR(128), ";
        $sql .= "FOREIGN KEY (id_crag) REFERENCES Crags(id) ON UPDATE CASCADE ON DELETE RESTRICT";
        $sql .= ")";

        try{
            $success = $this->executeSQL($sql, $out);

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function getScheme() : array {

        return Route::getSerializationScheme();
    }

    public function findAll(){
        $routesData = parent::findAll();

        $routes = $this->getRoutesFromData($routesData);

        return $routes;
    }

    protected function insertEntry($route){
        $sql = "INSERT INTO " . $this->getTableName() . " (id_crag, name, grade, description) VALUES (?,?,?,?)";

        try{
            $success = $this->executeSQL($sql, $out, 
                                $route->getCragId(), 
                                $route->getName(), 
                                $route->getGrade(),
                                $route->getDescription());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    protected function updateEntry($route){
        $sql = "UPDATE " . $this->getTableName() . " SET id_crag = ?, name = ?, grade = ?, description = ? WHERE id = ?";

        try{
            $success = $this->executeSQL($sql, $out,  
                                $route->getCragId(), 
                                $route->getName(), 
                                $route->getGrade(),
                                $route->getDescription(),
                                $route->getId());

            return $success;
        }
        catch (\mysql_sql_exception $e) { }
    }

    public function findRoutesInCrag($cragId){
        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE id_crag = ?";

        try{
            $success = $this->executeSQL($sql, $routesData, $cragId);
            if($success){
                $routes = $this->getRoutesFromData($routesData);

                return $routes;
            }

            return false;
        }
        catch (\mysql_sql_exception $e) { }
    }

    private function getRoutesFromData($routesData){
        $routes = array();
        while ($data = $routesData->fetch_assoc()){
            array_push($routes, new Route($data['id'],
                                        $data['name'],
                                        $data['id_crag'],
                                        $data['grade'],
                                        $data['description']));
        }

        return $routes;
    }
}

?>