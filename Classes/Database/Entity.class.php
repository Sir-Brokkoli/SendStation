<?php namespace Sendstation\Database;

/**
 * The class to represent entities fetched from the database.
 * 
 * Auto-generates the attributes with getter and setter.
 * 
 * @author Joshua Graf
 */
class Entity extends stdClass {

    public function __construct(array $attributes = array()) {

        if (empty($attributes)) {

            return;
        }

        foreach ($attributes as $attribute => $argument) {

            $this->{$attribute} = $argument;

            $this->{"set" . ucfirst($attribute)} = function($stdObject, $value) use ($attribute) {

                $stdObject->{$attribute} = $value;
            };

            $this->{"get" . ucfirst($attribute)} = function($stdObject) use ($attribute) {

                return $stdObject->{$attribute};
            };
        }
    }

    public function __call($method, $args) {

        $args = array_merge(array("stdObject" => $this), $args);

        if(isset($this->{$method}) && \is_callable($this->{$method})) {

            return \call_user_func_array($this->{$method}, $args);
        }
        else {

            throw new Exception("Fatal error: Call to undefined method Entity::{$method}()");
        }
    }
}

?>