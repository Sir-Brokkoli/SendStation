<?php namespace Sendstation\FollowerSystem;

require_once 'IFollowerService.php';
require_once 'FollowerRepositoryImpl.php';
require_once 'Classes/Security/AuthenticationProvider.php';

use Sendstation\Security\AuthenticationProvider;

class FollowerServiceImpl implements IFollowerService {

    private static $instance;

    private function __construct() {
        // Singleton
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new FollowerServiceImpl();
        }
        return self::$instace;
    }
    
    public function addFollowerTo(int $followerId, int $followeeId) :void {
        AuthenticationProvider::startAuthentication()
            ->requireLoggedUserWithId($followerId)
            ->finishAuthentication();

        FollowerRepositoryImpl::getInstance()->addFollowerTo($followerId, $followeeId);
    }

    public function removeFollowerFrom(int $followerId, int $followeeId) :void {
        AuthenticationProvider::startAuthentication()
            ->requireLoggedUserWithId($followerId)
            ->or()
            ->requestLoggedUserWithId($followeeId)
            ->finishAuthentication();
    
        FollowerRepositoryImpl::getInstance()->removeFollowerFrom($followerId, $followeeId);
    }

    public function follows(int $followerId, int $followeeId) :bool {
        FollowerRepositoryImpl::getInstance()->follows($followerId, $followeeId);
    }
    
    public function findAllFollowers(int $climberId) :array {
        FollowerRepositoryImpl::getInstance()->findAllFollowers($climberId);
    }

    public function findAllFollowees(int $climberId) :array {
        FollowerRepositoryImpl::getInstance()->findAllFollowees($climberId);
    }
}
?>