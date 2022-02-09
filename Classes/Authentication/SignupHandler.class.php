<?php namespace Sendstation\Authentication;

require_once 'Classes/Database.class.php';
require_once 'IUserServiceRequestHandler.class.php';
require_once 'LoginHandler.class.php';

use Sendstation\Database\Database;
use Sendstation\Model\Climber;

class SignupHandler implements IUserServiceRequestHandler {

    public static function processRequest($request){
        
        $userDataGateway = Database::getClimbersDataGateway();

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