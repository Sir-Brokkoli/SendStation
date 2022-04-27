<?php namespace Sendstation\UI\Modal;

include_once 'Classes/UI/IDrawable.php';

use Sendstation\UI\IDrawable;

/**
 * A pop-up modal.
 * 
 * @author Joshua Graf
 */
class Modal implements IDrawable {

    private string $modalId;

    private bool $fade = true;
    private bool $staticBackdrop = false;

    private array $content;

    public function __construct($modalId) {

        $this->modalId = $modalId;
    }

    public function draw() : void {

        echo "<div class=\"modal " . 
            ($this->fade ? "fade" : "") . 
            "\" id=\"" . $this->modalId . "\"" .
            ($this->staticBackdrop ? "\" data-bs-backdrop=\"static\" data-bs-keyboard=\"false\"" : "") . 
            ">";
        echo "<div class=\"modal-dialog\">";

        foreach ($this->content as $element) {

            $element->draw();
        }

        echo "</div></div>";
    }

    public function addContent(IDrawabel $element) : void {

        array_push($this->content, $element);
    }
}

?>