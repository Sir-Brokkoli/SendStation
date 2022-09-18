<?php namespace Sendstation;

use Sendstation\Crags\Model\Route;
use Sendstation\Database\Database;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Database.class.php');
include_once('Classes/Crags/Model/Route.php');

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
    }
    else {

        $route = new Route(null, null, null, null, null);
    }

    if (key_exists('name', $_POST)) {

        $route->setName($_POST['name']);
    }

    if (key_exists('description', $_POST)) {

        $route->setDescription($_POST['description']);
    }

    if (key_exists('grade', $_POST)) {

        $route->setGrade($_POST['grade']);
    }

    if (key_exists('cragId', $_POST) && \is_numeric($_POST['cragId']) && $route->getCragId() == null) {

        $route->setCragId(intval($_POST['cragId']));
    }

    // Register
    $routesGateway->saveEntry($route);

    header("location: cragsManager.php?id={$route->getCragId()}");
}

?>