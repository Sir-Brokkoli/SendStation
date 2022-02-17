<?php namespace Sendstation\Authentication;

include_once 'Classes/Database.class.php';

use Sendstation\Database\Database;

class AuthenticationService {

    public static function isAdminUser($username) {

        $userGateway = Database::getClimbersDataGateway();
        $user = $userGateway->findByUsername($username);

        return $user != null;
    }
}

?>