<?php
namespace Sendstation\Authentication;

require_once 'LoginHandler.class.php';
require_once 'UserServiceRequest.class.php';

class LoginRequest extends UserServiceRequest {

    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function execute() {
        LoginHandler::processRequest($this);
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPassword(){
        return $this->password;
    }
}

?>