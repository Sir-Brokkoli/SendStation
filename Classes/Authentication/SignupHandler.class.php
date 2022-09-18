<?php namespace Sendstation\Authentication;

require_once 'Classes/Users/ClimberRepositoryImpl.php';
require_once 'Classes/Users/Model/Climber.php';
require_once 'IUserServiceRequestHandler.class.php';
require_once 'LoginHandler.class.php';
require_once 'LoginRequest.class.php';
require_once 'SignupValidationResponse.class.php';

use Sendstation\Users\ClimberRepositoryImpl;
use Sendstation\Users\Model\Climber;

class SignupHandler implements IUserServiceRequestHandler {

    public static function processRequest($request){
        $response = new SignupValidationResponse();
        $userDataGateway = ClimberRepositoryImpl::getInstance();

        if($userDataGateway->findByEmail($request->getEmail()) != null){
            $response->setEmailTaken();
        }
        
        if($userDataGateway->findByUsername($request->getUsername()) != null){
            $response->setUsernameTaken();
        }

        if($response->isEmailValid() && $response->isUsernameValid()) {
            $passwordHash = password_hash($request->getPassword(), PASSWORD_DEFAULT);
            $user = new Climber(null, $request->getUsername(), $request->getEmail(), $passwordHash, null);

            if($userDataGateway->insert($user)) {
                LoginHandler::processRequest($request);
                $response->setSuccess();
            }
        }

        return $response;
    }
}

?>