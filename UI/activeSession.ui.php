<?php namespace Sendstation;

use Sendstation\UI\ActiveSessionRouteCard;
use Sendstation\Database\ConnectionMysql;
use Sendstation\Database\Database;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

include_once 'Classes/Database.class.php';
include_once 'Classes/Model/Session.class.php';
require_once 'Classes/SessionHandler.class.php';
require_once 'Classes/CragHandler.class.php';
require_once 'Classes/UI/ActiveSessionRouteCard.class.php';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){

    $goesDataGateway = Database::getGoesDataGateway();

    $climberId = $_SESSION['id'];
    SessionHandler::openGateway();
    $session = SessionHandler::getActiveSessionOf($climberId);

    if($session != null && $session){

        $crag = CragHandler::getCragById($session->getCragId());

        echo "<div class=\"container\">";
        echo "<h4 class=\"card-text text-light\">{$crag->getName()}</h4>";
        
        $routes = CragHandler::getRoutesInCrag($crag);

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
        echo "<div class=\"container justify-items-between align-center\">";
        echo "<button class=\"btn btn-col2 text-light ml-5 my-2\" data-bs-toggle=\"modal\" data-bs-target=\"#finishSessionModal\"> Finish session</button>";
        echo "<button class=\"btn btn-secondary mx-1 my-2\" data-bs-toggle=\"modal\" data-bs-target=\"#delActiveSessionModal\"> Discard session</button>";
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