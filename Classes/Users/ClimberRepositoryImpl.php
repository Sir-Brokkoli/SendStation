<?php
namespace Sendstation\Users;

require_once "Classes/Users/Model/Climber.php";
require_once "Classes/Users/IClimberRepository.php";
require_once "Classes/Database/SqlRepository.php";

use Sendstation\Users\Model\Climber;
use Sendstation\Database\SqlRepository;

/**
 * Implementation of a go repository using a SQL driven database.
 */
class ClimberRepositoryImpl extends SqlRepository implements IClimberRepository {

    private static $instance;

    private function __construct() {
        // private constructor for singleton
        parent::__construct("Climbers");
    }

    /**
     * Returns the instance of the repository.
     */
    public static function getInstance() :IClimberRepository {
        if (self::$instance == null) {
            self::$instance = new ClimberRepositoryImpl();
        }
        return self::$instance;
    }

    public function findByEmail(string $email) :?Climber {
        $sql = "SELECT * FROM {$this->tableName} WHERE email=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $email)) {
            // TODO: Exception management
        }

        if ($rawData->num_rows == 0) {
            return null;
        }
        return self::rawDataToEntities($rawData)[0];
    }

    public function findByUsername(string $username) :?Climber {
        $sql = "SELECT * FROM {$this->tableName} WHERE nickname=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $username)) {
            // TODO: Exception management
        }

        if ($rawData->num_rows == 0) {
            return null;
        }
        return self::rawDataToEntities($rawData)[0];
    }

    public function insert($climber) :bool {
        $sql = "INSERT INTO {$this->tableName} (nickname, email, password) VALUES (?,?,?)";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $climber->getNickname(), 
                                                                                    $climber->getEmail(), 
                                                                                    $climber->getPasswordHash())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    public function update($climber) :bool {
        $sql = "UPDATE {$this->tableName} SET nickname=?, email=?, password=? WHERE id=?";
        if (!$this->connection->executeSqlQuery($sql, $rawData, $climber->getNickname(), 
                                                                                    $climber->getEmail(), 
                                                                                    $climber->getPassword(),
                                                                                    $climber->getId())) {
            // TODO: Exception management
            return false;
        }

        return true;
    }

    protected function rawDataToEntities($rawData) :array {
        $climbers = array();
        while($data = $rawData->fetch_assoc()){
            array_push($climbers, new Climber($data['id'],
                                        $data['nickname'],
                                        $data['email'],
                                        $data['password'],
                                        $data['reg_date']));
        }

        return $climbers;
    }

    private function __clone() {
        // private clone method for singleton
    }
}
?>