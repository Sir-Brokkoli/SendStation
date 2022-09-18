<?php namespace Sendstation\Sessions\Model;

require_once 'Classes/Database/IEntity.php';

use Sendstation\Database\IEntity;

/**
 * The entity representing the data of a go during a session.
 */
class Go implements IEntity {

    private $id;
    private $sessionId;
    private $routeId;
    private $falls;
    private $send;
    private $toprope;

    /**
     * Instanciates a new go.
     */
    public function __construct($id, $sessionId, $routeId, $falls, $send, $toprope){

        $this->id = $id;
        $this->sessionId = $sessionId;
        $this->routeId = $routeId;
        $this->falls = $falls;
        $this->send = $send;
        $this->toprope = $toprope;
    }

    public function getId(){
        return $this->id;
    }

    public function getSessionId(){
        return $this->sessionId;
    }

    public function getRouteId(){
        return $this->routeId;
    }

    public function getFalls(){
        return $this->falls;
    }

    public function setFalls($falls){
        $this->falls = $falls;
    }

    public function wasSent(){
        return $this->send;
    }

    public function setSend($value){
        $this->send = $value;
    }

    public function wasToproped(){
        return $this->toprope;
    }

    public function setToprope($value){
        $this->toprope = $value;
    }
}

?>