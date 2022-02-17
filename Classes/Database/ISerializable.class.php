<?php namespace Sendstation\Database;

/**
 * Interface for serializable classes.
 */
interface ISerializable {

    public function serialize() : array;
    public function deserialize(array $data);
    public static function getSerializationScheme() : array;
}
?>