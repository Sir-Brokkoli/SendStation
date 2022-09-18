<?php
namespace Sendstation\Sessions;

use Sendstation\Model\Session;

/**
 * Implementation of a session repository using a SQL driven database.
 */
class SessionRepositoryImpl implements ISessionRepository {

    public function findAll() :array {
        // TODO: Implement
    }
    
    function findById($id) :Session {
        // TODO: Implement
    }

    function findActiveSessionByClimber($climberId) :Session {
        // TODO: Implement
    }

    public function insert($entry) :Session {
        // TODO: Implement
    }

    public function update($entry) :Session {
        // TODO: Implement
    }

    public function delete($entry) :void {
        // TODO: Implement
    }
}
?>