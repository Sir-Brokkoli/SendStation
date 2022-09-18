<?php
namespace Sendstation\Crags;

require_once 'Classes/Crags/Model/Route.php';
require_once 'Classes/Crags/IRouteRepository.php';

use Sendstation\Crags\Model\Route;
use Sendstation\Crags\IRouteRepository;

/**
 * Implementation of a route repository using a SQL driven database.
 */
class RouteRepositoryImpl implements IRouteRepository {

    public function findAll() :array {
        $sql = "SELECT * FROM {$this->tableName}";
        if (!MysqlDatabaseConnection::getInstance()->executeSqlQuery($sql, $rawData)) {
            // TODO: Exception management
        }
        return self::rawDataToClimbers($rawData);
    }
    
    function findById($id) :Route {
        // TODO: Implement
    }

    function findByCrag($cragId) :Route {
        // TODO: Implement
    }

    public function insert($entry) :Route {
        // TODO: Implement
    }

    public function update($entry) :Route {
        // TODO: Implement
    }

    public function delete($entry) :void {
        // TODO: Implement
    }

    function deleteByCrag($cragId) :void {
        // TODO: Implement
    }
}
?>