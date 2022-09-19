<?php namespace Sendstation\Security;

require_once 'IAuthenticationResult.php';
require_once 'AuthenticationProvider.php';

/**
 * Response for a failed authentication step.
 */
class AuthenticationFailure implements IAuthenticationResult {

    public function __construct(private $failedAuthentication) { }

    /**
     * Throw failure.
     */
    public function and() :IAuthenticationStage {
        throw new AuthenticationFailureException($this->failedAuthentication);
    }

    /**
     * Continue authentication.
     */
    public function or() :IAuthenticationStage {
        return AuthenticationProvider::startAuthentication();
    }

    /**
     * Throw failure.
     */
    public function finish() :void {
        throw new AuthenticationFailureException($this->failedAuthentication);
    }
}

?>