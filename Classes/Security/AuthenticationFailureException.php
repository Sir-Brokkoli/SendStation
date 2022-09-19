<?php namespace Sendstation\Security;

/**
 * Thrown if the authentication process failed due to lack of
 * authority.
 */
class AuthenticationFailureException extends Exception {

    public function __construct(private string $required) { }

    public function getRequiredAuthorization() :string {
        return $this->required;
    }
}

?>