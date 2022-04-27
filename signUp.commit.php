<?php
namespace Sendstation;

use Sendstation\Database\Database;
use Sendstation\Authentication\SignupRequest;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Database.class.php');
include_once('Classes/Authentication/SignupRequest.class.php');
include_once('DEBUG/DEBUG.php');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // TODO: Implement Tocken mechanism
    $sanitizedUsername = "";
    $sanitizedEmail = "";
    $sanitizedPassword = "";

    if(key_exists('username', $_POST)){

        $sanitizedUsername = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    else{
        DEBUG::Log("...No Username entered</br>");
    }

    if(key_exists('email', $_POST)){

        $sanitizedEmail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

        if(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            $sanitizedEmail = "";
            DEBUG::Log("...No valid email adress</br>");
        }
        
    }
    else{
        DEBUG::Log("...No email entered</br>");
    }

    if(key_exists('password', $_POST)){
        $sanitizedPassword = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    }

    if(empty($sanitizedUsername) || empty($sanitizedEmail) || empty($sanitizedPassword)){
        echo "Fail";
        // TODO: Implement response mechanism
        die();
    }
    $signupRequest = new SignupRequest($sanitizedUsername, $sanitizedEmail, $sanitizedPassword);
    $signupRequest->execute();

    header("location: home.php");
}
?>
