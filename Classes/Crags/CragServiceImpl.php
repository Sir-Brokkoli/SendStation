<?php namespace Sendstation\Crags;

require_once 'Classes/Crags/CragRepositoryImpl.php';
require_once 'Classes/Crags/RouteRepositoryImpl.php';
require_once 'Classes/Security/AuthenticationProvider.php';

use Sendstation\Crags\Model\Crag;
use Sendstation\Crags\Model\Route;
use Sendstation\Crags\CragRepositoryImpl;
use Sendstation\Crags\RouteRepositoryImpl;
use Sendstation\Security\AuthenticationProvider;

/**
 * Service for the management of the entities of the Crags component.
 */
class CragServiceImpl{

    private static $instance;

    private function __construct() {
        // Singleton
    }

    /**
     * Returns the singleton instance of the service and instanciates 
     * it if needed.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new CragServiceImpl();
        }
        return self::$instance;
    }
    
    /**
     * Returns an array of all crags registered.
     */
    public function getCrags() :array{
        return CragRepositoryImpl::getInstance()->findAll();
    }

    /**
     * Returns the crag with the given id or null if none found.
     */
    public function getCragById(int $cragId) :?Crag{
        return CragRepositoryImpl::getInstance()->findById($cragId);
    }

    /**
     * Returns the route with the given id or null if none found.
     */
    public function getRouteById(int $routeId) :?Route {
        return RouteRepositoryImpl::getInstance()->findById($routeId);
    }

    /**
     * Returns all routes associated with the given crag.
     */
    public function getRoutesInCrag(Crag $crag) :array {
        return RouteRepositoryImpl::getInstance()->findByCrag($crag->getId());
    }

    /**
     * Registers the given crag in the database, overrides if already registered.
     * 
     * Authority needed: Admin or Manager
     */
    public function saveCrag($crag) :Crag {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->finishAuthentication();

        CragRepositoryImpl::getInstance()->save($crag);
        return $crag;
    }

    /**
     * Registers the given route in the database, overrides if already registered.
     * 
     * Authority needed: Admin or Manager
     */
    public function saveRoute(Route $route) :Route {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->finishAuthentication();

        RouteRepositoryImpl::getInstance()->save($route);
        return $route;
    }

    /**
     * Removes the given crag and all associated routes from the persisted context.
     * 
     * Authority needed: Admin or manager
     */
    public function deleteCrag(Crag $crag) :void {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->finishAuthentication();

        CragRepositoryImpl::getInstance()->delete($crag);
    }

    /**
     * Removes the given route from the persisted context.
     * 
     * Authority needed: Admin or manager
     */
    public function deleteRoute(Route $route) :void {
        AuthenticationProvider::startAuthentication()
            ->requireAdminAuthority()
            ->finishAuthentication();

        RouteRepositoryImpl::getInstance()->delete($route);
    }
}
?>