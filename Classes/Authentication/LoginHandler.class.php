<?php
namespace Sendstation\Authentication;

use Sendstation\Database\Database;

require_once 'Classes/Database.class.php';
require_once 'IUserServiceRequestHandler.class.php';

class LoginHandler implements IUserServiceRequestHandler {

    public static function processRequest($request){

        $userDataGateway = Database::getClimbersDataGateway();

        $user = $userDataGateway->findByEmail($request->getEmail());

        if(password_verify($request->getPassword(), $user->getPasswordHash())){
            session_reset();
            
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $user->getId();
            $_SESSION["nickname"] = $user->getNickname();
        }
    }
}

?>