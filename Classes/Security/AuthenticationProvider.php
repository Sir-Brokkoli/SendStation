<?php namespace Sendstation\Security;

require_once 'Classes/Security/Authentication.php';
require_once 'Classes/Security/IAuthenticationStage.php';
require_once 'Classes/Security/AuthenticationSuccess.php';
require_once 'Classes/Security/AuthenticationFailure.php';

/**
 * Allows to build authentication chains via the builder pattern.
 */
class AuthenticationProvider implements IAuthenticationStage {

    private function __construct() {
        // Builder
    }

    /** 
     * Start an authentication process.
     */
    public static function startAuthentication() :IAuthenticationStage {
        return new AuthenticationProvider();
    }

    /**
     * Requires the logged in user to have admin authorization, throws
     * AuthenticationException if not the case.
     */
    public function requireAdminAuthority() :IAuthenticationResult {
        return Authentication::getInstance()->checkForAdminAuthority() ? 
            new AuthenticationSuccess() :
            new AuthenticationFailure("admin");
    }

    /**
     * Requires the logged user to have the given id, throws an
     * AuthenticationFailureException if not the case.
     */
    public function requireLoggedUserWithId(int $userId) :IAuthenticationResult {
        return Authentication::getInstance()->checkForLoggedUserId($userId) ? 
            new AuthenticationSuccess() :
            new AuthenticationFailure("userId");
    }
}