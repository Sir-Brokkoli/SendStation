<?php
namespace Sendstation\UI;

class ActiveSessionContainer extends Container{

    public function __construct($climberId){

        $this->headerHTML = "";
        $this->footerHTML = "";

        $cragsDataGateway = Database::getCragsDataGateway();
        $routesDataGateway = Database::getRoutesDataGateway();
        $goesDataGateway = Database::getGoesDataGateway();
    }
}

?>