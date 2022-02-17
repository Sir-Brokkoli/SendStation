<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing a climbing route.
 */
class Route implements ISerializable {

    private static $serializationScheme = ["id", "id_crag", "name", "grade", "description"];
    
    private $id;
    private $name;
    private $cragId;
    private $grade;
    private $description;

    public function __construct($id, $name, $cragId, $grade, $description){
        $this->id = $id;
        $this->name = $name;
        $this->cragId = $cragId;
        $this->grade = $grade;
        $this->description = $description;
    }

    public function serialize() : array {

        return array(self::$serializationScheme[0] => $this->id,
                    self::$serializationScheme[1] => $this->cragId,
                    self::$serializationScheme[2] => $this->name,
                    self::$serializationScheme[3] => $this->grade,
                    self::$serializationScheme[4] => $this->description);
    }

    public function deserialize(array $data) {

        $this->id = $data[self::$serializationScheme[0]];
        $this->cragId = $data[self::$serializationScheme[1]];
        $this->name = $data[self::$serializationScheme[2]];
        $this->grade = $data[self::$serializationScheme[3]];
        $this->description = $data[self::$serializationScheme[4]];
    }

    public static function getSerializationScheme() : array {

        return self::$serializationScheme;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getCragId(){
        return $this->cragId;
    }

    public function setCragId($cragId){
        $this->cragId = $cragId;
    }

    public function getGrade(){
        return $this->grade;
    }

    public function setGrade($grade){
        $this->grade = $grade;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
}

?>