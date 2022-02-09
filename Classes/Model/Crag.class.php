<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing a crag.
 */
class Crag implements ISerializable {

    private $id;
    private $name;
    private $description;

    public function __construct($id, $name, $description){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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