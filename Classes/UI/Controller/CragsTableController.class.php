<?php namespace Sendstation\UI\Controller;

include_once 'IDataTableController.class.php';
include_once 'Classes/Database.class.php';

use Sendstation\Database\Database;

class CragsTableController implements IDataTableController {

    private static $scheme = array("cragId", "name", "description");

    private int $pageSize = 20;
    private int $page;

    private $data;
    private $cursor;

    private $dataGateway = null;

    public function __construct($page) {

        $this->page = $page;

        $this->dataGateway = Database::getCragsDataGateway();
        $this->data = $this->dataGateway->findAll();
        $this->cursor = 0;
    }

    public function getScheme() : array {

        return $this->dataGateway->getScheme();
    }

    public function hasNext() : bool {

        return $this->cursor < count($this->data);
    }

    public function getNextRow() : array {

        return $this->data[$this->cursor++]->serialize();
    }
}

?>