<?php namespace Sendstation\Users;

require_once 'Classes/Users/IClimberService.php';
require_once 'Classes/Users/ClimberRepositoryImpl.php';
require_once 'Classes/Security/AuthenticationProvider.php';

use Sendstation\Users\Model\Climber;
use Sendstation\Security\AuthenticationProvider;

class ClimberServiceImpl implements IClimberService {
    /**
     * Returns an array of all climbers. 
     * 
     * Authority needed: Admin
     */
    public function getAllClimbers() :array {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->finishAuthentication();

        return ClimberRepositoryImpl::getInstance()->findAll();
    }
    /**
     * Returns the climber with the given id or null if no such 
     * element was found.
     * 
     * Authority needed: Admin or own id
     */
    public function getClimberById(int $climberId) :?Climber {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->or()
            ->requireLoggedUserWithId($climberId)
            ->finishAuthentication();

        return ClimberRepositoryImpl::getInstance()->findById($climberId);
    }
    /**
     * Checks whether the given email address is already in use. Returns the
     * corresponding climber as reference argument if found.
     */
    public function isEmailTaken(string $email, &$climber) :bool {
        $climber = ClimberRepositoryImpl::getInstance()->findByEmail($email);
        return $climber == null;
    }
    /**
     * Checks whether the given username is already in use. Returns the
     * corresponding climber as reference argument if found.
     */
    public function isUsernameTaken(string $username, &$climber) :bool {
        $climber = ClimberRepositoryImpl::getInstance()->findByUsername();
        return $climber == null;
    }
    /**
     * Persists the given climber entity by either inserting or overriding
     * in the persisted context, depeding on whether the id is set.
     * 
     * Authority needed: Admin or own id
     */
    public function saveClimber(Climber $climber) :Climber {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->or()
            ->requireLoggedUserWithId($climberId)
            ->finishAuthentication();

        ClimberRepositoryImpl::getInstance()->save($climber);
        // TODO: Reload climber from database
        return $climber;
    }
    /**
     * Removes the given climber entity from the persisted context.
     * 
     * Authority needed: Admin or own id
     */
    public function deleteClimber(Climber $climber) :void {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->or()
            ->requireLoggedUserWithId($climberId)
            ->finish();

        ClimberRepositoryImpl::getInstance()->delete($climber);
    }
}

?>