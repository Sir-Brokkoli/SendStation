<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/SessionHandler.class.php');
include_once('Classes/Model/Go.class.php');
include_once('DEBUG/DEBUG.php');

use Sendstation\Debugging\DEBUG;

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    //Prepare
    $climberId = $_SESSION['id'];

    //Collect input data
    $falls = 0;
    if(key_exists('falls', $_POST)){
        $falls = is_numeric($_POST['falls']) ? (int)$_POST['falls'] : -1;
    }

    $toprope = false;
    if(key_exists('toprope', $_POST)){
        echo($_POST['toprope']);
        $toprope = $_POST['toprope'] == "on";
    }

    $send = false;
    if(key_exists('send', $_POST)){
        $send = $_POST['send'] == "on";
    }

    $routeId = -1;
    if(key_exists('id_route', $_POST)){
        $routeId = is_numeric($_POST['id_route']) ? (int)$_POST['id_route'] : -1;
    }
    else{
        DEBUG::Log("No post \"id_route\" recieved.");
    }

    // Register
    SessionHandler::openGateway();
    if(SessionHandler::registerGoFor($climberId, $routeId, $falls, $send, $toprope)){
        header("location: home.php");
    }
    else{
        // TODO: Implement response mechanism
    }
}

?>