<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing a climbing session.
 */
class Session implements ISerializable {

    private static $serializationScheme = ["id", "id_climber", "id_crag", "date", "is_eco", "reg_date", "is_active"];

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

    public function serialize() : array {

        return array(self::$serializationScheme[0] => $this->id,
                    self::$serializationScheme[1] => $this->climberId,
                    self::$serializationScheme[2] => $this->cragId,
                    self::$serializationScheme[3] => $this->date,
                    self::$serializationScheme[4] => $this->isEco,
                    self::$serializationScheme[5] => $this->registrationDate,
                    self::$serializationScheme[6] => $this->isActive);
    }

    public function deserialize(array $data) {

        $this->id = $data[self::$serializationScheme[0]];
        $this->climberId = $data[self::$serializationScheme[1]];
        $this->cragId = $data[self::$serializationScheme[2]];
        $this->date = $data[self::$serializationScheme[3]];
        $this->isEco = $data[self::$serializationScheme[4]];
        $this->registrationDate = $data[self::$serializationScheme[5]];
        $this->isActive = $data[self::$serializationScheme[6]];
    }

    public static function getSerializationScheme() : array {

        return self::$serializationScheme;
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