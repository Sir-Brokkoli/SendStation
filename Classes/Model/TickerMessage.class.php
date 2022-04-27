<?php namespace Sendstation\Model;

class TickerMessage {

    private int $climberId;
    private string $message;

    public function construct($climberId, $message) {

        $this->climberId = $climberId;
        $this->message = $message;
    }

    public function getClimberId() :int {

        return $this->climberId;
    }

    public function getMessage() :string {
        
        return $this->message;
    }
}

?>