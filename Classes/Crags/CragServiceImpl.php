<?php namespace Sendstation;

require_once 'Database.class.php';
require_once 'Classes/Crags/CragRepositoryImpl.php';
require_once 'Classes/Crags/RouteRepositoryImpl.php';
require_once 'Classes/Security/AuthenticationProvider.php';

use Sendstation\Database\Database;
use Sendstation\Crags\Model\Crag;
use Sendstation\Crags\CragRepositoryImpl;
use Sendstation\Crags\RouteRepositoryImpl;
use Sendstation\Security\AuthenticationProvider;

/**
 * Service for the management of the entities of the Crags component.
 */
class CragServiceImpl{
    
    /**
     * Returns an array of all crags registered.
     */
    public static function getCrags(){
        return CragRepositoryImpl::getInstance()->findAll();
    }

    /**
     * Returns the crag with the given id or null if none found.
     */
    public static function getCragById($cragId){
        return CragRepositoryImpl::getInstance()->findById($cragId);
    }

    /**
     * Returns all routes associated with th given crag.
     */
    public static function getRoutesInCrag($crag){
        return RouteRepositoryImpl::getInstance()->findByCrag($crag->getId());
    }

    /**
     * Registers the crag in the database, overrides if already registered.
     * 
     * Authority needed: Admin or Manager
     */
    public static function saveCrag($crag) :Crag {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->finishAuthentication();

        CragRepositoryImpl::getInstance()->save($crag);
        return $crag;
    }
}
?>