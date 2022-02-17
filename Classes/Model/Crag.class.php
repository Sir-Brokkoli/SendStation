<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing a crag.
 */
class Crag implements ISerializable {

    private static $serializationScheme = ["id", "name", "description"];

    private $id;
    private $name;
    private $description;

    public function __construct($id, $name, $description){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function serialize() : array {

        return array(self::$serializationScheme[0] => $this->id, 
                    self::$serializationScheme[1] => $this->name, 
                    self::$serializationScheme[2] => $this->description);
    }

    public function deserialize(array $data) {

        $this->id = $data[self::$serializationScheme[0]];
        $this->name = $data[self::$serializationScheme[1]];
        $this->description = $data[self::$serializationScheme[2]];
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

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
}

?>