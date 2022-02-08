<?php
namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/SessionHandler.class.php');

session_start();

if(isset($_SESSION['id'])){

    $climberId = $_SESSION['id'];

    SessionHandler::openGateway();
    SessionHandler::finishActiveSessionOf($climberId);

    header("location: home.php");
}

/*
//Check whether logged in
if(isset($_SESSION['id'])){
    //Get active session data
    if($activeSessionData = ConnectionMysql::getDataFromTable(DT_ACTIVESESSIONS, "id, id_crag, is_eco", "id_climber = ?", "", $_SESSION['id'])){
        if($activeSessionData->num_rows > 0){
            $activeSession = $activeSessionData->fetch_assoc();
            
            //Get routes data
            $conn = ConnectionMysql::getInstance();

            DEBUG::Log("Start transaction");

            $conn->begin_transaction();

            try{
                $sql = "SELECT DISTINCT id_route FROM " . DT_GOES . " WHERE id_session = " . $activeSession['id'];
                $routesData = $conn->query($sql);

                DEBUG::Log("Routes fetched");

                if(!($routesData->num_rows > 0)){
                    throw new NoRoutesEnteredException();
                }
                DEBUG::Log("Generate new session.");
                
                //Generate a new session in database.
                $sql = "INSERT INTO " . DT_SESSIONS . " (id_climber, id_crag, is_eco) VALUES (?, ?, " . ($activeSession['is_eco'] ? "TRUE" : "FALSE") . ")";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $_SESSION['id'], $activeSession['id_crag']);
                $stmt->execute();
                $sessionId = $stmt->insert_id;

                DEBUG::Log("Session generated");

                //Register the routes for the session
                while($route = $routesData->fetch_assoc()){
                    $totalGoes = 0;
                    $totalFalls = 0;
                    $wasSent = false;
                    $wasToproped = false;

                    //Get goes data
                    $sql = "SELECT falls, send, toprope FROM " . DT_GOES . " WHERE id_session = " . $activeSession['id'] . " AND id_route = " . $route['id_route'];
                    DEBUG::Log($sql);
                    $goesData = $conn->query($sql);
                    $totalGoes = $goesData->num_rows;

                    DEBUG::Log("Goes data fetched");

                    while($go = $goesData->fetch_assoc()){
                        $totalFalls += $go['falls'];
                        $wasToproped |= $go['toprope'];
                        $wasSent |= $go['send'];
                    }

                    if($totalGoes > 0){
                        DEBUG::Log("Start insertion");
                        $sql = "INSERT INTO " . DT_REL_SESSION_ROUTE . " (id_session, id_route, goes, falls, send, toprope) VALUES (?, ?, ?, ?, " .
                                ($wasSent ? "TRUE" : "FALSE") . ", " . ($wasToproped ? "TRUE" : "FALSE") . ")";

                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iiii", $param_id, $route['id_route'], $totalGoes, $totalFalls);
                        $param_id = $sessionId;

                        $stmt->execute();
                        DEBUG::Log("Insertion finished");
                    }

                    //Delete Goes Data
                    $sql = "DELETE FROM " . DT_GOES . " WHERE id_session = " . $activeSession['id'] . " AND id_route = " . $route['id_route']; 
                    $conn->query($sql);

                    DEBUG::Log("Goes data deleted");
                }

                //Delete active session
                $sql = "DELETE FROM " . DT_ACTIVESESSIONS . " WHERE id = " . $activeSession['id'];
                $conn->query($sql);

                $conn->commit();

                header("location: home.php");
            }
            catch(mysql_sql_exception $exception){
                $conn->rollback();
                DEBUG::Log("Failed transaction!");
            }
            catch(NoRoutesEnteredException $exception){
                $conn->rollback();
                DEBUG::Log("No routes registered!");
            }
        }
        else{
            //No active sessions listed.

        }
    }
}
else{
    DEBUG::Log("Connection to database failed.");
}
*/
?>