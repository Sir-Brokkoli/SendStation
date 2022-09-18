<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Crags/RouteRepositoryImpl.php');
include_once('Classes/Crags/Model/Route.php');

use Sendstation\Crags\Model\Route;
use Sendstation\Crags\RouteRepositoryImpl;

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $repository = RouteRepositoryImpl::getInstance();

    //Authentication
    //$climberId = $_SESSION['id'];

    //Fetch input data
    $route;
    if (key_exists('id', $_POST) && \is_numeric($_POST['id']) && $route = $repository->findById(intval($_POST['id']))) {
        $repository->delete($route);
    }

    header("location: cragsManager.php?{$route->getCragId()}");
}

?>