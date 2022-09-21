<?php
namespace Sendstation;

use Sendstation\Authentication\SignupRequest;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once('Classes/Authentication/SignupRequest.class.php');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // TODO: Implement Tocken mechanism
    $sanitizedUsername = "";
    $sanitizedEmail = "";
    $sanitizedPassword = "";

    if(key_exists('username', $_POST)){

        $sanitizedUsername = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    }

    if(key_exists('email', $_POST)){

        $sanitizedEmail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

        if(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {
            $sanitizedEmail = "";
        }
        
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
