<?php
namespace Sendstation\Authentication;

require_once 'UserServiceRequest.class.php';

class LogoutRequest extends UserServiceRequest {

    public function execute() {
        session_start();
        session_unset();
    }
}
?>