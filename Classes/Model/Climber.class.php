<?php namespace Sendstation\Model;

include_once 'Classes/Database/ISerializable.class.php';

use Sendstation\Database\ISerializable;

/**
 * The entity representing a climber registered in the competition.
 */
class Climber implements ISerializable {

    private $id;
    private $nickname;
    private $email;
    private $passwordHash;
    private $registrationDate;

    private $description; // To be implemented

    public function __construct($id, $nickname, $email, $passwordHash, $registrationDate){
        $this->id = $id;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->registrationDate = $registrationDate;
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

    public function getNickname(){
        return $this->nickname;
    }

    public function setNickname($nickname){
        $this->nickname = $nickname;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getPasswordHash(){
        return $this->passwordHash;
    }

    public function setPasswordHash($passwordHash){
        $this->passwordHash = $passwordHash;
    }

    public function getRegistrationDate(){
        return $this->registrationDate;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
}

?>