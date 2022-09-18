<?php namespace Sendstation;

require_once 'Database.class.php';
require_once 'Classes/Crags/CragRepositoryImpl.php';

use Sendstation\Database\Database;
use Sendstation\Crags\CragRepositoryImpl;

class CragHandler{
    
    public static function getCrags(){
        return CragRepositoryImpl::getInstance()->findAll();
    }

    public static function getCragById($cragId){
        return CragRepositoryImpl::getInstance()->findById($cragId);
    }

    public static function getRoutesInCrag($crag){
        $gateway = Database::getRoutesDataGateway();
        return $gateway->findRoutesInCrag($crag->getId());
    }
}

?>