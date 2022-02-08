<?php
namespace Sendstation;

use Sendstation\Database\Database;
use Sendstation\Session;

require_once 'Session.class.php';
require_once 'Go.class.php';
require_once 'Database.class.php';

class SessionHandler {

    private static $sessionsDataGateway;
    private static $goesDataGateway;

    public static function openGateway(){

        self::$sessionsDataGateway = Database::getSessionsDataGateway();
        self::$goesDataGateway = Database::getGoesDataGateway();
    }

    public static function getActiveSessionOf($climberId){

        return self::$sessionsDataGateway->findActiveSession($climberId);
    }

    public static function startActiveSession($climberId, $cragId, $isEco){

        $session = new Session(null,
                            $climberId, 
                            $cragId, 
                            date_create()->format('Y-m-d'), 
                            $isEco,
                            null,
                            true);

        return self::$sessionsDataGateway->saveEntry($session);
    }

    public static function finishActiveSession($session){

        if($session->isActive()) {
            $session->finish();

            return self::$sessionsDataGateway->saveEntry($session);
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
            Database::beginTransaction();
            self::$goesDataGateway->deleteGoesInSession($session);
            self::$sessionsDataGateway->deleteEntry($session);
            Database::commitTransaction();
        }
        catch (\mysql_sql_exception $e){
            Database::rollbackTransaction();
            return false;
        }

        return true;
    }

    public static function discardActiveSessionOf($climberId){

        if($session = self::getActiveSessionOf($climberId)) {
            return self::discardActiveSession($session);
        }

        return false;
    }

    public static function registerSession($session){

        return self::$sessionsDataGateway->saveEntry($session);
    }

    public static function getGoesOfActiveSession($session){

        return self::$goesDataGateway->findGoesInSession($session);
    }

    public static function getGoesOfSessionInRoute($session, $route){
        $gateway = Database::getGoesDataGateway();
        return $gateway->findGoesOfSessionInRoute($session, $route);
    }

    public static function registerGoFor($climberId, $routeId, $falls, $send, $toprope){

        if($session = self::getActiveSessionOf($climberId)){
            $go = new Go(null, $session->getId(), $routeId, $falls, $send, $toprope);
            return self::$goesDataGateway->saveEntry($go);
        }

        return false;
    }

    public static function routeSentBy($climberId, $route){
        
        $gateway = Database::getGoesDataGateway();
        return $gateway->findSendGo($climberId, $route);
    }

    public static function routeTopropedBy($climberId, $route){
        $gateway = Database::getGoesDataGateway();
        return $gateway->findTopropeGo($climberId, $route);
    }

}

?>