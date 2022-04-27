<?php namespace Sendstation\Service;

include_once 'Classes/Model/TickerMessage.class.php';

use Sendstation\Model\TickerMessage;

class TickerService {

    private $connection;

    public function __construct($sqlConnection) {

        $this->connection = $sqlConnection;
    }

    public function addRouteSendMessage(int $climberId, int $routeId) :void {

        $msg = "~climber:{$climberId} sended ~route:{$routeId}";
        $tick = new TickerMessage($climberId, $msg);
    }
}

?>