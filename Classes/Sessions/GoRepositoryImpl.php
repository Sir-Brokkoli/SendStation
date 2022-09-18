<?php namespace Sendstation\Sessions;

require_once 'Classes/Sessions/Model/Go.php';

use Sendstation\Session\Model\Go;

/**
 * Implementation of a go repository using a SQL driven database.
 */
class GoRepositoryImpl implements IGoRepository {

    public function findAll() :array {
        // TODO: Implement
    }
    
    function findById($id) :Go {
        // TODO: Implement
    }

    function findByRoute($routeId) :array {
        // TODO: Implement
    }

    function findBySession($sessionId) :array {
        // TODO: Implement
    }

    function findBySessionAndRoute($sessionId, $routeId) :array {
        // TODO: Implement
    }
    
    function findSendGoByClimberAndRoute($climberId, $routeId) :Go {
        // TODO: Implement
    }

    function findTopropeGoByClimberAndRoute($climberId, $routeId) :Go {
        // TODO: Implement
    }

    public function insert($entry) :Go {
        // TODO: Implement
    }

    public function update($entry) :Go {
        // TODO: Implement
    }

    public function delete($entry) :void {
        // TODO: Implement
    }

    function deleteBySession($sessionId) :void {
        // TODO: Implement
    }
    
    function accummulateGoesData($climberId) {
        // TODO: Implement
    }

    function accummulateSendCountPerCrag($climberId, $cragId) :array {
        // TODO: Implement
    }
}
?>