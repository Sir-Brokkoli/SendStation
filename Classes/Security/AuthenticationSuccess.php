<?php namespace Sendstation\Security;

require_once 'IAuthenticationResult.php';
require_once 'AuthenticationProvider.php';

/**
 * Response for an successful authentication step.
 */
class AuthenticationSuccess implements IAuthenticationResult {

    /**
     * Continue authentication.
     */
    public function and() :IAuthenticationStage {
        return AuthenticationProvider::startAuthentication();
    }

    /**
     * Continue authentication.
     */
    public function or() :IAuthenticationStage {
        return AuthenticationProvider::startAuthentication();
    }

    /**
     * Finish authentication.
     */
    public function finish() {
        // Nothing to do, successful authentication
    }
}

?>