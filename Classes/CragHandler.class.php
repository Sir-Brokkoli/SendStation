<?php
namespace Sendstation;

use Sendstation\Database\Database;

require_once 'Crag.class.php';
require_once 'Route.class.php';
require_once 'Database.class.php';

class CragHandler{
    
    public static function getCrags(){

        $gateway = Database::getCragsDataGateway();
        $crags = $gateway->findAll();
        return $crags;
    }

    public static function getCragById($cragId){

        $gateway = Database::getCragsDataGateway();
        $crag = $gateway->findEntryById($cragId);
        return $crag;
    }

    public static function getRoutesInCrag($crag){

        $gateway = Database::getRoutesDataGateway();
        $routes = $gateway->findRoutesInCrag($crag->getId());
        return $routes;
    }
}

?>