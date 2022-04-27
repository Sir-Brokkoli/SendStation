<?php namespace Sendstation\Authentication;

require_once 'Classes/Database.class.php';
require_once 'IUserServiceRequestHandler.class.php';
require_once 'LoginHandler.class.php';
require_once 'SignupValidationResponse.class.php';

use Sendstation\Database\Database;

use Sendstation\Model\Climber;

class SignupHandler implements IUserServiceRequestHandler {

    public static function processRequest($request){

        $response = new SignupValidationResponse();
        
        $userDataGateway = Database::getClimbersDataGateway();

        if($userDataGateway->findByEmail($request->getEmail()) != null){
            
            $response->setEmailTaken();
        }
        
        if($userDataGateway->findByUsername($request->getUsername()) != null){
            
            $response->setUsernameTaken();
        }

        if($response->isEmailValid() && $response->isUsernameValid()) {

            $passwordHash = password_hash($request->getPassword(), PASSWORD_DEFAULT);
            $user = new Climber(null, $request->getUsername(), $request->getEmail(), $passwordHash, null);

            if($userDataGateway->saveEntry($user)) {

                LoginHandler::processRequest($request);

                $response->setSuccess();
            }
        }

        return $response;
    }
}

?>