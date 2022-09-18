<?php namespace Sendstation\Crags\Model;

require_once 'Classes/Database/IEntity.php';

use Sendstation\Database\IEntity;

/**
 * The entity representing a crag.
 */
class Crag implements IEntity {

    private $id;
    private $name;
    private $description;

    public function __construct($id, $name, $description){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
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