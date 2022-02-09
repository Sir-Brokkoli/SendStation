<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing a climbing route.
 */
class Route implements ISerializable {
    
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