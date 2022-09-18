<?php namespace Sendstation;

require_once 'Database.class.php';
require_once 'Classes/Crags/CragRepositoryImpl.php';
require_once 'Classes/Crags/RouteRepositoryImpl.php';

use Sendstation\Database\Database;
use Sendstation\Crags\CragRepositoryImpl;
use Sendstation\Crags\RouteRepositoryImpl;

class CragHandler{
    
    public static function getCrags(){
        return CragRepositoryImpl::getInstance()->findAll();
    }

    public static function getCragById($cragId){
        return CragRepositoryImpl::getInstance()->findById($cragId);
    }

    public static function getRoutesInCrag($crag){
        return RouteRepositoryImpl::getInstance()->findByCrag($crag->getId());
    }
}
?>