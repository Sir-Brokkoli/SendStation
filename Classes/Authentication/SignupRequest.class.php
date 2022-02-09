<?php
namespace Sendstation\Authentication;

require_once 'SignupHandler.class.php';
require_once 'UserServiceRequest.class.php';

class SignupRequest extends UserServiceRequest {

    private $username;
    private $email;
    private $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    public function execute() {
        SignupHandler::processRequest($this);
    }

    public function getUsername(){
        return $this->username;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }
}

?>