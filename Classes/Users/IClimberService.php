<?php namespace Sendstation\Users;

/**
 * Interface for a service concerning user data.
 */
interface IClimberService {
    /**
     * Returns an array of all climbers. 
     * 
     * Authority needed: Admin
     */
    public function getAllClimbers() :array;
    /**
     * Returns the climber with the given id or throws Exception if no such 
     * element was found.
     */
    public function getClimberById(int $climberId) :Climber;
    /**
     * Checks whether the given email address is already in use. Returns the
     * corresponding climber as reference argument if found.
     */
    public function isEmailTaken(string $email, &$climber) :bool;
    /**
     * Checks whether the given username is already in use. Returns the
     * corresponding climber as reference argument if found.
     */
    public function isUsernameTaken(string $username, &$climber) :bool;
    /**
     * Persists the given climber entity by either inserting or overriding
     * in the persisted context, depeding on whether the id is set.
     * 
     * Authority needed: Admin
     */
    public function saveClimber(Climber $climber) :Climber;
    /**
     * Removes the given climber entity from the persisted context.
     * 
     * Authority needed: Admin
     */
    public function deleteClimber(Climber $climber) :void;
}

?>