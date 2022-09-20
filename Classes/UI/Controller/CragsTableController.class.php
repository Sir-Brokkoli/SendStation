<?php namespace Sendstation\UI\Controller;

include_once 'IDataTableController.class.php';
include_once 'Classes/Crags/CragServiceImpl.php';

use Sendstation\Crags\CragServiceImpl;

class CragsTableController implements IDataTableController {

    private static $scheme = array("cragId", "name", "description");

    private int $page;

    private $data;
    private $cursor;

    public function __construct($page) {

        $this->page = $page;

        $this->data = CragServiceImpl::getInstance()->getCrags();
        $this->cursor = 0;
    }

    public function getScheme() : array {

        return self::$scheme;
    }

    public function hasNext() : bool {

        return $this->cursor < count($this->data);
    }

    public function getNextRow() : array {

        return $this->data[$this->cursor++]->serialize();
    }
}

?>