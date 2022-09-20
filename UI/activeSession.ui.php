<?php namespace Sendstation;

use Sendstation\UI\ActiveSessionRouteCard;
use Sendstation\Database\ConnectionMysql;
use Sendstation\Database\Database;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/Database.class.php';
include_once 'Classes/Sessions/Model/Session.php';
require_once 'Classes/SessionHandler.class.php';
require_once 'Classes/Crags/CragServiceImpl.php';
require_once 'Classes/UI/ActiveSessionRouteCard.class.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
    $climberId = $_SESSION['id'];
    SessionHandler::openGateway();
    $session = SessionHandler::getActiveSessionOf($climberId);

    if($session != null && $session){

        $crag = CragServiceImpl::getCragById($session->getCragId());

        echo "<div>";
        echo "<div class=\"row g-2 align-items-center justify-content-between text-center\">";
        echo "<div class=\"col-md-6 h4 card-text text-light\">{$crag->getName()}</div>";
        echo "<div class=\"col-md-6\"><button class=\"btn btn-col2 text-light my-2 mx-3\" data-bs-toggle=\"modal\" data-bs-target=\"#finishSessionModal\"> Finish session</button>";
        echo "<button class=\"btn btn-secondary my-2 mx-3\" data-bs-toggle=\"modal\" data-bs-target=\"#delActiveSessionModal\"> Discard session</button></div>";
        echo "</div>";
        
        $routes = CragServiceImpl::getRoutesInCrag($crag);

        foreach($routes as $route){
            $numGoes = 0;
            $wasSent = SessionHandler::routeSentBy($climberId, $route);
            $wasToproped = SessionHandler::routeTopropedBy($climberId, $route);

            //Fetch goes data
            if($goes = SessionHandler::getGoesOfSessionInRoute($session, $route)){
                $numGoes = count($goes);
            }

            $routeCard = new ActiveSessionRouteCard($route, $numGoes, $wasSent, $wasToproped);    
            
            $routeCard->draw();
        }

        echo "</div>";
    }
    else{
        //No active sessions, want to start one?
        echo "<p class=\"card-text text-light\"> There is currently no active session registered. Do you want to open a new one? </p>";
        echo "<button class=\"btn btn-lg btn-col2 text-light\" data-bs-toggle=\"modal\" data-bs-target=\"#startSessionModal\">Start a session!</button>";
    }
}
else{
    echo "Error: You are not logged in! Log in to continue.";
}

?>