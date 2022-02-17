<?php namespace Sendstation\UI\Modal;

include_once 'Classes/UI/IDrawable.php';

use Sendstation\UI\IDrawable;

/**
 * A pop-up modal.
 * 
 * @author Joshua Graf
 */
class Modal implements IDrawable {

    private $modalId;
    private $fade;

    private $content;

    public function __construct($modalId, $fade = true) {

        $this->modalId = $modalId;
        $this->fade = $fade;
    }

    public function draw() {

        echo "<div class=\"modal " . 
            ($this->fade ? "fade" : "") . 
            "\" id=\"" . 
            $this->modalId . 
            "\">";
        echo "<div class=\"modal-dialog\">";

        $this->content->draw();

        echo "</div></div>";
    }

    public function setContent($content) : void {

        $this->content = $content;
    }
}

?>