<?php namespace Sendstation;

use Sendstation\Model\Route;
use Sendstation\Database\Database;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Database.class.php');
include_once('Classes/Model/Route.class.php');

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $routesGateway = Database::getRoutesDataGateway();

    //Authentication
    //$climberId = $_SESSION['id'];

    //Fetch input data
    $route;
    if (key_exists('id', $_POST) && \is_numeric($_POST['id']) && $data = $routesGateway->findEntryById(intval($_POST['id']))) {

        $data = $data->fetch_assoc();
        $route = new Route($data['id'], $data['name'], $data['id_crag'], $data['grade'], $data['description']);

        $routesGateway->deleteEntry($route);
    }

    header("location: cragsManager.php?{$route->getCragId()}");
}

?>