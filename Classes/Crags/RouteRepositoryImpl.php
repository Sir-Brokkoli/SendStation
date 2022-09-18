<?php namespace Sendstation\Crags;

require_once 'Classes/Crags/Model/Route.php';
require_once 'Classes/Crags/IRouteRepository.php';
require_once 'Classes/Database/SqlRepository.php';

use Sendstation\Crags\Model\Route;
use Sendstation\Crags\IRouteRepository;

use Sendstation\Database\SqlRepository;

/**
 * Implementation of a route repository using a SQL driven database.
 */
class RouteRepositoryImpl extends SqlRepository implements IRouteRepository {

    private static $instance;

    private function __construct() {
        parent::__construct("Routes");
    }

    /**
     * Returns the instace of the RouteRepositoryImpl.
     */
    public static function getInstance() :IRouteRepository {
        if (self::$instance == null) {
            self::$instance = new RouteRepositoryImpl();
        }
        return self::$instance;
    }

    /**
     * Fetches all routes assigned to the given crag.
     */
    function findByCrag($cragId) :array {
        $sql = "SELECT * FROM {$this->tableName} WHERE id_crag=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $cragId)) {
            // TODO: Exception management
        }

        return $this->rawDataToEntities($rawData);
    }

    /**
     * Adds the given entity to the persisted context.
     */
    public function insert($route) :bool {
        $sql = "INSERT INTO {$this->tableName} (id_crag, name, grade, description) VALUES (?,?,?,?)";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $route->getCragId(),
                                                                $route->getName(),
                                                                $route->getGrade(),
                                                                $route->getDescription())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Updates the given entity in the persisted context.
     */
    public function update($route) :bool {
        $sql = "UPDATE {$this->tableName} SET id_crag=?, name=?, grade=?, description=? WHERE id=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $route->getCragId(),
                                                                $route->getName(),
                                                                $route->getGrade(),
                                                                $route->getDescription(),
                                                                $route->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    /**
     * Removes all routes associated with the given crag from the persisted context.
     */
    function deleteByCrag($cragId) :bool {
        $sql = "DELETE FROM {$this->tableName} WHERE id_crag=?";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData, $cragId)) {
            // TODO: Exception management
            return false;
        }

        return true;
    }
}
?>