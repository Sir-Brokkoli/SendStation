<?php namespace Sendstation\UI\Controller;

include_once 'IDataTableController.class.php';
include_once 'Classes/Database.class.php';

use Sendstation\Database\Database;

class ClimbersTableController implements IDataTableController {

    private static $scheme = array("cragId", "name", "description");

    private int $pageSize = 20;
    private int $page;

    private $data;

    private $climbersDataGateway = null;

    public function __construct($page) {

        $this->page = $page;

        $this->climbersDataGateway = Database::getClimbersDataGateway();
        $this->data = $this->climbersDataGateway->findAll();
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