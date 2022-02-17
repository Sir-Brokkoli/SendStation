<?php namespace Sendstation\UI\Controller;

interface IDataTableController {

    public function getScheme() : array;
    public function hasNext() : bool;
    public function getNextRow() : array;
}

?>