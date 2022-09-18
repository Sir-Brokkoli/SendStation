<?php namespace Sendstation\Database;

/**
 * Database entity interface for managable entity classes.
 */
interface IEntity {
    /**
     * Returns the id of the entity which will be used as primary
     * key in the database. Composed keys are not supported.
     */
    public function getId();
}