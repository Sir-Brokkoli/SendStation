<?php namespace Sendstation;
ini_set ("display_errors", "1");
error_reporting(E_ALL);

//
// TODO: Implement response in case of invalid input
//

require_once('Classes/Sessions/SessionServiceImpl.php');
include_once('DEBUG/DEBUG.php');

use Sendstation\Sessions\SessionServiceImpl;

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $climberId = $_SESSION['id'];
    /*
    ===== Pre Checks =====
    */

    //Is there already an active session registered?
    SessionServiceImpl::openGateway();
    if(SessionServiceImpl::getActiveSessionOf($climberId)){
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

    SessionServiceImpl::startActiveSession($climberId, $cragId, $eco);
    
    header("location: home.php");
}

?>