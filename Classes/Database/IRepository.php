<?php namespace Sendstation\Database;

require_once 'IEntity.php';

/** 
 * Interface for a crud repository with basic fetch and manipulation methods.
 */
interface IRepository {
    public function findAll() :array;
    public function findById($id) :?IEntity;
    public function insert(IEntity $entity) :bool;
    public function update(IEntity $entity) :bool;
    public function save(IEntity $entity) :bool;
    public function delete(IEntity $entity) :bool;
}
?>