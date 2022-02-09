<?php namespace Sendstation\Database;

interface IPersistable {

    public function getId() : ISerializable;
    public function getScheme() : array;
}

?>