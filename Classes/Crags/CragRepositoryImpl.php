<?php
namespace Sendstation\Crags;

require_once 'Classes/Crags/Model/Crag.php';
require_once 'Classes/Crags/ICragRepository.php';

require_once 'Classes/Database/SqlRepository.php';

use Sendstation\Crags\Model\Crag;

use Sendstation\Database\SqlRepository;

/**
 * Implementation of a go repository using a SQL driven database.
 */
class CragRepositoryImpl extends SqlRepository implements ICragRepository {

    private static $instance;

    private function __construct() {
        // Singleton constructor
        parent::__construct("Crags");
    }

    public static function getInstance() :ICragRepository {
        if (self::$instance == null) {
            self::$instance = new CragRepositoryImpl();
        }
        return self::$instance;
    }

    public function insert($crag) :bool {
        $sql = "INSERT INTO {$this->tableName} (name, description) VALUES (?,?)";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $crag->getName(), 
                                                                $crag->getDescription())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    public function update($crag) :bool {
        $sql = "UPDATE {$this->tableName} SET name=?, description=? WHERE id=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $crag->getName(), 
                                                                $crag->getDescription(), 
                                                                $crag->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    protected function rawDataToEntities($rawData) :array {
        $crags = array();
        while($data = $rawData->fetch_assoc()){
            array_push($crags, new Crag($data['id'],
                                        $data['name'],
                                        $data['description']));
        }

        return $crags;
    }
}
?>