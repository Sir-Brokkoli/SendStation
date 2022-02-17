<?php namespace Sendstation\UI\Controller;

include_once 'IDataTableController.class.php';
include_once 'Classes/Database.class.php';

use Sendstation\Database\Database;

class RoutesTableController implements IDataTableController {

    private static $scheme = array("cragId", "name", "description");

    private int $pageSize = 20;
    private int $page;

    private $data;

    private $routesDataGateway = null;

    public function __construct($page) {

        $this->page = $page;

        $this->routesDataGateway = Database::getRoutesDataGateway();
        $this->data = $this->routesDataGateway->findAll();
    }

    public function getScheme() : array {

        return self::$scheme;
    }

    public function hasNext() : bool {

        return false;
    }

    public function getNextRow() : array {

        return null;
    }
}

?>