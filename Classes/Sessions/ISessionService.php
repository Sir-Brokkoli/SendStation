<?php namespace Sendstation\Sessions;

/**
 * Interface for a service handling sessions and goes.
 */
interface ISessionService {
    /**
     * Returns the current active session of the climber with the given id or
     * null if no active session found.
     * 
     * Authority needed: Logged with given id.
     */
    public function getActiveSessionOf(int $climberId) :?Session;
    /**
     * Starts a new active session for the climber with the given id in the 
     * crag with given id and returns the persisted instance.
     * 
     * Authority needed: Logged with given id.
     * 
     * Throws: Exception if there already is an active session.
     */
    public function startActiveSession(int $climberId, int $cragId, bool $isEco) :Session;
    /**
     * Finishes the given session.
     * 
     * Authority needed: Admin or logged with $session->climberId.
     * 
     * Throws: Exception if session was already closed.
     */
    public function finishActiveSession(Session $session) :void;
    /**
     * Finishes the current active session of the climber with given id.
     * 
     * Authority needed: Admin or logged with given id.
     */
    public function finishActiveSessionOf(int $climberId) :void;
    /**
     * Deletes the given session if it is active.
     * 
     * Authority needed: Logged with $session->climberId.
     * 
     * Throws: Exception if session is not active.
     */
    public function discardActiveSession(Session $session) :void;
    /**
     * Deletes the current active session of the climber with given id.
     * 
     * Authority needed: Logged with given id.
     * 
     * Throws: Exception if no active session registered.
     */
    public function discardActiveSessionOf(int $climberId) :void;
    /**
     * Registers the given session.
     * 
     * Authority needed: Logged with $session->climberId.
     */
    public function registerSession(Session $session) :void;
    /**
     * Returns an array of all goes in the given session.
     * 
     * Authority needed: Logged with $session->climberId.
     */
    public function getGoesOfActiveSession(Session $session) :array;
    /**
     * Returns an array of all goes in the given session and route.
     * 
     * Authority needed: Logged with $session->climberId.
     */
    public function getGoesOfSessionInRoute(Session $session, Route $route) :array;
    /**
     * Registers a go for the climber with the given id in the 
     * route with given id.
     * 
     * Authority needed: Logged with given id.
     * 
     * Throws: Exception if no active session registered.
     */
    public function registerGoFor(int $climberId, int $routeId, int $falls, bool $send, bool $toprope) :void;
    /**
     * Checks whether the climber with the given id had a send go in
     * the given route.
     */
    public function routeSentBy(int $climberId, Route $route) :bool;
    /**
     * Checks whether the climber with the given id had a toprope send 
     * go in the given route.
     */
    public function routeTopropedBy(int $climberId, Route $route) :bool;
}

?>
