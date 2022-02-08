<?php
namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

//
// TODO: Implement response in case of invalid input
//

require_once('Classes/SessionHandler.class.php');
include_once('DEBUG/DEBUG.php');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $climberId = $_SESSION['id'];
    /*
    ===== Pre Checks =====
    */

    //Is there already an active session registered?
    SessionHandler::openGateway();
    if(SessionHandler::getActiveSessionOf($climberId)){
        // TODO: Implement response mechanism
    }

    $cragId = -1;
    if(key_exists('crag', $_POST)){
        if(is_numeric($_POST['crag'])){
            $cragId = (int)$_POST['crag'];
        }
        else{
            // TODO: Implement response mechanism
        }
    }

    $eco = false;
    if(key_exists('eco', $_POST)){
        $eco = $_POST['eco'] == "on";
    }

    SessionHandler::startActiveSession($climberId, $cragId, $eco);
    
    header("location: home.php");
}

?>