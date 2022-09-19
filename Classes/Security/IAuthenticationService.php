<?php namespace Sendstation\Security;

/**
 * Interface for an authentication service providing methods for 
 * authentication checking.
 */
interface IAuthenticationService {
    /**
     * Checks whether the logged in user has admin authorization.
     */
    public function checkForAdminAuthority() :bool;
    /**
     * Requires the logged in user to have admin authorization, throws
     * AuthenticationException if not the case.
     */
    public function requireAdminAuthority() :void;
    /**
     * Checks whether the logged in user has manager authorization.
     */
    public function checkForManagerAuthority() :bool;
    /**
     * Requires the logged in user to have manager authorization, throws
     * AuthenticationException if not the case.
     */
    public function requireManagerAuthority() :void;
    /**
     * Checks whether the logged user has the given id.
     */
    public function checkForLoggedUserId(int $userId) :bool;
    /**
     * Requires the logged user to have the given id, throws an
     * AuthenticationFailureException if not the case.
     */
    public function requireForLoggedUserId(int $userId) :void;
}

?>