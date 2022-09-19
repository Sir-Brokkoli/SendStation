<?php namespace Sendstation\Security;

require_once 'IAuthenticationStage.php';

/**
 * Interface for a result of an authentication step. Allows to continue via 
 * and() and or() operation or finish authentication via finish().
 */
interface IAuthenticationResult {
    /**
     * Continue authentication if step before was successful.
     */
    public function and() :IAuthenticationStage;
    /**
     * Continue authentication.
     */
    public function or() :IAuthenticationStage;
    /**
     * Finish authentication.
     */
    public function finish() :void;
}

?>