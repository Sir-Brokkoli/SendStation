<?php
namespace Sendstation;

use Sendstation\Authentication\UserService;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/UserService.class.php');

session_start();

$email = $password = "";
$email_err = $password_err = $login_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST['email']))){
        $email_err = "Please enter e-mail adress.";
    } else {
        $email = trim($_POST['email']);
    }

    if(empty(trim($_POST['password']))){
        $password_err = "Please enter password.";
    } else {
        $password = trim($_POST['password']);
    }

    if(empty($email_err) && empty($password_err)){
        $success = UserService::requestLogin($email, $password);
    }

    echo $email_err . "</br>" . $password_err . "</br>" . $login_err;

    header("location: home.php");
}
?>