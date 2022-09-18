<?php
namespace Sendstation\Authentication;

require_once 'Classes/Users/ClimberRepositoryImpl.php';
require_once 'IUserServiceRequestHandler.class.php';

use Sendstation\Users\ClimberRepositoryImpl;

class LoginHandler implements IUserServiceRequestHandler {

    public static function processRequest($request){

        $userDataGateway = ClimberRepositoryImpl::getInstance();

        $user = $userDataGateway->findByEmail($request->getEmail());

        if(password_verify($request->getPassword(), $user->getPasswordHash())){
            \session_reset();
            
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->getId();
            $_SESSION["nickname"] = $user->getNickname();
        }
    }

    public static function isLoggedUser($id) {

        \session_start();

        return \key_exists('id', $_SESSION) && $_SESSION['id'] == $id;
    }
}

?>