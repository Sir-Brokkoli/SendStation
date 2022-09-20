<?php namespace Sendstation\Crags;

require_once 'Classes/Crags/Model/Crag.php';
require_once 'Classes/Crags/Model/Route.php';

use Sendstation\Crags\Model\Crag;
use Sendstation\Crags\Model\Route;

/**
 * Interface for a crags and routes management service.
 */
interface ICragService {
    /**
     * Returns an array of all crags registered.
     */
    public function getCrags() :array;
    /**
     * Returns the crag with the given id or null if none found.
     */
    public function getCragById(int $cragId) :?Crag;
    /**
     * Returns all routes associated with the given crag.
     */
    public function getRoutesInCrag(Crag $crag) :array;
    /**
     * Registers the given crag in the database, overrides if already registered.
     * 
     * Authority needed: Admin or Manager
     */
    public function saveCrag(Crag $crag) :Crag;
    /**
     * Registers the given route in the database, overrides if already registered.
     * 
     * Authority needed: Admin or Manager
     */
    public function saveRoute(Route $route) :Route;
    /**
     * Removes the given crag and all associated routes from the persisted context.
     * 
     * Authority needed: Admin or manager
     */
    public function deleteCrag(Crag $crag) :void;
    /**
     * Removes the given route from the persisted context.
     * 
     * Authority needed: Admin or manager
     */
    public function deleteRoute(Route $route) :void;
}

?>