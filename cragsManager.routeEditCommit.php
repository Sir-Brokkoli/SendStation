<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Crags/CragServiceImpl.php');
include_once('Classes/Crags/Model/Route.php');

use Sendstation\Crags\Model\Route;
use Sendstation\Crags\CragServiceImpl;

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $route = null;
    if (!key_exists('id', $_POST) || !\is_numeric($_POST['id']) 
        || !$route = CragServiceImpl::getInstance()->getRouteById(intval($_POST['id']))) {

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

    CragServiceImpl::getInstance()->saveRoute($route);

    header("location: cragsManager.php?id={$route->getCragId()}");
}

?>