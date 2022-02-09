<?php namespace Sendstation\Model;

/**
 * The entity representing an active session.
 * 
 * @deprecated Introduced a boolean isActive in the Session entity instead.
 */
class ActiveSession {

    private $id;
    private $climberId;
    private $cragId;
    private $isEco;
    private $registrationDate;

    public function __construct($id, $climberId, $cragId, $isEco, $registrationDate){

        if($id) { 
            
            $this->id = $id; 
        }

        setClimberId($climberId);
        setCragId($cragId);
        setEco($isEco);

        $this->registrationDate = $registrationDate;
    }

    public function getId(){
        return $this->id;
    }

    public function getClimberId(){
        return $this->climberId;
    }

    public function getCragId(){
        return $this->cragId;
    }

    public function setCragId($cragId){
        $this->cragId = $cragId;
    }

    public function isEco(){
        return $this->isEco;
    }

    public function setEco($value){
        $this->isEco = $value;
    }

    public function getRegistrationDate(){
        return $this->registrationDate;
    }
}

?>