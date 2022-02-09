<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing the data of a go during a session.
 */
class Go implements ISerializable {

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

    public function serialize() : array {

        // TODO: Implementation
        return array();
    }

    public function deserialize(array $data) {

        // TODO: Implementation
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