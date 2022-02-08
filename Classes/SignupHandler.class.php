<?php
namespace Sendstation\Authentication;

use Sendstation\Database\Database;
use Sendstation\Climber;

require_once 'Database.class.php';
require_once 'IUserServiceRequestHandler.class.php';
require_once 'LoginHandler.class.php';

class SignupHandler implements IUserServiceRequestHandler {

    public static function processRequest($request){
        
        $userDataGateway = Database::getClimbersDataGateway();
        echo "HERE!";
        if($userDataGateway->findByEmail($request->getEmail()) != null){
            // TODO: Implement Email-already-taken response
            return false;
        }
        
        if($userDataGateway->findByUsername($request->getUsername()) != null){
            // TODO: Implement Username-already-taken response
            return false;
        }

        $passwordHash = password_hash($request->getPassword(), PASSWORD_DEFAULT);
        $user = new Climber(null, $request->getUsername(), $request->getEmail(), $passwordHash, null);

        if($userDataGateway->saveEntry($user)) {

            LoginHandler::processRequest($request);
        }
    }
}

?>