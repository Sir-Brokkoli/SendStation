<?php namespace Sendstation;

require_once 'Database.class.php';

use Sendstation\Database\Database;

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