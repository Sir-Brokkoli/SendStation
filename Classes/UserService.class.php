<?php
namespace Sendstation\Authentication;

require_once 'LoginRequest.class.php';
require_once 'LogoutRequest.class.php';
require_once 'SignupRequest.class.php';

class UserService {

    public static function requestLogin($email, $password) {
        $request = new LoginRequest($email, $password);
        $request->execute();
    }

    public static function requestLogout() {
        $request = new LogoutRequest();
        $request->execute();
    }

    public static function requestSignUp($nickname, $email, $password) {
        $request = new SignupRequest($nickname, $email, $password);
        $request->execute();
    }
}

?>