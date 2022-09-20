<?php namespace Sendstation;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Crags/CragServiceImpl.php');
include_once('Classes/Crags/Model/Route.php');

use Sendstation\Crags\Model\Route;
use Sendstation\Crags\CragServiceImpl;

session_start();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    if (key_exists('id', $_POST) && \is_numeric($_POST['id']) 
        && $route = CragServiceImpl::getInstance()->getRouteById(intval($_POST['id']))) {

        CragServiceImpl::getInstance()->deleteRoute($route);
        var_dump($route);
    }

    header("location: cragsManager.php?{$route->getCragId()}");
}

?>