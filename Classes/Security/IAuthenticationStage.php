<?php namespace Sendstation\Security;

require_once 'IAuthenticationResult.php';

/**
 * Interface for authentication steps provider.
 */
interface IAuthenticationStage {
    /**
     * Requires the logged in user to have admin authorization, throws
     * AuthenticationException if not the case.
     */
    public function requireAdminAuthority() :IAuthenticationResult;
    /**
     * Requires the logged user to have the given id, throws an
     * AuthenticationFailureException if not the case.
     */
    public function requireLoggedUserWithId(int $userId) :IAuthenticationResult;
}
?>