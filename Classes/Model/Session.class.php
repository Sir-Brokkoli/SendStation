<?php namespace Sendstation\Model;

/**
 * The entity representing a climbing session.
 */
class Session {

    private $id;
    private $climberId;
    private $cragId;
    private $date;
    private $isEco;
    private $registrationDate;

    private $isActive;

    /**
     * Instanciates a new session object.
     */    
    public function __construct($id, $climberId, $cragId, $date, $isEco, $registrationDate, $isActive){

        if($id) {

            $this->id = $id;
        }
            
        $this->climberId = $climberId;
        $this->cragId = $cragId;
        $this->date = $date;
        $this->isEco = $isEco;
        $this->registrationDate = $registrationDate;
        $this->isActive = $isActive;
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

    public function getDate(){
        return $this->date;
    }

    public function setDate($date){
        $this->date = $date;
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

    public function isActive(){
        return $this->isActive;
    }

    public function finish(){
        $this->isActive = false;
    }
}

?>