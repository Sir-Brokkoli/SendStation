<?php namespace Sendstation;

require_once 'Classes/Sessions/Model/Session.php';
require_once 'Classes/Sessions/Model/Go.php';
require_once 'Classes/Sessions/SessionRepositoryImpl.php';
require_once 'Classes/Sessions/GoRepositoryImpl.php';
require_once 'Database.class.php';

use Sendstation\Database\Database;
use Sendstation\Sessions\Model\Session;
use Sendstation\Sessions\Model\Go;
use Sendstation\Sessions\SessionRepositoryImpl;
use Sendstation\Sessions\GoRepositoryImpl;

class SessionHandler {

    public static function openGateway(){
        // Deprecated
    }

    public static function getActiveSessionOf($climberId){
        return SessionRepositoryImpl::getInstance()->findActiveSessionByClimber($climberId);
    }

    public static function startActiveSession($climberId, $cragId, $isEco){
        $session = new Session(null,
                        $climberId, 
                        $cragId, 
                        date_create()->format('Y-m-d'), 
                        $isEco,
                        null, true);

        return SessionRepositoryImpl::getInstance()->save($session);
    }

    public static function finishActiveSession($session){
        if($session->isActive()) {
            $session->finish();
            return SessionRepositoryImpl::getInstance()->save($session);
        }
        return false;
    }

    public static function finishActiveSessionOf($climberId){
        if($session = self::getActiveSessionOf($climberId)){
            return self::finishActiveSession($session);
        }
        return false;
    }

    public static function discardActiveSession($session){
        try{
            // TODO: Transaction
            GoRepositoryImpl::getInstance()->deleteBySession($session->getId());
            SessionRepositoryImpl::getInstance()->delete($session);
        }
        catch (\mysql_sql_exception $e){
            Database::rollbackTransaction();
            return false;
        }

        return true;
    }

    public static function discardActiveSessionOf($climberId) {
        if($session = self::getActiveSessionOf($climberId)) {
            return self::discardActiveSession($session);
        }
        return false;
    }

    public static function registerSession($session) {
        return SessionRepositoryImpl::getInstance()->save($session);
    }

    public static function getGoesOfActiveSession($session) {
        return GoRepositoryImpl::getInstance()->findBySession($session->getId());
    }

    public static function getGoesOfSessionInRoute($session, $route) {
        return GoRepositoryImpl::getInstance()->findBySessionAndRoute($session->getId(), $route->getId());
    }

    public static function registerGoFor($climberId, $routeId, $falls, $send, $toprope) {
        if($session = self::getActiveSessionOf($climberId)){
            $go = new Go(null, $session->getId(), $routeId, $falls, $send, $toprope);
            return GoRepositoryImpl::getInstance()->save($go);
        }

        return false;
    }

    public static function routeSentBy($climberId, $route) {
        return GoRepositoryImpl::getInstance()->findSendGoByClimberAndRoute($climberId, $route->getId()) != null;
    }

    public static function routeTopropedBy($climberId, $route) {
        return GoRepositoryImpl::getInstance()->findTopropeSendGoByClimberAndRoute($climberId, $route->getId()) != null;
    }
}

?>